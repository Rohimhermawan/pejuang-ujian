<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = ['id','timestamps'];

    public function category () {
        return $this->belongsTo(Category::class);
    }
    
    public function material () {
        return $this->belongsTo(Material::class);
    }
}
