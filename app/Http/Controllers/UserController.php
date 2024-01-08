<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    /**
     * User is not approved warning page.
     */
    public function notApproved()
    {
        if (auth()->user()->userIsApproved) {

            return redirect()->route('dashboard');
        }

        return view('auth.not-approved');
    }
}
