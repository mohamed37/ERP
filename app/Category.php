<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    protected $fillable = ['name'];
    
    public function courses()
    {
        return $this->hasMany('App\Course');
    }
    
    public function revisions()
    {
        return $this->hasMany('App\Revision');
    }
}
