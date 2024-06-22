<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaigns;
use App\Models\CampaignUserLogs;
use App\Models\CampaignUsers;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $activeUserCampaigns = CampaignUsers::where('user_id', auth()->user()->id)->get();
        $campaigns = Campaigns::where('status', 'active')->whereNotIn('id', $activeUserCampaigns->pluck('campaign_id'))->with('merchant')->orderBy('created_at', 'desc')->limit(5)->get();

        if (auth()->user()->role == 'merchant') {

            // Kullanıcıya ait tüm kampanyaların revenue değerlerini alın
            $userCampaigns = Campaigns::where('user_id', auth()->user()->id)->get();
            $campaignsRevenue = CampaignUserLogs::whereIn('campaign_id', $userCampaigns->pluck('id'))->sum('revenue');
            $campaignsInfluencerRevenue = CampaignUserLogs::whereIn('campaign_id', $userCampaigns->pluck('id'))->sum('inf_revenue');

            // Tarih aralıklarını belirleyin
            $oneWeekAgo = Carbon::now()->subWeek();
            $twoWeeksAgo = Carbon::now()->subWeeks(2);

            // Kullanıcıya ait tüm kampanyaları alın
            $allCampaigns = Campaigns::where('user_id', auth()->user()->id)
                ->with('merchant')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->pluck('id');

            // Kampanya tipi sayıları
            $campaignTypes = Campaigns::whereIn('id', $allCampaigns)
                ->selectRaw('type, count(*) as total')
                ->groupBy('type')
                ->get();

            // Son hafta içerisindeki aktif kampanyalar
            $activeUserCampaigns = CampaignUsers::whereIn('campaign_id', $allCampaigns)
                ->where('created_at', '>=', $oneWeekAgo)
                ->with(['users', 'campaigns'])
                ->orderBy('revenue', 'desc')
                ->limit(5)
                ->get();

            // Son haftanın toplam geliri
            $lastWeekRevenue = CampaignUsers::whereIn('campaign_id', $allCampaigns)
                ->where('created_at', '>=', $oneWeekAgo)
                ->sum('revenue');

            // Önceki haftanın toplam geliri
            $previousWeekRevenue = CampaignUsers::whereIn('campaign_id', $allCampaigns)
                ->whereBetween('created_at', [$twoWeeksAgo, $oneWeekAgo])
                ->sum('revenue');

            // Yüzdelik değişim hesaplama
            if ($previousWeekRevenue > 0) {
                $percentageChange = (($lastWeekRevenue - $previousWeekRevenue) / $previousWeekRevenue) * 100;
            } else {
                $percentageChange = $lastWeekRevenue > 0 ? 100 : 0;
            }

            // $dates = $this->convertWeek();

            // //  Haftalık gelirler
            // $weeklyRevenue = CampaignUsers::whereIn('campaign_id', $allCampaigns)
            //     ->whereBetween('created_at', [$dates['start'], $dates['end']])
            //     ->selectRaw('sum(revenue) as revenue, DATE(created_at) as date')
            //     ->groupBy('date')
            //     ->get();

            //     dd($weeklyRevenue);

            return view('home', [
                'campaigns' => $campaigns,
                'activeUserCampaigns' => $activeUserCampaigns,
                'lastWeekRevenue' => $lastWeekRevenue,
                'previousWeekRevenue' => $previousWeekRevenue,
                'percentageChange' => $percentageChange,
                'campaignTypes' => $campaignTypes,
                'campaignsRevenue' => $campaignsRevenue,
                'campaignsInfluencerRevenue' => $campaignsInfluencerRevenue,
            ]);
        }

        return view('home', ['campaigns' => $campaigns]);
    }

    public function convertWeek($date = null)
    {
        $date = $date ?? Carbon::now()->format('Y-\WW');

        // Haftanın ilk gününü al (Pazartesi günü olarak kabul edilir)
        $startOfWeek = Carbon::create($date)->startOfWeek(Carbon::MONDAY);
        $endOfWeek = Carbon::create($date)->endOfWeek(Carbon::SUNDAY);

        $dates = [];
        $dates['start'] = $startOfWeek->format('Y-m-d');
        $dates['end'] = $endOfWeek->format('Y-m-d');

        return $dates;
    }

    // public function weeklyRevenue($user_id = null, $date = null)
    // {
    //     // Haftanın 7 gününü içeren dizi oluştur
    //     $daysOfWeek = [
    //         'Monday' => 0,
    //         'Tuesday' => 0,
    //         'Wednesday' => 0,
    //         'Thursday' => 0,
    //         'Friday' => 0,
    //         'Saturday' => 0,
    //         'Sunday' => 0,
    //     ];

    //     // Verilen tarihi haftanın başlangıç ve bitiş tarihlerine dönüştür
    //     $dates = $this->convertWeek($date);

    //     // Kullanıcıya ait tüm kampanyaları alın
    //     $allCampaigns = Campaigns::where('user_id', $user_id ?? auth()->user()->id)
    //         ->with('merchant')
    //         ->orderBy('created_at', 'desc')
    //         ->limit(5)
    //         ->pluck('id');

    //     // Haftalık gelirler
    //     $startOfDay = Carbon::parse($dates['start'])->startOfDay();
    //     $endOfDay = Carbon::parse($dates['end'])->endOfDay();

    //     $weeklyRevenue = CampaignUsers::whereIn('campaign_id', $allCampaigns)
    //         ->whereBetween('created_at', [$startOfDay, $endOfDay])
    //         ->selectRaw('sum(revenue) as revenue, DATE(created_at) as date')
    //         ->groupBy('date')
    //         ->get();


    //     // Günlük gelirleri günlere göre diziye ekle
    //     foreach ($weeklyRevenue as $revenue) {
    //         $dayOfWeek = \Carbon\Carbon::parse($revenue->date)->format('l'); // Günü elde et
    //         $daysOfWeek[$dayOfWeek] = $revenue->revenue;
    //     }

    //     // Günleri istenen sırada döndürmek için bir diziye ekleyin
    //     $weeklyData = [];

    //     foreach ($daysOfWeek as $day => $revenue) {
    //         $weeklyData[] = [
    //             'day' => $day,
    //             'revenue' => $revenue
    //         ];
    //     }

    //     return response()->json($weeklyData);
    // }

    public function weeklyRevenue($user_id = null, $date = null)
{
    // Türkçe gün adlarını içeren bir dizi oluştur
    \Carbon\Carbon::setLocale('tr');
    $daysOfWeek = [
        'Pazartesi' => 0,
        'Salı' => 0,
        'Çarşamba' => 0,
        'Perşembe' => 0,
        'Cuma' => 0,
        'Cumartesi' => 0,
        'Pazar' => 0,
    ];

    // Verilen tarihi haftanın başlangıç ve bitiş tarihlerine dönüştür
    $dates = $this->convertWeek($date);

    // Kullanıcıya ait tüm kampanyaları alın
    $allCampaigns = Campaigns::where('user_id', $user_id ?? auth()->user()->id)
        ->with('merchant')
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->pluck('id');

    // Haftalık gelirler
    $startOfDay = Carbon::parse($dates['start'])->startOfDay();
    $endOfDay = Carbon::parse($dates['end'])->endOfDay();

    $weeklyRevenue = CampaignUsers::whereIn('campaign_id', $allCampaigns)
        ->whereBetween('created_at', [$startOfDay, $endOfDay])
        ->selectRaw('sum(revenue) as revenue, DATE(created_at) as date')
        ->groupBy('date')
        ->get();

    // Günlük gelirleri günlere göre diziye ekle
    foreach ($weeklyRevenue as $revenue) {
        $dayOfWeek = \Carbon\Carbon::parse($revenue->date)->translatedFormat('l'); // Türkçe gün adını elde et
        $daysOfWeek[$dayOfWeek] = $revenue->revenue;
    }

    // Günleri istenen sırada döndürmek için bir diziye ekleyin
    $weeklyData = [];

    foreach ($daysOfWeek as $day => $revenue) {
        $weeklyData[] = [
            'day' => $day,
            'revenue' => $revenue
        ];
    }

    return response()->json($weeklyData);
}

}
