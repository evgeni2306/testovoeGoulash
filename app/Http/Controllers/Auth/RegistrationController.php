<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        return view('Auth.Register.Register');
    }

    public function store(Request $request)
    {
        $fields = $request->all();
        $validator = Validator::make($fields, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'age' => 'required|integer|gt:0',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect(route('registration'))->withErrors([
                'error' => $validator->errors()->first()
            ])->withInput();
        }
        $user = User::query()->create($fields);
        if ($user) {
            Auth::login($user);
            return redirect(route('userList'));
        }
    }
}
