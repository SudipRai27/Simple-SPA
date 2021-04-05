<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use PhpParser\Node\Expr\Cast\Array_;

class CategoryRepository
{
    private $model;

    public function __construct()
    {
        $this->model = 'App\Models\Category';
    }

    public function getAllCategory()
    {
        return $this->model::orderBy('created_at', 'DESC')->get();
    }

    public function create(array $data)
    {
        return $this->model::create([
            'category_title' => $data['category_title']
        ]);
    }

    public function getCategoryById(int $id)
    {
        $category = $this->model::find($id);
        if (!$category) {
            throw new ModelNotFoundException('Category not found with an Id of ' . $id);
        }
        return $category;
    }

    public function update(array $data, int $id)
    {
        $category = $this->getCategoryById($id);
        $category->category_title = $data['category_title'];
        $category->save();
        return $category;
    }
}