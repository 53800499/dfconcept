 <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;

class CategoryController extends Controller
{
    //

    public function ajouterCategory(){
        return  view("admin.ajouterCategory");
    }
    
    public function sauvercategorie(Request $request){

        $this->validate($request, ['category_name'=>'required|unique:categories']);

        $categorie = new Category();
        $categorie->category_name=$request->input('category_name');

        $categorie->save();

        return redirect('/ajouterCategory')->with('status','La catégorie '.$categorie->category_name.' a été ajouté avec succè');
    }

    public function categories(){

        $categorie = Category::get();
        return view('admin.categories')->with('categorie',$categorie);
    }

    public function select_par_cat($name){

        $produit= new Product();
        $produit->where('product_category',$name)->where('status',1)->get();
        $categorie = Category::get();
        return redirect('/shop')->with('categorie',$categorie)->with('produit',$produit);
    }


    public function editcategory($id){

        $categorie = Category::find($id);
        return view('admin.editcategory')->with('categorie',$categorie);
    }

    public function modifiercategory(Request $request,$id){

        $this->validate($request,['category_name'=>'required|unique:categories']);
        
        $categorie = Category::find($id);
        $categorie->category_name=$request->input('category_name');

        $categorie->update();

        return redirect('/categories')->with('status','La catégorie '.$categorie->category_name.' a été modifié avec succè');
    }

    public function supprimercategory($id){
        $categorie=Category::find($id);
        $categorie->delete();
        return redirect('/categories')->with('status','La catégorie '.$categorie->category_name.' a été suprimée avec succès');

    }
    
}
                                            