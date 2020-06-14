<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Health extends Model
{
    protected $table = 'health';

    protected $fillable = [
        'height', 'weight', 'is_smoker', 'has_diabetes', 'has_hypertension'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
