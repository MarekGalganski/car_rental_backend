<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Actions\User\UpdateUserDetailsAction;
use App\Actions\User\ChangeUserPasswordAction;

class UsersController extends Controller
{
    public function getUserDetails()
    {
        return new UserResource(Auth::user());
    }

    public function changePassword(Request $request, ChangeUserPasswordAction $changeUserPasswordAction)
    {
        if ($changeUserPasswordAction->run($request->all(), Auth::id())) {
            return response()->json(['status' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function changeDetails(Request $request, UpdateUserDetailsAction $updateUserDetailsAction)
    {
        if ($updateUserDetailsAction->run($request->all(), Auth::id())) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
