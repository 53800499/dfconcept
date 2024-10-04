<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Category;
use App\Product;
use App\Client;
use App\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ClientController extends Controller
{
    //

    public function home() {
        $produit= Product::get();
        return view('client.home')->with('produit',$produit);
    }

    public function shop() {
        $categorie = Category::get();
        $produit = Product::get();
        return view('client.shop')->with('categorie',$categorie)->with('produit',$produit);
    }

    public function ajouter_panier($id){

        $produit = Product::find($id);

        
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($produit, $id);
        Session::put('cart', $cart);

        //dd(Session::get('cart'));
        return redirect::to('/shop');

    }

    public function panier() {
        if(!Session::has('cart')){
            return view('client.cart');
        }

    $oldCart = Session::has('cart')? Session::get('cart'):null;
    $cart = new Cart($oldCart);
    return view('client.cart', ['products' => $cart->items]);

    }

    public function modifier_panier(Request $request,$id){
        
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->updateQty($request->id, $request->quantity);
        Session::put('cart', $cart);

        //dd(Session::get('cart'));
        return redirect::to('/panier');
    }

    public function retirer_produit_panier($id){

        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
       
        if(count($cart->items) > 0){
            Session::put('cart', $cart);
        }
        else{
            Session::forget('cart');
        }

        //dd(Session::get('cart'));
        return redirect::to('/panier 
        ');
    }

    public function paiement() {

        if (!Session::has('client')) {
            # code...
            return view('client.login');
        }

        if (!Session::has('cart')) {
            # code...
            return view('client.cart');
        }
        return view('client.checkout');
    }

    public function creer_compte(Request $request){
       $this->validate($request,['email'=>'required|unique:clients',
                                 'password'=>'required|min:4']); 
      
    $client = new Client();
    $client -> email = $request->input('email');
    $client -> password = bcrypt($request->input('password')) ;
    $client -> save();
    return back()->with('status','Votre compte a été créé avec succès');
    }

    public function acceder_compte(Request $request){

        $this->validate($request,['email'=>'required',
                                  'password'=>'required|min:4']); 
      
    
    $client = Client::where('email',$request->input('email'))->first();
    if ($client) {
        # code...
        if (Hash::check($request->input('password'),$client->password)) {
            # code...
            Session::put('client',$client);

            return redirect('/shop');
        }
        else {
            # code...
            return back()->with('status','Mauvais mot de pass ou email');
        }
    }else {
        # code...
        return back()->with('status','Vous n\'avez pas de compte');
    } 
}                              

    public function login() {
        return view('client.login');
    }

    public function signup() {
        return view('client.signup');
    }

    public function logout() {
        Session::forget('client');
        return back();
    }
}
