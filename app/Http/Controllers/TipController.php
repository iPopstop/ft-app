<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Tip;
use Illuminate\Http\Request;

class TipController extends Controller
{
    public function send(Request $request)
    {
        $userId = auth()->guard('client')->check() ? auth()->guard('client')->user()->id : null;
        if (!$request->has('employee_id') || ((!$request->has('donate-amount') && !$request->has('donate-amount-custom')))) {
            return view('problem')->with(['message' => 'Не указаны параметры оплаты, попробуйте ещё раз']);
        }
        $employeeId = $request->get('employee_id');
        if (!$employeeId || !Employee::firstWhere('id', $employeeId)) {
            return view('problem')->with(['message' => 'Сотрудник не найден']);
        }
        $tip = Tip::create([
            'sum_tips' => $request->has('donate-amount-custom') && (int)$request->get('donate-amount-custom') > 0 ? (int)$request->get('donate-amount-custom') : (int)$request->get('donate-amount', 50),
            'sum_comission' => 0,
            'user_id' => $userId,
            'employee_id' => (int)$employeeId
        ]);
        return view('success')->with(['tip_id' => $tip->id]);
    }
}
