<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['category_id', 'name', 'langs', 'tools', 'days', 'image', 'details','status'];
    
    
    public function getImagePathAttribute()
    {
        return asset('uploads/courses_images/'. $this->image);
    }
    
    public function category()
    {
        return $this->belongsTo('App\Category');
       
    }
}
