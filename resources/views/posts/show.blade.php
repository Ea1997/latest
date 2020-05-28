@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
  <div class="col-6">
    <img src="/storage/{{$post->item->image}}" alt="post" class="w-100">
  </div>
  <div class="col-6">
    <div class="d-flex align-items-center">
      <div class="pr-2">
        <img src="{{$post->user->profile->profileImage()}}" style="width:50px;" class=" rounded-circle mr-0"  alt="">
      </div>
      <div class="font-weight-bold d-flex align-items-center">
      <a href="/profile/{{$post->user->id}}" class="mr-3 ml-0"><span class="text-dark">{{$post->user->name.' '.$post->user->prenom}}</span></a>

      @if(Auth()->check() && $post->user->id == auth()->user()->id)

         <form  action="/post/{{$post->id}}" method="post">
    @csrf
  @method('DELETE')

          <button class="btn btn-primary" style="margin-left: 0.4px;">Supprimer cette annonce</button>

      </form>
      @endif
      </div>

    </div>

    <hr>
      <p><strong><span class="text-dark">Titre : </strong>{{$post->item->titre}}</span></a><br><strong>Description : </strong>{{$post->item->description}}<br><strong>Prix : </strong>{{$post->prix}} DH / Jour<br><strong>Ville :</strong><a href="/ville/{{$post->ville->id}}">{{$post->ville->nom}}</a></p>
<hr>
Catégorie :
<h6><a href="/categorie/{{$post->item->categorie->id}}">{{$post->item->categorie->nom}}</a></h6>
<hr>
@if (Auth::check())
<h4>Note : </h4>
<?php
$rates=$post->item->rating->avg('rate');
$review=(object)['rate'=>$rates];

for($i=0; $i<5; ++$i){

    echo '<i class="fa fa-star',($review->rate<=$i?'-o':''),'" aria-hidden="true"></i>';
}
?><hr>
  <h5>Commentaires : </h5>
     <div id="comment">



     @foreach($post->item->comments as $comment)
     <div class="d-flex">
     <a href="/profile/{{$comment->user->id}}"><strong>{{$comment->user->name}}</strong></a> :
         @if($comment->avis == 1)
     <p style="color:blue">{{$comment->comment}}</p>
     @else
    <p style="color:red">{{$comment->comment}}</p>
     @endif


</div>
  @endforeach

  </div>





@if(Auth()->user()->id!=$post->user->id)
<a class="btn btn-primary mt-2" href="/order/{{$post->id}}">Louer cet objet</a>
@endif





@else
<h5>Merci de se connecter pour pouvoir consulter les commentaires</h5>
<a href="/login"><button class="btn btn-primary">Se connecter</button></a>
@endif<hr>

  </div>

</div>




</div>
@endsection
