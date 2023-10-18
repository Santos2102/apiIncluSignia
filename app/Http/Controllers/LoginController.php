<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return view('pages.dashboard');
        }

        return back()->withErrors([
            'email' => 'Las credenciales ingresadas son incorrectas.',
        ]);
    }

    public function loginMobile(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->get(['id','email','password','roleId'])->first();
        if($user!=NULL){
            if(Hash::check($request->password,$user->password)){
                return response()->json(['message' => 'Password'], 201);
            }
            else{
                return response()->json(['message' => 'No password'], 201);
            }
        }
        else{
            return response()->json(['message' => 'No email'], 201);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/iniciar-sesión');
    }
}