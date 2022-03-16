<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository  $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function loginForm() {
        if (auth()->user()){
            return redirect()->intended(route('home'));
        }
        return view('pages/auth/login');
    }

    public function login(LoginRequest $request) {

        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();

            return redirect()->intended(route('home'));
        }

        session()->flash('danger', 'bad credentials, incorrect email or password');
        return redirect(route('auth.login.form'));
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('home'));
    }

    public function registerForm() {
        return view('pages/auth/register');
    }

    public function register(RegisterRequest $request) {
        $userData = $request->validated();
        try {
            $this->userRepository->create($userData);

            return redirect(route('auth.login.form'));
        } catch (\Exception $exception) {
            session()->flash('danger', 'sorry, something went wrong, please try again later.');
            return redirect(route('auth.register.form'));
        }
    }
}
