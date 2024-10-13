<?php

namespace App\Http\Controllers\Admin\dashboard;

use Illuminate\Http\Request;
use App\Models\ProductGallary;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class GallariesController extends Controller
{
    public function update ($id,Request $request){

        $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        $img = ProductGallary::findOrFail($id);
        $old_img = $img->image;

        if ($request->hasFile('image')) {
            $data = ProductGallary::uploadImgae($request);
        }

        $img->update( ['image' => $data] );


        if ($old_img && $data) {
            Storage::disk('public')->delete($old_img);
        }

        return redirect(route("admin.products.edit",$img->product->id))->with('success','Image Updated!');

    }

    public function destroy ($id){
        $img = ProductGallary::findOrFail($id);


        $img->delete();

        if ($img->image) {
            Storage::disk('public')->delete($img->image);
        }
        //Category::where('id', '=', $id)->delete();
        //Category::destroy($id);

        return Redirect::route("admin.products.edit",$img->product->id)
            ->with('success', 'Image deleted!');
    }


}
