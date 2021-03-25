<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'product_name',
        'product_quantity',
        'product_size',
        'product_color',
        'product_code',
        'product_details',
        'product_price',
        'selling_price',
        'discount_price',
        'video_link',
        'main_slider',
        'mid_slider',
        'hot_new',
        'hot_deal',
        'best_rated',
        'trend',
        'image_one',
        'image_two',
        'image_three',
        'status',
        'category_id',
        'subcategory_id',
        'brand_id',
    ];
    protected $hidden = [
        'pivot',
    ];
    public $timestamps = true;

    /* The Relationship between product table and category table */
    public function category()
    {
        return $this->belongsTo('App\Model\Admin\Category');
    }

    /* The Relationship between product table and brand table */
    public function brand()
    {
        return $this->belongsTo('App\Model\Admin\Brand');
    }
}
