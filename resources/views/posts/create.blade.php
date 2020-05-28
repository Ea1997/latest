@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">


    <ul class="navbar-nav mr-auto">
    @foreach($data as $d)
      <li class="nav-item active">
        <a class="nav-link" href="/categorie/{{$d->id}}">{{$d->nom}} <span class="sr-only">(current)</span></a>
      </li>

      @endforeach

    </ul>
    <form action="/search" method="post" class="form-inline my-2 my-lg-0">
    {{ csrf_field() }}
      <input class="form-control mr-sm-2" type="search" placeholder="Search" name="Search">
      <select name="ville" class="form-control mr-sm-2" >
      <option value="0" >Maroc</option>
@foreach($ville as $v)

<option value="{{$v->id}}"  >{{$v->nom}}</option>
@endforeach
      </select>
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">chercher</button>
    </form>
  </div>
</nav>
<div class="col-md-12">
            <div class="card">


                <div class="card-body">
                <div class="row pt-6">

@foreach(Auth()->user()->item as $post)



<div class="col-4 pb-5">
<div class="card">
            <div class="card-header">{{$post->titre}}</div>

            <div class="card-body">
<img src="/storage/{{ $post->image }}" class="w-100" alt="photo">

Catégorie :<h6>{{$post->categorie->nom}}</h6>
Déscription :
<p>{{$post->description}}</p>
<form action="/item/create" method="POST">
@csrf
<input type="hidden" name="id" value="{{$post->id}}">
<button type="submit" class="btn btn-primary">Utiliser cet objet</button>
</form>
</div>
        </div>
    </div>

@endforeach

</div>
<a href="/item/create"><button type="button" class="btn btn-outline-primary btn-lg">Ajouter un nouveau objet</button><a>
                </div>
            </div>
        </div>

    </div>
</div>





@endsection
