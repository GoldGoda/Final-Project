<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserSignUpRequest;

class UserController extends Controller
{

    public function index(Request $request)
    {
        //$users = User::with('roles')->get();
        $users = User::get();
        if (!$request->ajax()) return view('users.index', compact('users'));
        return response()->json(['users' => $users], 200);
    }

    public function create(UserSignUpRequest $userRequest)
    {
        $file = $userRequest->file('file');
        $user = new User([
            'img'  => $userRequest->input('/storage/images/default_user_image.png'),
            'name'  => $userRequest->input('name'),
            'phone' => $userRequest->input('phone'),
            'email' => $userRequest->input('email'),
            'password' => Hash::make( $userRequest->input('pwd') ),
        ]);
        $user->save();
        $user->assignRole('user');
        if (!$userRequest->ajax()) return back()->with('success', 'User created');
        return response()->json(['status' => 'User created', 'user' => $user], 201);
    }

    public function modify(Request $userRequest)
    {
        $user = User::find($userRequest->id);
        $user->name  = $userRequest->name;
        $user->phone = $userRequest->phone;
        $user->email = $userRequest->email;
        $user->save();
        if (!$userRequest->ajax()) return back()->with('success', 'User created');
        return response()->json(['status' => 'User created', 'user' => $user], 201);
    }

    public function destroy(Request $req, $id)
    {
        $user = User::find($id);
        $user->delete();
        if (!$req->ajax()) return back()->with('success', 'User created');
        return response()->json(['status' => 'User created', 'user' => $user], 201);
    }
}
