<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class CategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('view-categories')) {
            abort(403);
        }

        $cats = Category::paginate(10);
        return view('categories.index', ['data' => $cats]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('manage-categories')) {
            abort(403);
        }
        return view('categories.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        if (Gate::denies('manage-categories')) {
            abort(403);
        }

        try {

            Category::create($request->validated());

        } catch (\Exception $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with(['error' => 'An error occurred while trying to create category.']);
        }

        return redirect()->route('categories.index')->with(['success' => 'Category created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        if (Gate::denies('view-categories')) {
            abort(403);
        }
        try {

            $category = Product::with('category')->where('category_id', $category->id)->paginate(5);

        } catch (\Exception $th) {

            Log::error($th->getMessage());
            return back()->with(['error' => 'Not found.']);

        }
        return view('categories.show', ['data' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if (Gate::denies('manage-categories')) {
            abort(403);
        }

        return view('categories.add', ['data' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        if (Gate::denies('manage-categories')) {
            abort(403);
        }

        try {

            $category->update($request->validated());

        } catch (\Exception $th) {
            Log::error($th->getMessage());
            return back()->with(['error' => 'An error occurred while trying to update the category.']);
        }

        return redirect()->route('categories.index')->with(['success' => 'Category updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (Gate::denies('manage-categories')) {
            abort(403);
        }

        try {
            $category->destroy($category->id);
        } catch (\Exception $th) {
            Log::error($th->getMessage());
            return response()->json(['error' => 'Couldn\'t delete the category.'], 400);
        }

        return response()->json(['success' => 'Category deleted successfully.']);
    }
}
