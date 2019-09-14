<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

public function __construct()
    {
        //$this->middleware('auth');
    }

public function index(Request $request) {
    $users = User::paginate($request->perpage = 15);
    return response()->json($users, 200, [], 256);
    }

public function store(Request $request)
    {
        return User::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'api_token' => Str::random(60),
        ]);      
        return response()->json($user, 200, [], 256);
    }
}
