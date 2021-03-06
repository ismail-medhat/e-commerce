<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $table = 'subcategories';
    protected $fillable = [
        'subcategory_name',
        'category_id',
    ];
    protected $hidden = [
        'pivot',
    ];
    public $timestamps = true;

    /* The Relationship between categories table and subcategories table */
    public function category()
    {
        return $this->belongsTo('App\Model\Admin\Category');
    }
}
