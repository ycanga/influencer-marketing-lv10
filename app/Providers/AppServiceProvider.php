<?php

namespace App\Providers;

use Faker\Provider\ar_EG\Payment;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewInstance;
use App\Models\PaymentData;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function (ViewInstance $view) {

            $status = true;
            $paymentData = PaymentData::where('user_id', auth()->id())->first();

            if ($paymentData) {
                foreach ($paymentData as $key => $value) {
                    if (!$value) {
                        $status = false;
                        break;
                    }
                }
            }else{
                $status = false;
            }

            $view->with('balance', auth()->user()?->balance ?? 0);
            $view->with('paymentData', $status);
        });
    }
}
