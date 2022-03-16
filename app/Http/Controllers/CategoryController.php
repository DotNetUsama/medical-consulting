<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index() {
        return view('pages/categories/index', ['categories' => $this->categoryRepository->all()]);
    }

    public function createForm() {
        return view('pages/categories/create');
    }

    public function create(CreateCategoryRequest $request) {
        $categoryData = $request->validated();
        try {
            $this->categoryRepository->create($categoryData);
            return redirect(route('categories.index'));
        } catch (\Exception $exception) {
            session()->flash('danger', 'sorry, something went wrong, please try again later.');
            return redirect(route('categories.create.form'));
        }
    }

    public function delete(Category $category) {
        try {
            $category->delete();
            return redirect(route('categories.index'));
        } catch (\Exception $exception) {
            session()->flash('danger', 'sorry, something went wrong, please try again later.');
            return redirect(route('categories.index'));
        }
    }
}
