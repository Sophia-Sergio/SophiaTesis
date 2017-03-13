<?php

namespace Sophia\Http\Controllers\Auth;

use Sophia\Perfil;
use Sophia\User;
use Sophia\Usuario_Perfil;
use Validator;
use Sophia\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            //'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',

            // Custom Fields
            'first_name' => 'required|min:3|max:100',
            'last_name' => 'required|min:3|max:100',
            'birth_day' => 'required|digits_between:1,31',
            'birth_month' => 'required|digits_between:1,12',
            'birth_year' => 'required|numeric',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            //'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),

            // Custom Fields
            'nombre' => $data['first_name'],
            'apellido' => $data['last_name'],
            'fecha_nacimiento' => "{$data['birth_year']}-{$data['birth_month']}-{$data['birth_day']}",
            'edad' => Carbon::createFromDate($data['birth_year'],$data['birth_day'],$data['birth_month'])->age,
            'estado' => 1,
            'reintentos' => 0
        ]);

        $studentProfile = Perfil::where('codigo_perfil', 'EST')->get();

        //dd($user->id);

        if (count($studentProfile)) {
            Usuario_Perfil::create([
                'id_usuario'    =>  $user->id,
                'id_perfil'     =>  $studentProfile[0]->id
            ]);
        }

        return $user;
    }
}
