<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','slug','image','status','featured'
    ];




    public function products()
    {
        return $this->hasMany(Product::class,'brand_id','id');
    }

    /*
    //
    *
    *
    * Scopes
    **
    *
    // *
    */


    public function scopeFilter(Builder $builder, $filters)
    {

        $builder->when($filters['name'] ?? false, function($builder, $value) {
            $builder->where('brands.name', 'LIKE', "%{$value}%");
        });

        $builder->when($filters['status'] ?? false, function($builder, $value) {
            $builder->where('brands.status', '=', $value);
        });

    }


    /*
    //
    *
    *
    * General Functios
    **
    *
    // *
    */


    public static function rules(){
        return [
            'name' => ['required', 'string', 'max:255'],
            'status' => [ 'in:active,draft,inactive'],
            'featured' => ['boolean'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ];
    }




    public static function uploadImgae(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }

        $file = $request->file('image'); // UploadedFile Object

        $path = $file->store('brands', [
            'disk' => 'public'
        ]);

        return $path;
    }




    /*
    //
    *
    *
    * Accrssors
    **
    *
    // *
    */


    public function getImageUrlAttribute()
    {
        if(!$this->image){
            return asset("assetDashboard/assets/images/default_image.png");
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset("storage/" . $this->image);
    }







}
