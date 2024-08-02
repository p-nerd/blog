<?php

namespace App\Listeners;

use App\Contracts\EmailMarketer;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class AddRegisteredUserToNewsletter implements ShouldQueue
{
    public function __construct(
        protected EmailMarketer $emailMarketer
    ) {
        //
    }

    public function handle(Registered $event): void
    {
        try {
            $this->emailMarketer->subscribeToNewsletter($event->user->email);
        } catch (Exception $e) {
            Log::error('Error in adding registered user to newsletter', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
            ]);
        }
    }
}
