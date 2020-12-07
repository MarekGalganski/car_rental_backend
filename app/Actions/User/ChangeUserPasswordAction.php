<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;


class ChangeUserPasswordAction
{
    public function run($request, $userId)
    {
        $user = User::findOrFail($userId);

        if (Hash::check($request['oldPassword'], $user->password)) {
            $user->password = Hash::make($request['newPassword']);
            return $user->save();
        }

        return false;
    }
}