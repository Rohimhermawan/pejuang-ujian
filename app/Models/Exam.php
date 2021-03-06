<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Exam extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id', 'timestamps'];

    public function scopeFilter($query, array $filters) 
    {
        $query->when($filters['search']??false, function($query, $search) {
            return $query->where('tittle', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%')
                    ->orWhere('excerpt', 'like', '%' . $search . '%');
        });
        
        $query->when($filters['category']??false, function ($query, $category) {
            return $query->whereHas('category', function($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        $query->when($filters['material']??false, function ($query, $material) {
            return $query->whereHas('material', function($query) use ($material) {
                $query->where('slug', $material);
            });
        });
    }
    
    public function category() 
    {
        return $this->belongsTo(Category::class);
    }

    public function material() 
    {
        return $this->belongsTo(Material::class);
    }

    public function question() 
    {
        return $this->hasMany(Question::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
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
