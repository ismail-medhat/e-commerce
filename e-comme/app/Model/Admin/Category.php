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
}
