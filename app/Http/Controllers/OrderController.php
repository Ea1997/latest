<?php

namespace App\Http\Controllers;

use App\Order;
use App\Post;
use App\Categorie;
use App\Ville;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('auth', ['only' => ['create', 'store', 'edit', 'delete','show']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        $ville=Ville::all();
        $data=Categorie::all();
        return view('orders.create',compact('data','post','ville'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
$post=Post::find($request->post_id);
$data=Categorie::all();
$ville=Ville::all();
if($request->date_debut_location >= $post->date_dispo && $request->date_fin_location <= $post->date_fin_dispo){


        $order=new Order();
        $order->user_id=auth()->user()->id;
        $order->post_id=$request->post_id;
        $order->date_debut_location=$request->date_debut_location;
        $order->date_fin_location=$request->date_fin_location;
        $order->accepted=false;
        $order->refused=false;
        $order->commented_by_user=false;
        $order->commented_by_partenaire=false;
        $order->save();
        return redirect()->route('home');
    }else{
       $message="Désolé mais l'objet est disponible de ".$post->date_dispo." jusqu'a ".$post->date_fin_dispo;
        return view ('orders.create',compact('data','post','message','ville'));
    }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */














    public function show()
    {
        $data=Categorie::all();
$ville=Ville::all();
        $orders= Order::where('user_id', '=', Auth()->user()->id)->get();




        if( count($orders) > 0)
            return view('orders.show',compact('data','orders','ville'));
        else{
            $message="Aucun resultat a été trouvé";
            return view ('orders.show',compact('data','message','ville'));
        }
    }


















    public function reshow()
    {
        $data=Categorie::all();
$ville=Ville::all();
       $user=Auth()->user();


            return view('orders.reshow',compact('data','user','ville'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Order $id)
    {
        $req = Order::find($id->id);

        $req->accepted = true;
        $req->save();
        $data=Categorie::all();

        $user=Auth()->user();


        return redirect()->route('order.reshow');

    }
    public function  reupdate(Order $id)
    {
        $req = Order::find($id->id);

        $req->refused = true;
        $req->save();
        $data=Categorie::all();
$ville=Ville::all();
        $orders= Order::where('user_id', '=', Auth()->user()->id)->get();
        if( count($orders) > 0)
            return view('orders.show',compact('data','orders','ville'));
        else{
            $message="Aucun resultat a été trouvé";
            return view ('orders.show',compact('data','message','ville'));
        }
    }
    public function history()
    {



        $data=Categorie::all();
$ville=Ville::all();
        $orders= Order::where('user_id', '=', Auth()->user()->id)->get();
        if( count($orders) > 0)
            return view('orders.historique',compact('data','orders','ville'));
        else{
            $message="Aucun resultat a été trouvé";
            return view ('orders.historique',compact('data','message','ville'));
        }
    }
    public function historyv()
    {
         $data=Categorie::all();
         $user=Auth()->user();
$ville=Ville::all();
            return view ('orders.historiquev',compact('data','user','ville'));
        }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $order=Order::find($id);
        $order->refused = true;
        $order->save();





        return redirect()->route('order.reshow');
    }
}
