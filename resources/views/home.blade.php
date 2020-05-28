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
      <input class="form-control mr-sm-2" type="search" placeholder="Chercher" name="Search">
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
            @if(Auth::check())
            @foreach(Auth()->user()->item as $item)
            @foreach($item->post as $post)
            @foreach($post->order as $order)
@if($order->accepted == 0 && $order->refused==0)
<div class="alert alert-danger" role="alert">
Nouvelles demandes de location
</div>

@break
  @endif
            @endforeach
            @endforeach
            @endforeach
            @endif
            <div class="card">


                <div class="card-body">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="/storage/logo/banner.png" style="height:220px;" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="/storage/logo/banner1.png"  style="height:220px;" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="/storage/logo/banner3.png"  style="height:220px;" class="d-block w-100" alt="...">
    </div>

  </div>

  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
                <div class="row pt-6">

@foreach($posts as $post)

@if($post->date_fin_dispo > date('Y-m-d'))
@if($post->premium==1)
<div class="col-4 pb-5">
<div class="card">

            <div class="card-header" ><a href="/post/{{$post->id}}"><img src="/storage/{{ $post->item->image }}" class="w-100" alt="photo"></a></div>

            <div class="card-body">
<p>{{$post->prix}} MAD / jour</p>
<p><strong>Ville :</strong><a href="/ville/{{$post->ville->id}}">{{$post->ville->nom}}</a></p>
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
            <p><strong>Ville :</strong><a href="/ville/{{$post->ville->id}}">{{$post->ville->nom}}</a></p>
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
