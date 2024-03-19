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

    public function searchProduct($name,$page = null){
        return $this -> where('title','like','%'.$name.'%')->paginate($page);
    }

    public function getLatest($page)
    {
        return $this->orderBy('created_at', 'desc')->paginate($page);
    }
    
}
