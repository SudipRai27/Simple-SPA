<?php

namespace App\Observers;

use App\Models\Blog;

class BlogObserver
{
    public function created(Blog $blog)
    {
        if (!is_null(request()->category_id) && is_array(request()->category_id)) {
            $blog->categories()->attach(request()->category_id);
        }
        if (request()->hasFile('images')) {
            foreach (request()->file('images') as $image) {
                $blog->addMedia($image)->toMediaCollection('image');
            }
        }
    }

    public function updated(Blog $blog)
    {
        if (!is_null(request()->category_id) && is_array(request()->category_id)) {
            $blog->categories()->sync(request()->category_id);
        }
        if (request()->hasFile('images')) {
            foreach ($blog->getMedia('image') as $media) {
                $blog->deleteMedia($media->id);
            }
            foreach (request()->file('images') as $image) {
                $blog->addMedia($image)->toMediaCollection('image');
            }
        }
    }
}