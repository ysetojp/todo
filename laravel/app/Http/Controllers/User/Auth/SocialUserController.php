<?php

namespace App\Http\Controllers\User\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\User\Controller;
use App\Services\SocialUserService;

class SocialUserController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information
     *
     * @return Response
     */
    public function handleProviderCallback(SocialUserService $socialService, $provider)
    {
        try {
            $user = Socialite::with($provider)->user();
        } catch (\Exception $e) {
            return redirect()->route('user.login');
        }

        $authUser = $socialService->findOrCreate(
            $user,
            $provider
        );

        auth()->login($authUser, true);

        return redirect()->route('user.home');
    }
}
