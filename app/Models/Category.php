<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $dataTableColumns = [
        'id' => [
            'searchable' => false,
        ],
        'category_title' => [
            'searchable' => true
        ]
    ];

    protected $table = 'categories';

    protected $fillable = [
        'category_title'
    ];

    public function categories()
    {
        return $this->belongsToMany(Blog::class, 'blog_categories', 'category_id', 'blog_id');
    }
}
