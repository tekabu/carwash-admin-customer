<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('type', 'admin')
        ->get();

        return view('users.users_table', [
            'table' => $users,
            'route' => 'users',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $view = view('users.users_entry', [
            'route' => 'users',
        ])
        ->render();

        return response()->json([
            'status' => true,
            'html' => $view,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'type' => 'nullable|in:admin,customer',
        ]);

        if ($validator->fails())
        {
            $errorMessage = $validator->errors()->first();

            $response = [
                "status" => false,
                "message" => $errorMessage
            ];

            return response()->json($response, 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type ?? 'admin',
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User created successfully.',
            'data' => $user,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $view = view('users.users_entry', [
            'route' => 'users',
            'row' => $user,
        ])
        ->render();

        return response()->json([
            'status' => true,
            'html' => $view,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'type' => 'nullable|in:admin,customer',
        ]);

        if ($validator->fails())
        {
            $errorMessage = $validator->errors()->first();

            $response = [
                "status" => false,
                "message" => $errorMessage
            ];

            return response()->json($response, 400);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = $request->type ?? 'admin';

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'User updated successfully.',
            'data' => $user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'User deleted successfully.'
        ]);
    }
}
