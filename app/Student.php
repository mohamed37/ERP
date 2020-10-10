<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;


class Student extends Model
{
    use softDeletes;
  protected $fillable = ['first_name','last_name', 
                          'email', 'password', 
                          'gender', 'birthday',
                          'phone', 'age', 
                          'address', 'city', 
                          'country','image','active'];  
    
    public function getImagePathAttribute()
    {
        return asset('uploads/students_images/'. $this->image);
    }
}
