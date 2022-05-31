<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $table = "store_location";
    public $timestamps = false;
    protected $fillable = [
        'location_id',
        'l_name',
        'l_description',
    ];
}
