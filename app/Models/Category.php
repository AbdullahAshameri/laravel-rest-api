<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name_ar', 'name_en', 'active', 'created_at', 'apdated_at', 
    ];

    public function scopeSelection()
    {
        
    }
    
}
