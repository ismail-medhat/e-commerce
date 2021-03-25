<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'category_name',
    ];
    protected $hidden = [
        'pivot',
    ];
    public $timestamps = true;

    /* The Relationship between categories table and subcategories table */
    public function subcat()
    {
        return $this->hasMany('App\Model\Admin\Subcategory');
    }

    /* The Relationship between category table and product table */
    public function product()
    {
        return $this->hasMany('App\Model\Admin\Product');
    }

}
