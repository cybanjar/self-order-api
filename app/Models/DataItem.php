<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataItem extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'img', 'item', 'description', 'price', 'qty'];

    public function dataItems()
    {
        return $this->hasMany(DataItem::class);
    }
}
