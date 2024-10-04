<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Product;


class ProductController extends Controller
{
    //

    public function ajouterproduit(){

        $categorie = Category::all()->pluck('category_name','category_name');
        return view('admin.ajouterproduit')->with('categorie',$categorie);
    }

    public function sauverproduit(Request $request){

        $this->validate($request,['product_name'=>'required|unique:products',
                                  'product_price'  => 'required',       
                                  'product_category'=>'required',
                                  'product_image'=>'image|nullable|max:400']);
        if($request->hasFile('product_image')) {

            // 1:get files name with ext
            $fileNaleWithExt= $request->file('product_image')->getClientOriginalName();
            // 2:get just files name 
            $fileName= pathinfo($fileNaleWithExt,PATHINFO_FILENAME);
            // 3:get just files extension
            $extension=$request->file('product_image')->getClientOriginalExtension();
            // 4 : file name to store
            $fileNameToStore=$fileName.'_'.time().'.'.$extension;
            // 5  uploder l'image
            $path=$request->file('product_image')->storeAs('public/product_image',
            $fileNameToStore);

        }  

        else{
            $fileNameToStore='noimage.jpg';
        }
        $produit=new Product;
        $produit->product_name=$request->input('product_name');
        $produit->product_price=$request->input('product_price');
        $produit->product_category=$request->input('product_category');
        $produit->product_image=$fileNameToStore;
        $produit->status=1;
        $produit->save();
        return redirect('/ajouterproduit')->with('status','Le produit '.$produit->product_name.' a été inséré avec succcès !');

    }
 
    public function produit(){
        $produit= Product::get();
        return view('admin.produit')->with('produit',$produit);
    }

    public function editproduit($id){
        $categorie=Category::All()->pluck('category_name','category_name');
        $produit = Product::find($id);
        return view('admin.editproduit')->with('produit',$produit)->with('categorie',$categorie);
    }

    public function modifierproduit(Request $request,$id){
        $this->validate($request,['product_name'=>'required|unique:products',
                                'product_price'  => 'required',       
                                'product_category'=>'required',
                                'product_image'=>'image|nullable|max:199']);
        $produit= Product::find($id);
        $produit->product_name=$request->input('product_name');
        $produit->product_price=$request->input('product_price');
        $produit->product_category=$request->input('product_category');

        if($request->hasFile('product_image')) {

            // 1:get files name with ext
            $fileNaleWithExt= $request->file('product_image')->getClientOriginalName();
            // 2:get just files name 
            $fileName= pathinfo($fileNaleWithExt,PATHINFO_FILENAME);
            // 3:get just files extension
            $extension=$request->file('product_image')->getClientOriginalExtension();
            // 4 : file name to store
            $fileNameToStore=$fileName.'_'.time().'.'.$extension;
            // 5  uploder l'image
            $path=$request->file('product_image')->storeAs('public/product_image',
            $fileNameToStore); 
            
            if ($produit->product_image != 'noimage.jpg') {
                Storage::delete('public/produit_images/' . $produit->product_image);
            } 
        
        $produit->produit_image=$fileNameToStore;
    }
        $produit->update();

        return redirect('/produit')->with('status','Le produit a été modifié avec succè');

    }

    public function supprimerproduit($id){
        $produit= Product::find($id);
        if ($produit->product_image != 'noimage.jpg') {
            Storage::delete('public/produit_images/' . $produit->product_image);
        }
        $produit->delete();
        return redirect('/produit')->with('status','Le produit a été supprimé avec succè');
    }
    
    public function activer_produit($id){

        $produit=Product::find($id);

        $produit->status= 1;
        $produit->update();

        return redirect('/produit')->with('status','Le produit a été activé avec succès');
    }

    public function desactiver_produit($id){

        $produit=Product::find($id);

        $produit->status= 0;
        $produit->update();
        
        return redirect('/produit')->with('status','Le produit a été désactivé avec succès');
        
    }
}
