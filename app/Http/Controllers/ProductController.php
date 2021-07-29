<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
       
        $products = Product::paginate(5);
        return view('product.index',compact('products'));
        
    }

    public function getProductModel($id){
        $products = Product::find($id);
        $product_models = Product::find($id)->product_models;
        $product_models = Product_model::where('product_id', '=', $id)->paginate(5);
        
        
        return view('product-model.index',compact('products','product_models'));
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
      

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();


        return redirect('/products')->with('success', 'Successfully created');
   
    }
    //add Product's model
    public function addProductModel(Request $request,$id)
    {

        $request->validate([
            'name'=>'required',
            
            
            
        ]);
        
        
            
            $product = Product::find($id);
            $product_model = new Product_model();
            $product_model->name = $request->name;
            
            if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $file_name = time().'.'.$extension;
            $file->move(public_path('images'),$file_name);
            $product_model->image = $file_name;
        }else{
            return 'no file selected';
        }

            
            $product->product_models()->save($product_model);
            
            return redirect('products/'.$product-> id.'/product-model')->with('success', 'Successfully created');



        
       
       
       
        
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


        if (Product::where('id', $id)->exists()) {
            $product = Product::find($id);
            $product->name = is_null($request->name) ? $product->name : $request->name;
            $product->description = is_null($request->description) ? $product->description : $request->description;
            $product->save();
    
            return redirect('/products')->with('success', 'Successfully updated');
            
            
            return response()->json([
                "message" => "Product updated successfully",$product
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
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $file_name = time().'.'.$extension;
                $file->move(public_path('images'),$file_name);
                $product_model->image = $file_name;
            }else{
                return 'no file selected';
            }
            
            
            
            $product_model->save();
            return redirect('products/'.$product_model-> product_id.'/product-model')->with('success', 'Successfully updated');
            
            return response()->json([
                $product_model
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
    
            return redirect('/products')->with('success', 'Successfully deleteed');
            
            
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
            return redirect('products/'.$product_model-> product_id.'/product-model')->with('success', 'Successfully Deleted');
            
            
            
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
