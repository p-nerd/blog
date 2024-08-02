<?php

namespace App\Providers;

use App\Contracts\EmailMarketer;
use App\Services\MailchimpEmailMarketer;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind(EmailMarketer::class, fn () => MailchimpEmailMarketer::build());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->greeting("Hello {$notifiable?->name}!")
                ->subject('Verify Email Address - '.config('app.name'))
                ->line('Click the button below to verify your email address.')
                ->action('Verify Email Address', $url);
        });

    }
}
