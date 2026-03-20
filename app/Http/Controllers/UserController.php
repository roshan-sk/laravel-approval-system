<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function create(Request $req)
    {
        $user = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => bcrypt($req->password ?? '123456'),
            'role' => $req->role ?? 'user'
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'data' => $user
        ]);
    }
}
