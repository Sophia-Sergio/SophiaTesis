<?php

namespace Sophia\Http\Controllers;

use Illuminate\Http\Request;
use Sophia\Http\Requests;
use Socialite;
use Sophia\OauthIdentity;
use Sophia\Perfil;
use Sophia\User;
use Illuminate\Support\Facades\Auth;
use Session;
use Sophia\Usuario_Perfil;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        // Obtener información de usuario desde provider
        $userProvider = Socialite::driver($provider)->user();

        //Validar que el usuario exista según el email obtenido
        $user = User::where('email', $userProvider->email)->first();

        if (!$user) {

            $separatedName = explode(' ', $userProvider->name);

            $lastName = '';

            for ($i=1; $i<count($separatedName);$i++) {
                $lastName .= " $separatedName[$i]";
            }

            $insert = User::create([
                'nombre' => $separatedName[0],
                'apellido' => ltrim($lastName),
                'email' => $userProvider->email,
                'password' => bcrypt(
                    substr(
                        str_shuffle(
                            str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)
                        ), 0, 5)
                ),
                'fecha_nacimiento' => '1990-01-01',
                'edad' => 0,
                'estado' => 1,
                'reintentos' => 0
            ]);

            $user = $insert;

            Usuario_Perfil::create([
                'id_usuario' => $user->id,
                'id_perfil' => 2
            ]);
        }

        // Validar si la relación usuario provider existe
        $oauthIdentity = OauthIdentity::where([
            'provider' => $provider,
            'provider_user_id' => $userProvider->id
        ])->first();

        if (!$oauthIdentity) {
            OauthIdentity::create([
                'provider' => $provider,
                'provider_user_id' => $userProvider->id,
                'access_token' => isset($userProvider->token) ? $userProvider->token : null,
                'user_id' => $user->id,
                'access_token' => $userProvider->token,
                'avatar' => $userProvider->avatar_original
            ]);
        } else {
            $oauthIdentity = OauthIdentity::where([
                'provider' => $provider,
                'provider_user_id' => $userProvider->id
            ])->update([
                'access_token' => $userProvider->token,
                'avatar' => $userProvider->avatar_original
            ]);
        }

        // Login y sesión de usuario
        Auth::login($user);
        Session::put('user', $user);

        // Redireccionar al dashboard
        return redirect()->route('dashboard');
    }
}
