<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;

class SliderController extends Controller
{
    //
    public function ajouterslider(){
        return view('admin.ajouterslider');
    }

    public function sauverslider(Request $request){

        $this->validate($request,['description1'=>'required|unique:sliders',
                                  'description2'=>'required',
                                  'slider_image'=>'image|nullable|max:199']);


        if($request->hasFile('slider_image')) {

        // 1:get files name with ext
        $fileNaleWithExt= $request->file('slider_image')->getClientOriginalName();
        // 2:get just files name 
        $fileName= pathinfo($fileNaleWithExt,PATHINFO_FILENAME);
        // 3:get just files extension
        $extension=$request->file('slider_image')->getClientOriginalExtension();
        // 4 : file name to store
        $fileNameToStore=$fileName.'_'.time().'.'.$extension;
        // 5  uploder l'image
        $path=$request->file('slider_image')->storeAs('public/slider_images',
        $fileNameToStore);
        
        }  
        
        else{
        $fileNameToStore='noimage.jpg';
        }
        $slider=new Slider;
        $slider->description1=$request->input('description1');
        $slider->description2=$request->input('description2');
        $slider->slider_image=$fileNameToStore;
        $slider->status=1;
        $slider->save();
        return redirect('/ajouterslider')->with('status','Le slider a été inséré avec succcès !');        
        }
        

        public function slider(){
            
            $slider = Slider::get();
            return view('admin.slider')->with('slider',$slider);
        }

        public function editslider($id){
            $slider = Slider::find($id);

            return view('admin.editslider')->with('slider',$slider);
        }

        public function modifierslider(Request $request,$id){
            $this->validate($request,['description1'=>'required',
                                      'description2'=>'required',
                                      'slider_image'=>'image|nullable|max:199']);

            
            
            
            $slider= Slider::find($id);
            $slider->description1=$request->input('description1');
            $slider->description1=$request->input('description1');

            if($request->hasFile('slider_image')){
                $fileNameWithExt=$request->file('slider_image')->getOriginalFileName();
                $fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
                $extension=$request->file('slider_image')->getOriginalExtension();
                $fileNameToStore=$fileName.'_'.time().'_'.$extension;
                
                $path=$request->file('slider_image')->storeAs('public/slider_images',$fileNameToStore);

                
                if ($slider->description3 != 'noimage.jpg') {
                    Storage::delete('public/slider_images/' . $slider->description3);
                }
            
            $slider->slider_image=$fileNameToStore;
        }
            $slider->update();

            return redirect('/slider')->with('status','Le slider a été modifié avec succè');

        }

        public function supprimerslider($id){
            $slider= Slider::find($id);
            if ($slider->slider_image != 'noimage.jpg') {
                Storage::delete('public/slider_images/' . $slider->slider_image);
            }
            $slider->delete();
            return redirect('/slider')->with('status','Le slider a été supprimé avec succè');
        }
        
        public function activer_slider($id){

            $slider=Slider::find($id);

            $slider->status= 1;
            $slider->update();
    
            return redirect('/slider')->with('status','Le slider a été activé avec succès');
    
            }
            public function desactiver_slider($id){

                $slider=Slider::find($id);
    
                $slider->status= 0;
                $slider->update();
        
                return redirect('/$slider')->with('status','Le slider a été désactivé avec succès');
        
                }     

}
