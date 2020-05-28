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

        <div class="col-md-8">
        @if(isset($message))
        <div class="alert alert-danger" role="alert">
  {{$message}}
</div>
@endif
            <div class="card">
                <div class="card-header">Creer un nouveau objet</div>

                <div class="card-body">

                <form method="POST" action="/item" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="titre" class="col-md-4 col-form-label text-md-right">{{ __('Titre') }}</label>

                            <div class="col-md-6">
                                <input id="titre" type="text" class="form-control @error('titre') is-invalid @enderror" name="titre" value="{{ old('titre') }}" required autocomplete="titre" autofocus>

                                @error('titre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description')  }}" required autocomplete="description"></textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>




                        <div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label text-md-right">Image d'objet</label>
                            <div class="col-md-6">

          <input type="file" class="form-control-file" name="image" id="image">
          @error('image')

                  <strong>{{ $message }}</strong>

          @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="categorie" class="col-md-4 col-form-label text-md-right">{{ __('Categorie') }}</label>

                            <div class="col-md-6">
                            <select  name="categorie" >
                 @foreach($data as $d)
                 <option value="{{$d->id}}">{{$d->nom}} </option>
                  @endforeach
                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ville" class="col-md-4 col-form-label text-md-right">{{ __('Ville') }}</label>

                            <div class="col-md-6">
                            <select  name="ville" >
                 @foreach($ville as $v)
                 <option value="{{$v->id}}">{{$v->nom}} </option>
                  @endforeach
                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="prix" class="col-md-4 col-form-label text-md-right">{{ __('prix par jour') }}</label>

                            <div class="col-md-6">
                                <input id="prix" type="number" class="form-control @error('prix') is-invalid @enderror" name="prix" value="{{ old('prix')}}" required autocomplete="prix">

                                @error('prix')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>






                        <div class="form-group row">
                            <label for="date_dispo" class="col-md-4 col-form-label text-md-right">{{ __('Date debut de disponibilité') }}</label>

                            <div class="col-md-6">
                                <input id="date_dispo" type="date" class="form-control @error('date_dispo') is-invalid @enderror" name="date_dispo" value="{{ old('date_dispo')}}" required autocomplete="date_dispo">

                                @error('date_dispo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date_fin_dispo" class="col-md-4 col-form-label text-md-right">{{ __('Date fin de disponibilité') }}</label>

                            <div class="col-md-6">
                                <input id="date_fin_dispo" type="date" class="form-control @error('date_fin_dispo') is-invalid @enderror" name="date_fin_dispo" value="{{ old('date_fin_dispo')}}" required autocomplete="date_fin_dispo">

                                @error('date_fin_dispo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">


<div class="col-md-6">
    <input id="premium" type="checkbox" class="form-control @error('premium') is-invalid @enderror" name="premium" value="true"  autocomplete="premium">

    @error('premium')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<label for="premium" class=" col-form-label text-md-left">{{ __('Premium') }}</label>
</div>





                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Créer') }}
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
