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
            <div class="card">


                <div class="card-body">
                <div class="container">
    @if(isset($message))
    <h1>{{$message}}</h1>
    @endif
    @if(isset($post))

    <h2>Résultat des annonces</h2>

    <table class="table table-striped">
        <thead>
            <tr>
            <th></th>
                <th>Titre</th>
                <th>Description</th>
                <th>prix</th>
                <th>date d'annonce</th>
                <th>date d'annonce</th>


            </tr>
        </thead>
        <tbody>
            @foreach($post as $post)
            @foreach($post->post as $posts)
            @if(isset($v))

            @if($posts->ville_id == $v->id)
            <tr>

            <td><a href="/post/{{$posts->id}}"><img style="width:100px;" src="/storage/{{$posts->item->image}}" alt=""></a></td>
                <td><a href="/post/{{$posts->id}}">{{$posts->item->titre}}</a></td>
                <td>{{$posts->item->description}}</td>
                <td>{{$posts->prix}} MAD/jour</td>
                <td><a href="/profile/{{$posts->user->id}}">{{$posts->user->name.' '.$posts->user->prenom}}</a></td>
                <td>{{$posts->created_at}}</td>

            </tr>
            @endif
@else


<tr>

<td><a href="/post/{{$posts->id}}"><img style="width:100px;" src="/storage/{{$posts->item->image}}" alt=""></a></td>
    <td><a href="/post/{{$posts->id}}">{{$posts->item->titre}}</a></td>
    <td>{{$posts->item->description}}</td>
    <td>{{$posts->prix}} MAD/jour</td>
    <td><a href="/profile/{{$posts->user->id}}">{{$posts->user->name.' '.$posts->user->prenom}}</a></td>
    <td>{{$posts->created_at}}</td>

</tr>

@endif
            @endforeach
            @endforeach
        </tbody>
    </table>
    @endif
    <hr>
    @if(isset($categorie))

<h2>Résulats des catégories</h2>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Nom de catégorie</th>

        </tr>
    </thead>
    <tbody>
        @foreach($categorie as $post)
        <tr>
            <td><a href="/categorie/{{$post->id}}">{{$post->nom}}</a></td>

        </tr>
        @endforeach
    </tbody>
</table>
@endif
</div>



                </div>
            </div>
        </div>

    </div>
</div>
@endsection
