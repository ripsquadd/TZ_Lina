<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        foreach ($users as $user) {
            dump($user->username);
        }
    }

    public function create(Request $request) {

        $validated = $request->validate([
            'username' => 'required|unique:users|max:255',
            'password' => 'required',
            'role' => 'required',
        ]);

        if($validated) {
            $user = new User();

            $user->username = $request->input('username');
            $user->password = Hash::make($request->password);
            $user->role = $request->input('role');

            if( $user->save()) {
                return response()->json(['message' => 'User created successfully']);
            } else {
                return response()->json(['message' => 'Something went wrong when saving the record']);
            }
        } else {
            return response()->json(['message' => 'Validation failed, please try again']);
        }
    }
}
