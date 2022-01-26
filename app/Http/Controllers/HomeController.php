<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Http\requests\StorePasswordRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function changePassword()
    {
         return view('auth.passwords.change-password');
    }

     public function changePasswordStore(StorePasswordRequest $request) {

        if (!(Hash::check($request->current_password, Auth::user()->password))) {

            return redirect()->back()->with("error","Your current password does not matches with the password.");
        }

        if(strcmp($request->current_password, $request->new_password) == 0){
            
            return redirect()->back()->with("error","New Password cannot be same as your current password.");
        }

      
        $user = Auth::user();
        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect()->back()->with("success","Password successfully changed!");
    }

}
