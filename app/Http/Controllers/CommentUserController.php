<?php

namespace App\Http\Controllers;

use App\Comment;
use App\rating;
use App\Post;
use App\Item;
use App\Categorie;
use App\Order;
use App\User;
use App\CommentUser;
use Illuminate\Http\Request;

class CommentUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
       $user=User::find($user_id);

       return view ('comment.commentuserindex',compact('user'));

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
    public function store(Request $request, $user_id,$order_id)
    {

        $data=request()->validate(  [
            'comment'=>'required',
            'avis'=>'required'

          ]);

          $user=User::find($user_id);

        $comment=new CommentUser();
        $comment->user_id=auth()->user()->id;
        $comment->profile_id=$user->profile->id;
        $comment->comment=$request->comment;
        $comment->avis=$request->avis;
        $comment->save();
        $order=Order::find($order_id);
        $order->commented_by_partenaire = true;
        $order->save();
        return redirect()->route('home');
        }


    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show($user_id,$orders_id)
    {

        $user=User::find($user_id);
        $data=Categorie::all();
        return view ('comment.commentuser',compact('data','user','orders_id'));
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
