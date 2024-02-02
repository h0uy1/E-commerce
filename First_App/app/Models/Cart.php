<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['quantity','user_id','product_id'];

    public function getProduct()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function sameProduct($user_id,$product_id){
        return $this
        ->where('user_id',$user_id)
        ->where('product_id',$product_id)
        ->get();
    }

    public function deleteCart($id){
        return $this -> where('product_id',$id)->delete();
    }

    public function deleteUserCart($id){
        return $this -> where('user_id',$id)->delete();
    }
}
