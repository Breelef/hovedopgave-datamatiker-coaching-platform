<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\Bookmarker;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use Bookmarker;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasRoles;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'approved_at',
        'club_id',
        'age_group_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the Club associated with the User.
     */
    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    /**
     * Check if the User has access to the admin panel.
     */
    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return $this->hasPermissionTo('access admin panel');
    }

    //connect user that is related to the players
    public function players()
    {
        return $this->belongsToMany(Player::class)->withPivot('relationship_type');
    }

    //connect user that is the player
    public function player()
    {
        return $this->hasOne(Player::class);
    }


    // Get approve status
    public function getUserIsApprovedAttribute()
    {
        return ! is_null($this->approved_at);
    }

    public function scopeIsApproved($query)
    {
        return $query->whereNotNull('approved_at');
    }

    public function scopeIsNotApproved($query)
    {
        return $query->whereNull('approved_at');
    }

    public function ageGroup()
    {
        return $this->belongsTo(AgeGroup::class);
    }
}
