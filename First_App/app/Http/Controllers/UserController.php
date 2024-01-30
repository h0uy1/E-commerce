<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function login(Request $request) : RedirectResponse {
        $credentials = $request -> validate([
            'login_email' => ['required','email'],
            'login_password' => ['required']
        ],);
        
        if(Auth::attempt(['email' => $credentials['login_email'],'password' =>$credentials['login_password']])){
            $request->session()->regenerate();
            $user = auth()->user();
            if ($user->is_admin === "2"){
                return redirect('/admin');
            }else{
                return redirect('/user');
            }
        }
        return redirect()->route('login')->with('failed', 'Password Or Email Not Match');
    }
    public function register(Request $request): RedirectResponse{
        $income_fields = $request -> validate([
            'name' => ['required'],
            'email' => ['required','email',Rule::unique('users','email')],
            'password'=> ['required','min:8','max:20']
        ]);

        $income_fields['password'] = bcrypt($income_fields['password']);
        $income_fields['is_admin'] = 0;
        if (User::create($income_fields)){
            return redirect('/');
        };
        
    }

    public function logout(Request $request): RedirectResponse{
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');
    }
}
