<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index(){
        
        $vendors = Vendor::where('status','=','active')->paginate(6);

        return view('front.store.index',compact('vendors'));

    }
}
