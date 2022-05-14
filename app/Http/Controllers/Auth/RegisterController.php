<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'min:11'],
        ],[
            'name.required' => 'নাম দিতে হবে',
            'name.string' => 'একটি সঠিক নাম দিন',
            'name.max' => 'নাম টি বড় হয়ে গেছে, একটি ছোট নাম দিন',

            'email.required' => 'ই-মেইল দেননি',
            'email.string' => 'ই-মেইল টি সঠিক নয়',
            'email.email' => 'ই-মেইল টি সঠিক নয়',
            'email.unique' => 'ই-মেইল টি আগে ব্যবহৃত হয়েছে',

            'password.required' => 'পাসওয়ার্ড দিন',
            'password.min' => 'পাসওয়ার্ড কমপক্ষে ৮ ক্যারেক্টার হতে হবে',
            'password.confirmed' => 'পাসওয়ার্ড এবং কনফার্ম পাসওয়ার্ড মিলেনি',

            'phone.required' => 'আপনার ফোন নাম্বার দিন',
            'phone.min' => 'ফোন নাম্বার কমপক্ষে ১১ ডিজিটের হতে হবে',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
