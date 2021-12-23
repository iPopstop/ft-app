<?php

namespace App\Observers;

use App\Models\Employee;
use App\Models\Tip;
use App\Notifications\TipSendedNotification;

class TipObserver
{
    public function created(Tip $tip)
    {
        $user = Employee::find($tip->employee_id);
        $user->notify(new TipSendedNotification());
    }

    public function updated(Tip $tip)
    {
        //
    }

    public function deleted(Tip $tip)
    {
        //
    }

    public function restored(Tip $tip)
    {
        //
    }

    public function forceDeleted(Tip $tip)
    {
        //
    }
}
