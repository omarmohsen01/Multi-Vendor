<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use NunoMaduro\Collision\Provider;

class SocialLoginController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::dirver($provider)->redirect();
    }

    public function callback($provider)
    {
        $user=Socialite::driver($provider)->user();
    }
}