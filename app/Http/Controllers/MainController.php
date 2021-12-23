<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->has('employee_id')) {
            return abort(404);
        }
        return view('main');
    }

    public function admin()
    {
        return view('app');
    }
}
