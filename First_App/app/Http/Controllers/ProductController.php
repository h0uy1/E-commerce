<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function createProduct(Request $request){
        $productField = $request->validate([
            'title' => 'required',
            'price' => 'required',
            'image' => 'required'
        ]);
        $filename = '';

        $productField['title'] = strip_tags($productField['title']);
        $productField['price'] = strip_tags($productField['price']);
        $productField['image'] = strip_tags($productField['image']);
        $productField['user_id'] = auth()->id();

        
        if ($request->hasFile('image')) {
            $filename = $request->getSchemeAndHttpHost() . '/assets/' . time() . '.' . $request->image->extension();
        
            $productField['image'] = $filename;
        }
        
        try{
            if(Product::create($productField)){
               $request->file('image')->move(public_path('/assets/'), $filename);
                
            };
        } catch(Exception $e){
            throw $e;
        }
       

        return redirect('/admin');
    }

    public function editScreen(Product $product ){

        return view('edit',['product' => $product]);
    }

    public function editProduct(Product $product, Request $request){
        $oldpathName = $product->image;
        $info = pathinfo($oldpathName);
        $fileName = $info['basename'];
        $path = getcwd();
        
        $productField = $request -> validate([
            'title' => 'required',
            'price' => 'required',
        ]);
        $is_newImage = false;
        $filename = '';
        if($request->hasFile('newImage')){
            $filename = $request->getSchemeAndHttpHost() . '/assets/' . time() . '.' . $request->newImage->extension();
            $productField['image'] = $filename;
            $is_newImage = true;
        }else{
            $productField['image'] = $oldpathName;
        }

        $productField['title'] = strip_tags($productField['title']);
        $productField['price'] = strip_tags($productField['price']);
        $productField['user_id'] = auth()->id();

        try{
            if ($product->update($productField)){
                if($is_newImage){
                    if (file_exists($path . '\assets\\'.$fileName)){
                        unlink($path . '\assets\\'.$fileName);
                    }
                    $request->file('newImage')->move(public_path('/assets/'), $filename);
                }
            }
        }catch(Exception $e){
            throw $e;
        }

        return redirect('/admin');
    }

    public function deleteProduct(Product $product){
        $oldpathName = $product->image;
        $info = pathinfo($oldpathName);
        $fileName = $info['basename'];
        $path = getcwd();

        try{
            if($product->delete()){
                if (file_exists($path . '\assets\\'.$fileName)){
                    unlink($path . '\assets\\'.$fileName);
                }
            }
        }catch(Exception $e){
            throw $e;
        }
        return redirect('/admin');
    }

    public function search(Request $request){
        $name = $request->search;
        $productModel = new Product();
        $products = $productModel->searchProduct($name);
        if (auth()->user()->is_admin ==2){
            return view ('home',['products' => $products]);
        }else{
            return view('user',['products' => $products]);
        }
        
    }

    public function showUser(){
        $products = Product::all();
        if ($products->isEmpty()){
            return view('user',['products' => collect()]);
        }
        return view('user',['products' => $products]);
    }

    public function showAdmin(){
        $products = Product::all();
        if ($products->isEmpty()){
            return view('home',['products' => collect()]);
        }
        return view('home',['products' => $products]);
    }
}
