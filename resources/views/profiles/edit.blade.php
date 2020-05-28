@extends('layouts.app')

@section('content')
<div class="container">
  <form  action="/profile/{{$user->id}}" enctype="multipart/form-data" method="post">
  @csrf
  @method('PATCH')
    <div class="row">
      <div class="col-8 offset-2">
        <div class="row">
          <h1>Modifier votre profile</h1>
        </div>
        <div class="form-group row">
            <label for="telephone" class="col-md-4 col-form-label">telephone</label>


                <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror"  value="{{ old('telephone') ?? $user->telephone}}" name="telephone"  autocomplete="telephone" autofocus>

                @error('telephone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

        </div>
        <div class="form-group row">
            <label for="adresse" class="col-md-4 col-form-label">adresse</label>


                <input id="adresse" type="text" class="form-control @error('adresse') is-invalid @enderror"  value="{{ old('adresse') ?? $user->adresse }}" name="adresse"  autocomplete="adresse" autofocus>

                @error('adresse')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

        </div>
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label">email</label>


                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') ?? $user->email }}" name="email"  autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

        </div>
        <div class="row">
          <label for="image" class="col-md-4 col-form-label">Profile Image</label>
          <input type="file" class="form-control-file" name="image" id="image">
          @error('image')

                  <strong>{{ $message }}</strong>

          @enderror

        </div>
        <div class="row pt-4">
          <button class="btn btn-primary ">Save profile</button>
        </div>
      </div>
    </div>

  </form>
</div>
@endsection
