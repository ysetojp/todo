<?php

namespace App\Services;

use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User as ProviderUser;
use App\Eloquent\SocialUser;
use App\Eloquent\User;

class SocialUserService
{
    public function findOrCreate(ProviderUser $providerUser, $provider)
    {
        $socialUser = SocialUser::where('provider_name', $provider)
            ->where('provider_id', $providerUser->getId())
            ->first();

        if ($socialUser) {
            $user = $socialUser->user;
            $user->fill(['api_token' => Str::random(60)])->update();
            return $user;
        } else {

            $user = User::where('email', $providerUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'api_token' => Str::random(60)
                ]);
            }

            $user->social()->create([
                'provider_id' => $providerUser->getId(),
                'provider_name' => $provider,
            ]);

            return $user;

        }
    }
}
