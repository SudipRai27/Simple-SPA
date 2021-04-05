<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlogRepository
{
    private $model;

    public function __construct()
    {
        $this->model = 'App\Models\Blog';
    }

    public function create(array $data)
    {
        return $this->model::create($this->createUpdateArray($data));
    }

    public function getAllBlogs()
    {
        return $this->model::orderBy('created_at', 'DESC')->get();
    }

    public function getById(int $id)
    {
        $blog = $this->model::find($id);
        if (!$blog) {
            throw new ModelNotFoundException('Blog not found with an id of ' . $id);
        }
        return $blog;
    }

    public function createUpdateArray(array $data)
    {
        return [
            'title' => $data['title'],
            'description' => $data['description']
        ];
    }

    public function update(array $data, int $id)
    {
        $blog = $this->getById($id);
        $blog->touch();
        return tap($blog)->update($this->createUpdateArray($data));
    }

    public function delete(int $id)
    {
        $blog = $this->getById($id);
        return $blog->delete();
    }
}