<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //show
    public function show(User $user){
        return view('users.show', compact('user'));
    }

    // edit
    public function edit(User $user){
        return view('users.edit');
    }
}
