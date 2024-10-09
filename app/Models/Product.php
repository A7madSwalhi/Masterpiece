<?php

namespace App\Models;

use App\Models\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;



        protected static function booted(){
            static::addGlobalScope('vendor', new VendorScope());
        }

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
        ];






        public function getImageUrlAttribute()
        {
            if(!$this->image){
                return asset("assetDashboard/assets/images/default_image.png");
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


}
