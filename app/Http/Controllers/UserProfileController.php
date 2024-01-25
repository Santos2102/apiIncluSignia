<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    public function show()
    {
        return view('pages.user-profile');
    }

    public function update(Request $request)
    {
        try{
            $attributes = $request->validate([
                'firstname' => ['max:100'],
                'lastname' => ['max:100'],
                'email' => ['required', 'email', 'max:255',  Rule::unique('users')->ignore(auth()->user()->id),],
            ]);
    
            auth()->user()->update([
                'firstname' => $request->get('firstname'),
                'lastname' => $request->get('lastname'),
                'email' => $request->get('email'),
            ]);
            return back()->with('success', 'Información actualizada exitosamente');
        }
        catch(Exception $e){
            return back() -> with('error', 'Se produjo un error al procesar la solicitud');
        }
    }

    public function updatePassword(Request $request){
        try{
            $attributes = $request->validate([
                'password' => ['required', 'min:5'],
                'confirmPassword' => ['same:password']
            ]);
            auth()->user()->update([
                'password' => $attributes['password']
            ]);
            return back() -> with('success', 'Contraseña actualizada exitosamente');
        }
        catch(Exception $e){
            return back() -> with('error', 'Se produjo un error al procesar la solicitud');
        }
    }
}
