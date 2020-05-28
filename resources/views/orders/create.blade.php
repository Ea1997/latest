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
@if(isset($message))
    <div class="alert alert-danger" role="alert">
  {{$message}}
</div>
@endif
<div class="col-md-8">
            <div class="card">
                <div class="card-header">Durée de location de  {{$post->item->titre}} souhaitée Disponible de {{$post->date_dispo}} jusqu'a {{$post->date_fin_dispo}}</div>

                <div class="card-body">

                <form method="POST" action="/order" enctype="multipart/form-data">
                        @csrf


<input type="hidden" name="post_id" value="{{$post->id}}">

                        <div class="form-group row">
                            <label for="date_debut_location" class="col-md-4 col-form-label text-md-right">{{ __('De :') }}</label>

                            <div class="col-md-6">
                                <input id="date_debut_location" type="date" class="form-control @error('date_debut_location') is-invalid @enderror" name="date_debut_location" value="{{ old('date_debut_location')}}" required autocomplete="date_debut_location">

                                @error('date_debut_location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date_fin_location" class="col-md-4 col-form-label text-md-right">{{ __("Jusqu'à") }}</label>

                            <div class="col-md-6">
                                <input id="date_fin_location" type="date" class="form-control @error('date_fin_location') is-invalid @enderror" name="date_fin_location" value="{{ old('date_fin_location')}}" required autocomplete="date_fin_location">

                                @error('date_fin_location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Louer') }}
                                </button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
