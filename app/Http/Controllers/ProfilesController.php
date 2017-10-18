<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfilesController extends Controller
{
    /**
     * Show the user's name.
     *
     * @param User $user
     * @return \Response
     */
    public function show(User $user)
    {
        return view('profiles.show', [
            'profileUser' => $user,
            'threads' => $user->threads()->paginate(10)
        ]);
    }
}
