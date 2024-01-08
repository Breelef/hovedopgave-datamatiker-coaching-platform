<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function ageGroup()
    {
        return $this->belongsTo(AgeGroup::class);
    }

    public function trainingPlans()
    {
        return $this->hasMany(TrainingPlan::class);
    }

    public function getTeamNameAttribute()
    {
        return $this->club->name.'-'.$this->ageGroup->name;
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
