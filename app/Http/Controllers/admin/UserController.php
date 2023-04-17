<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        return view('admin.home.dashboard');
    }

    public function userList(){
        return view ('admin.user.user-list',[
            'users' => User::latest()->get()
        ]);
    }

    public function addUser(){
        return view('admin.user.adduser');
    }

    public function store(Request $request){
        $image = $request->file('image');
        $imageName = time().rand(10,1000).'.'.$image->getClientOriginalExtension();
        $directory = 'admin/assets/images/';
        $image->move($directory, $image);
        $imageUrl = $directory.$image;

        $user = new User();
        $user->name           = $request->name;
        $user->email    = $request->email;
        $user->image          =$imageUrl;
        $user->save();
    }
}
