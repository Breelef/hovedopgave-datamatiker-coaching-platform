<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgeGroup extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function trainingPlans()
    {
        return $this->hasMany(TrainingSession::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
