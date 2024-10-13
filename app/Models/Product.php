<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Scopes\VendorScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

        protected $fillable = [
        'name',
        'vendor_id',
        'catetgory_id',
        'slug',
        'SKU',
        'long_description',
        'short_description',
        'regular_price',
        'discount_price',
        'quantitiy',
        'options',
        'image',
        'status',
        'brand_id',
        'featured',
    ];

        protected $casts = [
        'featured' => 'boolean',
        'options' => 'array',
        'regular_price' => 'float',
        'discount_price' => 'float',
        'quantitiy' => 'integer',
        ];


        protected static function booted(){
            static::addGlobalScope('vendor', new VendorScope());
            static::addGlobalScope('product',function(Builder $builder){
                $builder->orderByDesc('id');
            });
        }



        /*
        //
        *
        *
        * Relations
        **
        *
        // *
        */


        public function vendor()
        {
            return $this->belongsTo(Vendor::class,'vendor_id','id');
        }

        public function category()
        {
            return $this->belongsTo(Category::class,'catetgory_id','id');
        }
        public function brand()
        {
            return $this->belongsTo(Brand::class,'brand_id','id');
        }
        public function galleries()
        {
            return $this->hasMany(ProductGallary::class,'product_id','id');
        }

        public function tags()
        {
            return $this->belongsToMany(Tag::class,
            'products_tag',
            'product_id',
            'tag_id',
            'id',
            'id'
            );
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
            // Filter by name
            $builder->when($filters['name'] ?? false, function($builder, $value) {
                $builder->where('products.name', 'LIKE', "%{$value}%");
            });

            // Filter by product status
            $builder->when($filters['status'] ?? false, function($builder, $value) {
                $builder->where('products.status', '=', $value);
            });

            // Filter by discount_price, check explicitly for '1' and '0'
            $builder->when(isset($filters['discount_price']), function ($builder) use ($filters) {
                if ($filters['discount_price'] == "with") {
                    // Retrieve products that have a discount (discount_price is not null)
                    $builder->whereNotNull('products.discount_price');

                } elseif ($filters['discount_price'] == "without") {
                    // Retrieve products that don't have a discount (discount_price is null)
                    $builder->whereNull('products.discount_price');
                }
            });
        }






        public function scopeActive(Builder $builder)
        {
            $builder->where('status', 'active');
        }

        public function scopeDescending(Builder $builder)
        {
            $builder->orderByDesc('id');
        }

        public function scopeInactive(Builder $builder)
        {
            $builder->where('status', 'inactive');
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



        public static function uploadImgae(Request $request)
        {
            if (!$request->hasFile('image')) {
                return;
            }

            $file = $request->file('image'); // UploadedFile Object

            $path = $file->store('products', [
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

        public function getDiscountPercentageAttribute()
        {

            if ($this->discount_price && $this->discount_price < $this->regular_price) {
                return round((($this->regular_price - $this->discount_price) / $this->regular_price) * 100);
            }


            return "No Discount";
        }


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

        public function getCoverImageUrlAttribute()
        {
            if(!$this->image){
                return asset("assetDashboard/assets/images/default_image.png");
            }
            return asset("storage/" . $this->image);
        }







}
