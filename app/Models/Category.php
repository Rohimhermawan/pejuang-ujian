<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasFactory, sluggable;
    protected $guarded = ['id', 'timestamps'];

    public function post () {
        return $this->hasMany(Post::class);
    }

    public function exam () {
        return $this->hasMany(Exam::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
