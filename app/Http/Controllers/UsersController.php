<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function getUserDetails()
    {
        return new UserResource(Auth::user());
    }
}
