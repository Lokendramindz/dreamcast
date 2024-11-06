<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;


class UserController extends Controller
{

   
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|regex:/^(\+91[\-\s]?)?[0]?(91)?[789]\d{9}$/',
            'description' => 'nullable|string',
            'role_id' => 'required|exists:roles,id',
            'profile_image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        
        if ($request->hasFile('profile_image')) {
            $fileName = time() . '.' . $request->file('profile_image')->extension();
            $filePath = $request->file('profile_image')->storeAs('images', $fileName, 'public');
            $data['profile_image'] = $fileName;
        }

        User::create($data);

        return response()->json(['message' => 'User created successfully'], 201);
    }

 

    public function index()
    {
        $users = User::all(); // Retrieve all users
        return view('users', compact('users')); // Directly point to 'users.blade.php'
    }
}

