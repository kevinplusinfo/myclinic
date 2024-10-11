<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthenticationController extends Controller
{
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'] 
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $msg = "Login Successfully...";
            return redirect()->route('patients')->with('alert_success', $msg);

        }

        return back()->withErrors([
            'email' => 'The Provided Credentials Do Not Match Our Records.',
        ])->onlyInput('email'); 
    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');
    }
}
