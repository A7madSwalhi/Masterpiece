<?php

namespace App\Http\Controllers\Admin\dashboard;

use App\Models\Tag;
use App\Models\Brand;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $request = request();
        // dd($request);
        $products = Product::filter($request->query())->paginate();

        return view("Admin.Dashboard.Products.index",compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        $gallary= $product->galleries;
        $vendors = Vendor::pluck('shop_name', 'id');
        $brands = Brand::pluck( 'name', 'id');
        $categories = Category::pluck('name', 'id');
        // dd($category);
        return view("Admin.Dashboard.Products.create",compact('product','vendors','brands','categories','gallary'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest  $request)
    {
        $request->validated();
        // dd($request->all());

        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);

        if($request->post('product_colors') || $request->post('product_sizes')){

            $options = [];

            if($request->post('product_colors')){
                $colors =explode(',',$request->post('product_colors'));
                $options['colors'] = $colors;
            }

            if($request->post('product_sizes')){
                $sizes =explode(',',$request->post('product_sizes'));
                $options['sizes'] = $sizes;
            }

            $jsonData = json_encode($options, JSON_PRETTY_PRINT);

            $request->merge([
            'options' => $jsonData
            ]);
        }

        $data = $request->except('image','images','tags');

        $data['image'] = Product::uploadImgae($request);

        $product = Product::create( $data );

        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                $imagePath = $image->store('product_gallary', [
                'disk' => 'public'
                ]);

                $product->galleries()->create(['image' => $imagePath]);
            }
        }




        $tags =explode(',',$request->post('tags'));
        $tag_ids=[];
        foreach($tags as $tag_n){
            $slug = Str::slug($tag_n);
            $tag = Tag::where('slug',$slug)->first();
            if(!$tag){
                $tag = Tag::create([
                    'name'=> $tag_n,
                    'slug' => $slug,
                ]);
            }

            $tag_ids[] = $tag->id;
        }

        $product->tags()->sync($tag_ids);

        return redirect()->route('admin.products.index')->with('success','Product Created!');
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
        $product = Product::findOrFail($id);
        $tags = implode(',', $product->tags()->pluck('name')->toArray());
        // dd($tags );
        $vendors = Vendor::pluck('name', 'id');
        $brands = Brand::pluck( 'name', 'id');
        $categories = Category::pluck('name', 'id');
        $gallary= $product->galleries;


        if($product->options){

            $options =  json_decode($product->options, true);
            $colors =implode(',', $options['colors']) ;
            $sizes =implode(',', $options['sizes']) ;
            // dd($colors,$sizes);
            return view("Admin.Dashboard.Products.edit",compact('product','vendors','brands','categories','tags','gallary','sizes','colors'));

        }else{


            return view("Admin.Dashboard.Products.edit",compact('product','vendors','brands','categories','tags','gallary'));
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);

        $old_images = $product ->galleries;

        // dd($old_images);

        // Validate the request
        $request->validated();

        // Merge the slug based on the product name
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);

        if($request->post('product_colors') || $request->post('product_sizes')){

            $options = [];

            if($request->post('product_colors')){
                $colors =explode(',',$request->post('product_colors'));
                $options['colors'] = $colors;
            }

            if($request->post('product_sizes')){
                $sizes =explode(',',$request->post('product_sizes'));
                $options['sizes'] = $sizes;
            }

            $jsonData = json_encode($options, JSON_PRETTY_PRINT);

            $request->merge([
            'options' => $jsonData
            ]);
        }

        // Get all data except the images and tags fields
        $data = $request->except('image', 'images', 'tags');

        // Handle image upload if new image is provided
        if ($request->hasFile('image')) {
            $data['image'] = Product::uploadImgae($request);
        }

        // Update the product with the new data
        $product->update($data);

        // Handle gallery images if provided
        if ($request->hasFile('images')) {
            // Clear existing galleries
            $product->galleries()->delete();

            // Upload new gallery images
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('product_gallary', [
                    'disk' => 'public'
                ]);

                // Create new gallery entries
                $product->galleries()->create(['image' => $imagePath]);
            }

            foreach ($old_images as $img){
                Storage::disk('public')->delete($img->image);
            }
        }

        // Handle tags
        $tags = explode(',', $request->post('tags'));
        $tag_ids = [];
        foreach ($tags as $tag_n) {
            $slug = Str::slug($tag_n);
            $tag = Tag::where('slug', $slug)->first();

            if (!$tag) {
                $tag = Tag::create([
                    'name' => $tag_n,
                    'slug' => $slug,
                ]);
            }

            $tag_ids[] = $tag->id;
        }

        // Sync the tags with the product
        $product->tags()->sync($tag_ids);

        // Redirect back with a success message
        return redirect()->route('admin.products.index')->with('success', 'Product Updated!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);

        // Delete the product from the database
        $product->delete();

        // Detach the associated tags
        $product->tags()->detach();

        // Check if the product image is not null before trying to delete it
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        // Check if the product has galleries
        if ($product->galleries) {
            foreach ($product->galleries as $gallery) {
                // Check if the gallery image is not null before trying to delete it
                if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                    Storage::disk('public')->delete($gallery->image);
                }
            }

            // Delete the galleries from the database
            $product->galleries()->delete();
        }

        // Redirect back with a success message
        return redirect()->route('admin.products.index')->with('success', 'Product Deleted Successfully!');
    }


    public function toggleFeature(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->featured = $request->input('featured');
        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product featured status updated!');
    }
}
