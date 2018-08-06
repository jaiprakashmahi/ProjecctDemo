<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table = 'organizations';

    protected $fillable=['description','userId','organizationName'];

    public function user()
    {
        return $this->belongsTo('App\User','userId');
    }
}
