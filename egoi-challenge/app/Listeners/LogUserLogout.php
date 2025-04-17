<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Models\Log;

class LogUserLogout
{
    public function handle(Logout $event): void
    {
        Log::create([
            'user_email' => $event->user->email,
            'description' => 'User logged out',
            'at_time' => now(),
        ]);
    }
}