<?php

namespace App\Actions\User;

use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class ApproveUser
{
    use AsAction;

    public function handle(User $user)
    {
        if (! is_null($user->approved_at)) {
            return;
        }

        $user->approved_at = now();
        $user->save();
    }
}
