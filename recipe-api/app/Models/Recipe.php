<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'ingredients',
        'description'
    ];

    public function favourite(){
        return $this->belongsTo(Favourites::class, 'name', 'recipe_name');
    }
}
