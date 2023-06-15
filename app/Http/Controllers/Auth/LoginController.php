<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function redirectToGitHub(): RedirectResponse
    {
        return Socialite::driver('github')->redirect();
    }




    public function handleGitHubCallback(): RedirectResponse
    {
        $githubUser = Socialite::driver('github')->user();

        $username = $this->generateUniqueUsername($githubUser->getNickname());

        // Проверяем, существует ли пользователь с таким же адресом электронной почты
        $existingUser = User::where('email', $githubUser->getEmail())->first();

        if ($existingUser) {
            // Пользователь с таким же адресом электронной почты уже существует
            // Выполняйте действия, необходимые для входа этого пользователя
            Auth::login($existingUser);

            return redirect()->intended('home');
        }

        // Если пользователь с таким же адресом электронной почты не существует, создаем нового пользователя
        $avatarUrl = $githubUser->getAvatar();
        $avatarName = $username . '-' . time()  . '.png';

        $avatarContents = Http::get($avatarUrl)->body();

        $avatarPath = 'public/avatars/' . $avatarName;

        Storage::put($avatarPath, $avatarContents);

        $user = User::create([
            'name' => $githubUser->getName(),
            'email' => $githubUser->getEmail(),
            'username' => $username,
            'password' => Hash::make($githubUser->getId()),
            'avatar' => 'avatars/' . $avatarName,
            'github_username' => $username,
            'provider' => 'github', // Сохраняем провайдера в поле provider
            'provider_id' => $githubUser->getId(), // Сохраняем идентификатор провайдера в поле provider_id
        ]);

        Auth::login($user);

        return redirect()->intended('home');
    }


    private function generateUniqueUsername($username)
    {
        $originalUsername = $username;
        $counter = 1;

        while (User::where('username', $username)->exists()) {
            $username = $originalUsername . $counter;
            $counter++;
        }

        return $username;
    }
}
