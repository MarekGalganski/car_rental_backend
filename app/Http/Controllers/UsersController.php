<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ChangeDetailsRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Actions\User\UpdateUserDetailsAction;
use App\Actions\User\ChangeUserPasswordAction;

class UsersController extends Controller
{
    public function getUserDetails()
    {
        if (Gate::allows('view-developer-dashboard')) {
            return new UserResource(Auth::user());
        }

        return response()->json(['error' => 'unauthorized'], 401);
    }

    public function changePassword(ChangePasswordRequest $request, ChangeUserPasswordAction $changeUserPasswordAction)
    {
        if ($changeUserPasswordAction->run($request->all(), Auth::id())) {
            return response()->json(['status' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function changeDetails(ChangeDetailsRequest $request, UpdateUserDetailsAction $updateUserDetailsAction)
    {
        if ($updateUserDetailsAction->run($request->all(), Auth::id())) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
