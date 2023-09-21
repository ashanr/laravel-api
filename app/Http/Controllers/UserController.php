<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['message' => 'User created']);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        // Update fields
        $user->save();

        return response()->json(['message' => 'User updated']);
    }

    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }
}
