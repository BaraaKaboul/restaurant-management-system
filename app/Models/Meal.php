<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = ['category','name','description','price','image'];
    protected $guarded = [];

    public function category(){

        return $this->belongsTo(Category::class);
    }
}
