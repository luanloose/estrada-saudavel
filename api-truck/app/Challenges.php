<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Challenges extends Model
{
	protected $table = 'challenges';

    protected $fillable = [
        'points'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    
    public function game()
    {
    	return $this->belongsTo(Games::class);
    }
}
