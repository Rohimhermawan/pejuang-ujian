<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'timestamps'];

    public function post () {
        return $this->hasMany(Post::class);
    }

    public function exam () {
        return $this->hasMany(Exam::class);
    }
}
