<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreSubCat extends Model
{
    use HasFactory;
    protected $table = "store_subcat";
    public $timestamps = false;
    protected $fillable = [
        'sub_id',
        'categories_id',
        'subcat',
    ];
}