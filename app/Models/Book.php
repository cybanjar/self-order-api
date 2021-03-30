<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description'];

    public function books() {
        return $this-> hasMany(Book::class);
    }

    public function ratings() {
        return $this->hasMany(Rating::class);
    }
}
