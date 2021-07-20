<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Product_model;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Product::all();
        $products = Product::get()->toJson(JSON_PRETTY_PRINT);
        return response($products, 200);
    }

    public function getProductModelById($id){
        
       
        if (Product::where('id', $id)->exists()) {
            $product_models = Product::find($id)->product_models->toJson(JSON_PRETTY_PRINT);
            return response($product_models, 200);
        }else{
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }
       
        

        
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'description'=>'required'

        ]);
        // return Product::create($request->all());

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();

        return response()->json([
        "message" => "new product created"
         ], 201);
   
    }

    public function addProductModel(Request $request, $id)
    {

        $request->validate([
            'name'=>'required',
        ]);
        
        
        if (Product::where('id', $id)->exists()) {
            $product = Product::find($id);
            $product_model = new Product_model();
            $product_model->name = $request->name;
            $product->product_models()->save($product_model);
            return response()->json([
                "message" => "new product's model created"
                 ], 201);
        }else{
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }
       
       
       
        
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $product = Product::find($id);
        // $product->update($request->all());
        // return $product;

        if (Product::where('id', $id)->exists()) {
            $product = Product::find($id);
            $product->name = is_null($request->name) ? $product->name : $request->name;
            $product->description = is_null($request->description) ? $product->description : $request->description;
            $product->save();
    
            return response()->json([
                "message" => "Product updated successfully"
            ], 200);
            
        } else {
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }
    
    }

    public function updateProductModel(Request $request, $id){
        if (Product_model::where('id', $id)->exists()) {
            $product_model = Product_model::find($id);
            $product_model->name = is_null($request->name) ? $product_model->name : $request->name;
            $product_model->save();
    
            return response()->json([
                "message" => "Product's model updated successfully"
            ], 200);
            
        } else {
            return response()->json([
                "message" => "Product's model not found"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return Product::destroy($id);

        if(Product::where('id', $id)->exists()) {
            $product = Product::find($id);
            $product->delete();
    
            return response()->json([
              "message" => "Product deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "Product not found"
            ], 404);
          }
    }

    public function deleteProductModel($id){
        if(Product_model::where('id', $id)->exists()) {
            $product_model = Product_model::find($id);
            $product_model->delete();
    
            return response()->json([
              "message" => "Product's model deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "Product's model not found"
            ], 404);
          }
    }

    /**
     * Search for a name
     *
     * @param  str $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        return Product::where('name', 'like', '%'.$name.'%')->get();
    }
}
