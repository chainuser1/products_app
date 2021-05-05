<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Session;
use Validator;
use App\Http\Resources\CategoryResource;
class CategoryController extends Controller
{

    public function __construct(){
        $this->middleware('auth')->except(['index','search']);
    }
    //
    public function index(){
        $categories = CategoryResource::collection(Category::all());
        return $categories;
    }

    

    public function search(){
        $search = request()->search;
        $categories = Category::where('name','LIKE', "%$search%")->get();
        
        request()->session()->put('message', 
                count($categories). ' item/s has been found');
        
        return view('categories.index')
            ->with([
                'categories' => $categories,
            ]);
    }
    public function create(){
        return view('categories.create');
    }

    public function store(){
        $form = ['name' => request()->name,];

        $res = $this->validateProduct($form);

        if($res->fails()){
            return back()->withErrors($res->errors());
        }

        $category = new Category();
        $category->name = request()->name;
        $category->created_at = now();
        $category->updated_at = now();
        $category->save();

        return redirect('/categories');
    }

    public function edit($id){
        $category = Category::where('id',$id)->first();
        // return dd($category);
        return view('categories.create',
            ['name'=>$category->name])->withId($id);
                    
    }

    public function show($id){
        return view();
    }

    public function update($id){
        $form = ['name' => request()->name];

        $res = $this->validateProduct($form);

        if($res->fails()){
            return back()->withErrors($res->errors());
        }

        $category = Category::find($id);
        $category->name = request()->name;
        $category->updated_at = now();
        $category->save();
        return redirect("/category/search?search="
        .request()->name);
                
    }

    public function delete($id){
        Category::destroy($id);
        return redirect()
            ->route('categories')
            ->withMessage("Item $id has been deleted");
                
    }

    public function show_products($id){
        $products = Category::find($id)->products;
        return view('products.index')
                ->withProducts($products);
    }

    //validation functions

    protected function validateProduct($form){
        $rules = ['name' => 'required',
                ];
        $messages = ['required' => ':attribute is required',
                      'max' => 'Do not exceed 10 characters for :attribute'];
        $validator = Validator::make($form,$rules,$messages);

        return $validator;
    }
}
