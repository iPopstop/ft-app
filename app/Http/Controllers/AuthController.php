<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Repositories\AuthRepository;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected $request;
    protected $repo;
    protected $user;

    public function __construct(Request $request, AuthRepository $repo)
    {
        $this->request = $request;
        $this->repo = $repo;
    }

    public function login(LoginRequest $request)
    {
        $auth = $this->repo->auth($this->request->all());
        $message = trans('auth.logged');
        $authenticated = true;
        return $this->success(compact('auth', 'message', 'authenticated'));
    }

    public function check()
    {
        return $this->success($this->repo->check());
    }

    public function logout()
    {
        \Auth::guard('web')->logout();

        return $this->success(['message' => trans('auth.logged_out')]);
    }
}
