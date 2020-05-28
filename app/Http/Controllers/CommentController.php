<?php

namespace App\Http\Controllers;

use App\Comment;
use App\rating;
use App\Post;
use App\Item;
use App\Categorie;
use App\Order;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $item_id,$order_id)
    {

        $data=request()->validate(  [
            'comment'=>'required',
            'avis'=>'required',
            'rating'=>'required'
          ]);



        $comment=new Comment();
        $comment->user_id=auth()->user()->id;
        $comment->item_id=$item_id;
        $comment->comment=$request->comment;
        $comment->avis=$request->avis;
        $comment->save();
        $rating=new rating();
        $rating->user_id=auth()->user()->id;
        $rating->item_id=$item_id;
        $rating->rate=$request->rating;
        $rating->save();




        $order=Order::find($order_id);
        $order->commented_by_user = true;
        $order->save();



        return redirect()->route('home');
        }


    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show($id,$order_id)
    {
        $post=Item::find($id);
        $data=Categorie::all();
        return view ('comment.commentpost',compact('data','post','order_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
