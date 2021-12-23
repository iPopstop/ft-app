<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthRepository
{
    protected $user;

    public function __construct(EmployeeRepository $user)
    {
        $this->user = $user;
    }

    public function validateRegistrationStatus($params = [])
    {
        $codeExists = isset($params['code']) && mb_strlen($params['code']) > 1;

        if (!$codeExists || !config('config.registration')) {
            throw ValidationException::withMessages(['message' => trans('register.wrong_code')]);
        }

        return true;
    }

    public function auth($params = [])
    {
        $this->validateLogin($params);

        // Вообще авторизация по номеру, но это тестовый вариант, поэтому берём первый акк
        $auth_user = $this->user->findOrFail(1);

        return [
            'user' => $auth_user,
        ];
    }

    public function validateLogin($params = [])
    {
        // Вообще авторизвация по номеру, но это тестовый вариант, поэтому берём первый акк
        //$user = Employee::where('mobile_number', $params['mobile_number'])->first();
        $user = Employee::find(1);
        $code = $params['password'] ?? null;
        // Т.к. тест, принимаем все коды
        if ((!$user)) {
            throw ValidationException::withMessages(['mobile_number' => trans('auth.failed')]);
        }
        Auth::login($user);
    }

    public function check()
    {
        if (!auth()->check()) {
            return ['authenticated' => false];
        }
        $authenticated = true;
        $user = Employee::with(['notifications' => function ($n) {
            $n->take(20);
        }])->findOrFail(auth()->user()->id);
        // $roles = $user->getRoleNames(); в разработке
        $roles = [];
        $notifications = $user->notifications;
        //$permissions = $user->getAllPermissions(); в разработке
        $permissions = [];
        return compact('authenticated', 'user', 'permissions', 'roles', 'notifications');
    }
}
