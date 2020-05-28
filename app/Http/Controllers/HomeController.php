<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorie;
use App\Post;
use App\Item;
use App\Ville;
use \Illuminate\Support\Str;
use App\User;
use Illuminate\Support\Facades\Input;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts=Post::latest()->paginate(9);
        $data=Categorie::all();
$ville=Ville::all();
        return view('home',compact('data','posts','ville'));
    }




    public function search(){
        $data=Categorie::all();
        $text = Request('Search');
        $v=Request('ville');

        $ville=Ville::all();


        if($v =="0"){
            $post = Item::where('titre','LIKE','%'. $text.'%')->get();
            $categorie = Categorie::where('nom','LIKE','%'. $text.'%')->get();
            if( count($post) > 0 || count($categorie) > 0)
                return view('search.result',compact('data','post','categorie','ville'));
            else{
                $message="Aucun resultat est trouvé";
                return view ('search.result',compact('data','message','ville'));
            }
        }else{
            $post = Item::where('titre','LIKE','%'. $text.'%')->get();
            $categorie = Categorie::where('nom','LIKE','%'. $text.'%')->get();
            if( count($post) > 0 || count($categorie) > 0)
                return view('search.result',compact('data','post','categorie','ville','v'));
            else{
                $message="Aucun resultat est trouvé";
                return view ('search.result',compact('data','message','ville'));
            }
        }


    }
    public function showville(Ville $villes)
    {
        $data=Categorie::all();
        $ville=Ville::all();


        $posts= Post::where('ville_id', '=', $villes->id)->latest()->paginate(9);
        if( count($posts) > 0 ){
            return view('villes.show',compact('posts','data','ville'));
        }else{
            $message="0 annonce trouvée dans cette catégorie";
            return view('villes.show',compact('posts','message','data','ville'));
        }
    }

}
