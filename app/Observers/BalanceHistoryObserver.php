<?php

namespace App\Observers;

use App\Models\BalanceHistory;
use App\Models\User;

class BalanceHistoryObserver
{
    public function created(BalanceHistory $balanceHistory)
    {
        $user = User::find($balanceHistory->user_id);
        if ($user) {
            if ($balanceHistory->type === 1) {
                $user->increment('balance', $balanceHistory->sum);
            } else {
                $user->decrement('balance', $balanceHistory->sum);
            }
        }
    }

    public function updated(BalanceHistory $balanceHistory)
    {
        //
    }

    public function deleted(BalanceHistory $balanceHistory)
    {
        //
    }

    public function restored(BalanceHistory $balanceHistory)
    {
        //
    }

    public function forceDeleted(BalanceHistory $balanceHistory)
    {
        //
    }
}
