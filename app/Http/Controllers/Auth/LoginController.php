<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        return view('Auth.Login.Login');
    }

    public function login(Request $request): \Illuminate\Http\RedirectResponse
    {
        $fields = $request->all('email', 'password');
        $validator = Validator::make($fields, [
            'email' => 'required|string|max:255|exists:users,email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect(route('login'))->withErrors([
                'error' => $validator->errors()->first()
            ])->withInput();
        }
        if (Auth::guard('web')->attempt($fields)) {
            return redirect(route('userList'));
        }
        return redirect(route('login'))->withErrors([
            'login' => 'Не удалось авторизоваться, проверьте правильность вводимых данных'
        ])->withInput();
    }
}
