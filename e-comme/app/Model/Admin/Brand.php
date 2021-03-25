<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    protected $fillable = [
        'brand_name',
        'brand_logo',
    ];
    protected $hidden = [
        'pivot',
    ];
    public $timestamps = true;

    /* The Relationship between brand table and product table */
    public function product()
    {
        return $this->hasMany('App\Model\Admin\Product');
    }
}
