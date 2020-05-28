@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-3 p-5">
<img src="{{$user->profile->profileImage()}}" alt="profile" class="rounded-circle w-100" />

    </div>


      <div class="col-9 pt-5">
<div class="d-flex justify-content-between align-items-baseline">

<div class="d-flex align-items-center pb-3">
  <div class="h4">{{ $user->name.' '.$user->prenom }}</div>

</div>

@if(Auth::check() && Auth::user()->id==$user->id)
  <a href="/post/create">Ajouter une annonce</a>
  @endif

</div>
  @if(Auth::check() && Auth::user()->id==$user->id)
  <a href="/profile/{{$user->id}}/edit">modifier votre profile</a>
  @endif

<div class="d-block">
<div class="d-block">
<a href="/profile/{{$user->id}}">Consulter mon profile</a>
</div>
@if(Auth::check() && Auth::user()->id==$user->id)

<div class="pr-5">
<strong class="pr-2">{{$user->adresse}}</strong>


</div>
<div class="pr-5">

  <strong class="pr-2">{{$user->telephone}}</strong>
</div>
@endif
<div class="pr-5">

  <strong class="pr-2">{{$user->email}}</strong>
</div>
</div>



      </div>



      <table class="table table-striped">
        <thead>
            <tr>

                <th>partenaire</th>
                <th>Commantaire</th>



            </tr>
        </thead>
        <tbody>
        @foreach($user->profile->commentuser as $comment)
            <tr>


                <td> {{$comment->user->name}}</td>
                <td>


                @if($comment->avis==1)
      <p style="color:blue">{{$comment->comment}}</p>
      @else
      <p style="color:red">{{$comment->comment}}</p>
      @endif
                </td>

            </tr>

            @endforeach
        </tbody>
    </table>


























  </div>
  </div>
@endsection
