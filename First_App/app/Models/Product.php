<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title','price','image','user_id'];

    public function getUser(){
        return $this -> belongsTo(User::class,'user_id');
    }

    public function searchProduct($name){
        return $this -> where('title','like','%'.$name.'%')->get();
    }

}
