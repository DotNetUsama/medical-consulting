<?php


namespace App\Repositories;


use App\Models\Category;

class CategoryRepository
{
    public function all() {
        return Category::all();
    }

    public function create(array $categoryData) {
        $createdCategory = new Category($categoryData);
        $createdCategory->save();
    }
}
