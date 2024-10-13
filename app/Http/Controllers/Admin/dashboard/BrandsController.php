<?php

namespace App\Http\Controllers\Admin\dashboard;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request = request();
        $brands = Brand::filter($request->query())->paginate();

        return view("Admin.Dashboard.Brands.index",compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brand = new Brand();
        return view("Admin.Dashboard.Brands.create",compact('brand'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Brand::rules());

        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);

        $data = $request->except('image');

        $data['image'] = Brand::uploadImgae($request);


        // Mass assignment
        $category = Brand::create( $data );

        // PRG
        return redirect()->route("admin.brands.index")
            ->with('success', 'Brand created!');
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
        $brand = Brand::findOrFail($id);
        return view("Admin.Dashboard.Brands.edit",compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $request->validate(brand::rules());

        $brand = brand::findOrFail($id);

        $old_image = $brand->image;

        $data = $request->except('image');
        $new_image = brand::uploadImgae($request);

        if ($new_image) {
            $data['image'] = $new_image;
        }

        $brand->update( $data );


        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }

        return Redirect::route("admin.brands.index")
            ->with('success', 'brand updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        if ($brand->image) {
            Storage::disk('public')->delete($brand->image);
        }
        //Category::where('id', '=', $id)->delete();
        //Category::destroy($id);

        return Redirect::route("admin.brands.index")
            ->with('success', 'Brand deleted!');
    }

    public function toggleFeature(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->featured = $request->input('featured');
        $brand->save();

        return redirect()->route('admin.brands.index')->with('success', 'brand featured status updated!');
    }
}
