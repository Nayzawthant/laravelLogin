<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Contracts\Session\Session as SessionSession;
use Session;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\Session as FacadesSession;

class CustomAuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }
    public function registration() 
    {
        return view("auth.registration");
    }
    public function registerUser(Request $request) 
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|max:12'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = FacadesHash::make($request->password);
        $res = $user->save();
        if($res) {
            return back()->with('success','You have registered successfully');
        }else {
            return back()->with('fail', 'Something wrong');
        }
    }
    public function loginUser(Request $request) {
        $request->validate([
            'email'=>'required|email', 
            'password'=>'required|min:5|max:12'
        ]);
        $user = User::where('email', '=', $request->email)->first();
        if ($user) {
            if(FacadesHash::check($request->password,$user->password)) {
                $request->session()->put('loginId', $user->id);
                return redirect('dashboard');
            } else {
                return back()->with('fail','Password not matches.');
            }
        } else {
            return back()->with('fail','This email is not registered');
        }
    }

    public function dashboard() {
        $data = array();
        if(FacadesSession::has('loginId')) {
            $data = User::where('id', '=', FacadesSession::get('loginId'))->first();
        }
        return view('dashboard',compact('data'));
    }

    public function logout() {
        if(FacadesSession::has('loginId')) {
            FacadesSession::pull('loginId');
            return redirect('login');
        }
    }
}
