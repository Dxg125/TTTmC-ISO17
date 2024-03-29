<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EditProfileController extends Controller
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
    public function index()
    {
    	$id = Auth::id();
        $users = DB::table('users')->where('id', $id)->get();
        return view('editProfile', compact('users'));
    }

    public function edit(Request $request){

        $id = Auth::id();

        $user = User::find($id);

        if( $user->firstname != $request['firstname'] && $request['firstname'] != null){
            $user->firstname = $request['firstname'];
        }

        if( $user->lastname != $request['lastname'] && $request['lastname'] != null){
            $user->lastname = $request['lastname'];
        }

        if( $user->username != $request['username'] && $request['username'] != null){
            $user->username = $request['username'];
        }

        if( $user->status != $request['status'] && $request['status'] != null){
            $user->status = $request['status'];
        }

        if( $user->email != $request['email'] && $request['email'] != null){
            $user->email = $request['email'];
        }

        $user->save();

        $id = Auth::id();
        $users = DB::table('users')->where('id', $id)->get();
        return view('profile', compact('users'));

    }
}
