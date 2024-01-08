<?php

namespace App\Actions\User;

use App\Models\User;
use Carbon\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateUserLastLoginAt
{
    use AsAction;

    public function handle(User $user, Carbon $time)
    {
        $user->last_login_at = $time;
        $user->save();
    }
}
