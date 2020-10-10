<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    protected $fillable = ['review', 'category_id', 'pdf'];
    
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
