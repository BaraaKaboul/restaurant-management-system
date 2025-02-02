<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = ['cat_name'];

    public function meals(){

        return $this->hasMany(Meal::class);
    }
}
