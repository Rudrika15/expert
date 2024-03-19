<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(){
        return view('admin.login');   
    }
    public function userStore(Request $request){
         $request -> validate(
            [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'password' => 'required|min:6|max:8',
                
            ],
            [
                'name.required' => 'Username is required',
                'password.required' => 'Password is required',  
            ]
            );
            $name = $request->name;
            $password = $request->password;
        
            $user = User::where('name', $name)->first();
        
            if ($user) {
                if (Hash::check($password, $user->password)) {
                    return redirect()->route('uploadTest');
                } else {
                    return redirect()->back()->with('error', 'Please check Password and try again!');
                }
            } else {
                return redirect()->back()->with('error', 'User did not match!');
            }
            }
}
