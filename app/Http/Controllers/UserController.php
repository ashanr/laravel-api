<?php

namespace App\Http\Controllers;
use Illuminate\Validation\ValidationException;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function create(Request $request)
    {
        try{

        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['message' => 'User created']);
    } catch (ValidationException $e) {
      
    }

    }

    public function update(Request $request, $id)
    {

        try{
         // Validate incoming request
         $request->validate([
            'name' => 'string|min:10|max:255',
            'email' => 'email|unique:users,email'
        ]);

        $user = User::find($id);
        // Update fields
        $user->save();

        return response()->json(['message' => 'User updated']);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

    }

    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }
}
