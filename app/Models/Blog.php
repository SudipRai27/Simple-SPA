<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    const MEDIA_COLLECTION = 'image';

    protected $fillable = [
        'title',
        'description'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'blog_categories', 'blog_id', 'category_id');
    }

    public function formatApiCategories()
    {
        $categories = [];
        foreach ($this->categories as $category) {
            $newCategory = [];
            $newCategory['id'] = $category->id;
            $newCategory['category_title'] = $category->category_title;
            $newCategory['created_at'] = Carbon::parse($category->created_at)->diffForhumans();
            array_push($categories, $newCategory);
        }
        return $categories;
    }

    public function formatApiImages()
    {
        $images = [];
        foreach ($this->getMedia(Blog::MEDIA_COLLECTION) as $media) {
            $newImage = [];
            $newImage['id']  = $media->id;
            $newImage['url'] = $media->getUrl();
            array_push($images, $newImage);
        }
        return $images;
    }
}