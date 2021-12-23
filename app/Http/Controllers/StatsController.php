<?php

namespace App\Http\Controllers;

use App\Models\BalanceHistory;
use App\Models\Comment;
use App\Models\Tip;
use App\Models\User;

class StatsController extends Controller
{
    public function index()
    {
        // ID 1
        $auth = auth()->user();
        $tips = Tip::all();
        $tips_avg = number_format($tips->avg('sum_tips') ?? 0, 2);
        $users = User::all()->pluck('id')->toArray();
        $history = BalanceHistory::whereIn('user_id', $users)
            ->where('company_id', $auth->company_id)
            ->where('bonus', 1)->get();
        $history_count = $history->count();
        $bonuses_percent = ($history_count > 0) && (count($users) > 0) ? number_format(((count($users) / $history_count) * 100), 2) : 0;
        $total = Comment::whereHas('employee', function ($e) use ($auth) {
            $e->where('company_id', $auth->company_id);
        })->get();
        $plus = $total->where('rate', '>', 3)->count();
        $minus = $total->where('rate', '<', 4)->count();
        $plus_percent = $plus > 0 && $minus > 0 ? number_format(($plus / ($total->count())) * 100, 2) : 0;
        return $this->ok(compact('tips_avg', 'bonuses_percent', 'users', 'plus_percent'));
    }
}
