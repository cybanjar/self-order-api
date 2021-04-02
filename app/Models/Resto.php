<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resto extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_name', 
        'img', 
        'icons', 
        'item_name', 
        'description', 
        'price', 
        'total',
        'qty',
        'note',
        'popular',
        'table',
        'tax',
        'service'
    ];

}
