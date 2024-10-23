<?php

namespace App\Http\Controllers\admin\dashboard;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $coupons = Coupon::paginate();
        return view("Admin.Dashboard.Coupons.index",compact('coupons'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $coupon = new Coupon();
        return  view('Admin.Dashboard.Coupons.create',compact('coupon'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'coupon_code'=>['required','string'],
            'discount'=>['required','numeric','max:100','min:1'],
            'status'=>['required','boolean'],
            'validity'=>['after:now'],
        ]);


        Coupon::create([
            'coupon_code'=>$request->post('coupon_code'),
            'discount'=>$request->post('discount') /100 ,
            'status'=>$request->post('status'),
            'validity'=>$request->post('validity'),
        ]);

        return Redirect::route("admin.coupons.index")
            ->with('success', 'Coupon Created!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $coupon = Coupon::findOrFail($id);
        return view("Admin.Dashboard.Coupons.edit",compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $coupon = Coupon::findOrFail($id);

        $request->validate([
            'coupon_code'=>['required','string'],
            'discount'=>['required','numeric','max:100','min:1'],
            'status'=>['required','boolean'],
            'validity'=>['after:now'],
        ]);


        $coupon->update([
            'coupon_code'=>$request->post('coupon_code'),
            'discount'=>$request->post('discount') /100 ,
            'status'=>$request->post('status'),
            'validity'=>$request->post('validity'),
        ]);

        return Redirect::route("admin.coupons.index")
            ->with('success', 'Coupon Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return Redirect::route("admin.coupons.index")
            ->with('success', 'Coupon deleted!');
    }
}
