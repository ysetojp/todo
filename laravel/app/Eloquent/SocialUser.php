<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class SocialUser extends Model
{
    protected $fillable = ['provider_name', 'provider_id'];

    public function user()
    {
        return $this->belongsTo('App\Eloquent\User');
    }
}
