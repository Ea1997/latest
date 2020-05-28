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
@foreach($ville as $v)
<option value="0" >Maroc</option>
<option value="{{$v->id}}"  >{{$v->nom}}</option>
@endforeach
      </select>
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">chercher</button>
    </form>
  </div>
</nav>
        <div class="col-md-12">
            <div class="card">

@if(isset($message))
<div class="card-header">{{$message}}</div>
@endif
                <div class="card-body">
                <div class="row pt-6">

                @foreach($posts as $post)

@if($post->date_fin_dispo > date('Y-m-d'))
@if($post->premium==1)
<div class="col-4 pb-5">
<div class="card">
            <div class="card-header"><a href="/post/{{$post->id}}"><img src="/storage/{{ $post->item->image }}" class="w-100" alt="photo"></a></div>

            <div class="card-body">
            <p>{{$post->prix}} MAD / jour</p>
<h6><a href="/profile/{{$post->item->user->id}}">{{$post->item->user->name.' '.$post->item->user->prenom}}</a></h6>

<h6><a href="/categorie/{{$post->item->categorie->id}}">{{$post->item->categorie->nom}}</a></h6>



<h3>{{$post->item->titre}}</h3>
<a href="/post/{{$post->id}}"><button class="btn btn-primary">Louer</button></a>
</div>
        </div>
    </div>
    @endif
@endif
@endforeach
@foreach($posts as $post)

@if($post->date_fin_dispo > date('Y-m-d'))
@if($post->premium==0)
<div class="col-4 pb-5">
<div class="card">
<div class="card-header"><a href="/post/{{$post->id}}"><img src="/storage/{{ $post->item->image }}" class="w-100" alt="photo"></a></div>

<div class="card-body">
<p>{{$post->prix}} MAD / jour</p>
<h6><a href="/profile/{{$post->item->user->id}}">{{$post->item->user->name.' '.$post->item->user->prenom}}</a></h6>

<h6><a href="/categorie/{{$post->item->categorie->id}}">{{$post->item->categorie->nom}}</a></h6>



<h3>{{$post->item->titre}}</h3>
<a href="/post/{{$post->id}}"><button class="btn btn-primary">Louer</button></a>
</div>
        </div>
    </div>
    @endif
@endif
@endforeach
</div>
                </div>
            </div>
        </div>
        {{ $posts->links() }}
    </div>
</div>
@endsection
