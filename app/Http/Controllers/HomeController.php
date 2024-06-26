<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaigns;
use App\Models\CampaignUserLogs;
use App\Models\CampaignUsers;
use App\Models\Supports;
use Carbon\Carbon;
use App\Models\User;
use App\Models\MoneyDemands;
use App\Models\BalanceHistory;

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

        if (auth()->user()->role == 'user') {
            $allCampaigns = CampaignUsers::where('user_id', auth()->user()->id)->with('campaigns')->orderBy('created_at', 'desc')->limit(5)->get();
            $totalRevenue = CampaignUsers::where('user_id', auth()->user()->id)->sum('revenue');

            $userCampaigns = CampaignUsers::where('user_id', auth()->user()->id)->get();

            // Kampanya tipi sayıları
            $campaignTypes = Campaigns::whereIn('id', $userCampaigns->pluck('campaign_id'))
                ->selectRaw('type, count(*) as total')
                ->groupBy('type')
                ->get();

            return view('home', ['campaigns' => $campaigns, 'allCampaigns' => $allCampaigns, 'totalRevenue' => $totalRevenue, 'campaignTypes' => $campaignTypes, 'salesRevenue' => $userCampaigns->sum('view_count'), 'clickRevenue' => $userCampaigns->sum('click_count')]);
        }

        if(auth()->user()->role == 'admin'){
            $allCampaigns = Campaigns::where('status', 'active')->with('merchant')->orderBy('created_at', 'desc')->get();
            $users = User::all();
            $supportCount = Supports::where('status', 'pending')->get();
            $moneyDemands = MoneyDemands::where('status', 'pending')->get();
            $balanceHistory = BalanceHistory::where('status', 'pending')->where('type', 'iban')->get();
            // $campaignLogs = CampaignUserLogs::selectRaw('sum(revenue) as revenue, DATE(created_at) as date')->groupBy('date')->get();

            return view('home', ['campaignsCount' => $allCampaigns->count(), 'influencerCount' => $users->where('role', 'user')->count(), 'merchantCount' => $users->where('role', 'merchant')->count(), 'supportCount' => $supportCount->count(), 'moneyDemands' => $moneyDemands->count(), 'balanceHistory' => $balanceHistory->count()]);
        }
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

    public function infWeeklyRevenue($user_id = null, $date = null)
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
        $allCampaigns = CampaignUsers::where('user_id', $user_id ?? auth()->user()->id)
            ->with('campaigns')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->pluck('campaign_id');

        // Haftalık gelirler
        $startOfDay = Carbon::parse($dates['start'])->startOfDay();
        $endOfDay = Carbon::parse($dates['end'])->endOfDay();

        $weeklyRevenue = CampaignUserLogs::whereIn('campaign_id', $allCampaigns)
            ->whereBetween('created_at', [$startOfDay, $endOfDay])
            ->selectRaw('sum(inf_revenue) as revenue, DATE(created_at) as date')
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

    public function adminWeeklyRevenue($date = null)
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

        // Haftalık gelirler
        $startOfDay = Carbon::parse($dates['start'])->startOfDay();
        $endOfDay = Carbon::parse($dates['end'])->endOfDay();

        $weeklyRevenue = CampaignUserLogs::whereBetween('created_at', [$startOfDay, $endOfDay])
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
