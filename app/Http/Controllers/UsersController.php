<?php

namespace App\Http\Controllers;

use App\Services\UserCreator;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController
{

    public function index()
    {
        $users = User::query()->orderBy('name')->get();
        $logedUser = Auth::user();
        return view('users.index', compact('users', 'logedUser'));
    }

    public function create()
    {
        $logedUser = Auth::user();
        return view('users.create', compact('logedUser'));
    }

    public function store(Request $request, UserCreator $userCreator)
    {
        $data = $request->except('_token');
        $userCreator->storeUser($data);
        return redirect()->route('users.index');
    }
}
