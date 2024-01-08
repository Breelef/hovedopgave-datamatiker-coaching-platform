<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ExerciseTrainingSession extends pivot
{
    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    public function trainingSession()
    {

        return $this->belongsTo(TrainingSession::class);
    }
}
