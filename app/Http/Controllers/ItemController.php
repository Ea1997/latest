<?php

namespace App\Http\Controllers;
use Intervention\Image\Facades\Image;
use App\Item;
use Illuminate\Http\Request;
use App\Categorie;
use App\Post;
use App\Ville;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
$ville=Ville::all();
        $data=Categorie::all();
        $id=request('id');

        if($id != null){

            $result=Item::find($id);

            return view('items.recreate',compact('data','result','ville'));
        }
else{
    return view('items.create',compact('data','ville'));
}

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data=request()->validate(  [
            'titre'=>'required',
            'description'=>'required',
            'image'=>['required','image'],
            'categorie'=>'required',
            'prix'=>'required',
            'date_dispo'=>'required',
            'date_fin_dispo'=>'required',
            'premium'=>'',
            'ville'=>'required'
          ]);
          if($data['date_dispo'] > date('Y-m-d') && $data['date_fin_dispo'] > $data['date_dispo']){

if($data['prix']>0){


         if(!isset($data['premium'])){
$data['premium']=false;
         }else{
            $data['premium']=true;
         }

          $imagepath=request('image')->store('items','public');
          $image=Image::make("storage/{$imagepath}")->fit(1200,1200);
          $image->save();

          $datae=auth()->user()->item()->create([
              'titre'=>$data['titre'],
               'description'=>$data['description'],
               'categorie_id'=>$data['categorie'],
                'image'=>$imagepath,



               ]);

               Post::create([
                   'item_id'=>$datae['id'],
                   'user_id'=>auth()->user()->id,
                   'categorie_id'=>$data['categorie'],
                'prix'=>$data['prix'],
                'date_dispo'=>$data['date_dispo'],
                'date_fin_dispo'=>$data['date_fin_dispo'],
                'premium'=>$data['premium'],
                'ville_id'=>$data['ville']
                 ]);
                return redirect('/profile/'.auth()->user()->id);}
                else{
                    $ville=Ville::all();
                    $data=Categorie::all();
                    $message="Le prix doit étre positif";
                    return view('items.create',compact('message','data','ville'));
                }
            }else{
                $ville=Ville::all();
                $data=Categorie::all();
                $message="veuillez entrer des dates valides";
                return view('items.create',compact('message','data','ville'));
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
    public function restore(){
        $data=request(['item_id','prix','categorie','date_dispo','date_fin_dispo','premium','ville']);
        if($data['date_dispo'] > date('Y-m-d') && $data['date_fin_dispo'] > $data['date_dispo']){

            if($data['prix']>0){
        if(!isset($data['premium'])){
            $data['premium']=false;
                     }else{
                        $data['premium']=true;
                     }
        Post::create([
            'item_id'=>$data['item_id'],
            'categorie_id'=>$data['categorie'],
            'user_id'=>auth()->user()->id,
         'prix'=>$data['prix'],
         'date_dispo'=>$data['date_dispo'],
         'date_fin_dispo'=>$data['date_fin_dispo'],
         'premium'=>$data['premium'],
         'ville_id'=>$data['ville']
          ]);
         return redirect('/profile/'.auth()->user()->id);}
         else{
             $result->id=$data['item_id'];
             $result->categorie_id=$data['categorie'];
            $data=Categorie::all();
            $ville=Ville::find();
            $message="Le prix doit étre positif";
            return view('items.recreate',compact('message','data','result','ville'));
        }
    }else{

        $result['id']=$data['item_id'];

        $result['categorie_id']=$data['categorie'];
        $data=Categorie::all();
        $ville=Ville::all();
        $message="veuillez entrer des dates valides";
        return view('items.recreate',compact('message','data','result','ville'));
    }
    }
}
