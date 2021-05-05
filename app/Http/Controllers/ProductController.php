<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Validator;
use App\Http\Resources\ProductResource;
class ProductController extends Controller
{

    public function __construct(){
        $this->middleware('auth')->except('index');
    }
    
    public function index(){
        // return view('products.index')
        //         ->withProducts(Product::all());
        $products = ProductResource::collection(Product::all());
        return $products;
    }

    public function create(){
        return view('products.create')
                ->withCategories(Category::all());
    }

    protected function validateRequest(){
        return request()->validate(
            [
                'name' =>  'required',
                'price' => 'required',
                'category_id' => 'required|exists:categories,id'
            ]
        );
    }

    public function store(){
        $data = $this->validateRequest();
        $data[] = ['created_at' => now(), 'updated_at' => now()];
        $product = Product::create($data);
        return new ProductResource($product);
    }


    public function show_category($product){
        return view('categories.show')
                ->withCategory(Product::find($product)->category);
    }

    
}
