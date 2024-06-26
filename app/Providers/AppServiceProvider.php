<?php

namespace App\Providers;

use Faker\Provider\ar_EG\Payment;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewInstance;
use App\Models\PaymentData;
use App\Models\Settings;

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
                $columns = ['bank_name', 'iban', 'account_username', 'desc'];
                foreach ($columns as $column) {
                    if (empty($paymentData->$column)) {
                        $status = false;
                        break;
                    }
                }
            } else {
                $status = false;
            }

            $view->with('balance', auth()->user()?->balance ?? 0);
            $view->with('paymentData', $status);
            $view->with('userPhoto', auth()->user()->photo ?? '/images/site_favicon/1717860313.png');

            // Settings
            $settings = Settings::first();
            $view->with('settings', $settings);

            // Payment Pos
            $paymentinput = '';
            $view->with('paymentinput', $paymentinput);
        });
    }
}
