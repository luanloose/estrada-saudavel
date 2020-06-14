<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
	protected $table = 'games';

    protected $fillable = [
        'km_route','total_points'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
