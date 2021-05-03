<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Validator;
class ProductController extends Controller
{

    public function __construct(){
        $this->middleware('auth')->except('index');
    }
    
    public function index(){
        return view('products.index')
                ->withProducts(Product::all());
    }

    public function create(){
        return view('products.create')
                ->withCategories(Category::all());
    }


    public function store(){
        $rules = [
            'name' =>  'required',
            'price' => 'required',
            'category_id' => 'required'
        ];
        $validator = Validator::make(request()->all(),$rules);
        if($validator->fails()){
            return back()->withInput()
                    ->withErrors($validator->errors());
        }

        $product = new Product();
        $product->name=request()->name;
        $product->price=request()->price;
        $product->category_id=request()->category_id;
        $product->created_at=now();
        $product->updated_at=now();
        $product->save();

        return redirect()->route('products.index');
    }

    public function show_category($product){
        return view('categories.show')
                ->withCategory(Product::find($product)->category);
    }

    
}
