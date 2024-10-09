<?php

namespace App\Http\Controllers\Admin\dashboard;

use Exception;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request = request();


        $categories = Category::with('parent')->filter($request->query())->paginate();
        return view("Admin.Dashboard.Categories.index",compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Category::pluck('name', 'id');
        $category = new Category();
        return view("Admin.Dashboard.Categories.create",compact('category','parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $clean_data = $request->validate(Category::rules(), [
            'required' => 'This field (:attribute) is required',
            'name.unique' => 'This name is already exists!'
        ]);

        // Request merge
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);

        $data = $request->except('image');
        $data['image'] = Category::uploadImgae($request);


        // Mass assignment
        $category = Category::create( $data );

        // PRG
        return redirect()->route("admin.categories.index")
            ->with('success', 'Category created!');
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
                try {
            $category = Category::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route("admin.categories.index")
                ->with('info', 'Record not found!');
        }

        // SELECT * FROM categories WHERE id <> $id
        // AND (parent_id IS NULL OR parent_id <> $id)
        $parents = Category::where('id', '<>', $id)
            ->where(function($query) use ($id) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $id);
            })
            ->pluck('name', 'id');

        return view("Admin.Dashboard.Categories.edit", compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $request->validate(Category::rules($id));

        $category = Category::findOrFail($id);

        $old_image = $category->image;

        $data = $request->except('image');
        $new_image = Category::uploadImgae($request);

        if ($new_image) {
            $data['image'] = $new_image;
        }

        $category->update( $data );
        //$category->fill($request->all())->save();

        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }

        return Redirect::route("admin.categories.index")
            ->with('success', 'Category updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        //Category::where('id', '=', $id)->delete();
        //Category::destroy($id);

        return Redirect::route("admin.categories.index")
            ->with('success', 'Category deleted!');
    }
}
