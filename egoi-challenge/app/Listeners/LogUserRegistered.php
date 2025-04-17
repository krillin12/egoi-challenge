<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use App\Models\Log;

class LogUserRegistered
{
    public function handle(Registered $event): void
    {
        Log::create([
            'user_email' => $event->user->email,
            'description' => 'User registered',
            'at_time' => now(),
        ]);
    }
}