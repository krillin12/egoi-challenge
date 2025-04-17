<?php
namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\Log;

class LogUserLogin
{
    public function handle(Login $event): void
    {
        Log::create([
            'user_email' => $event->user->email,
            'description' => 'User logged in',
            'at_time' => now(),
        ]);
    }
}
