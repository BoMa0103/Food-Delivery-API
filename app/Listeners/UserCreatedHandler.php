<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserCreatedHandler implements ShouldQueue
{
    /**
     * Handle the event.
     */
    public function handle(UserCreated $event): void
    {
        $this->setUserCashback($event->user);
    }

    private function setUserCashback(User $user): void
    {
        $user->cashback = 20;
        $user->save();
    }
}
