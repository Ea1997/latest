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

    @if(isset($user))

    <h2>Vos commandes</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Numéro de commande</th>
                <th>titre d'objet</th>
                <th>Client</th>
                <th>Durée</th>
                <th>Prix totale</th>
                <th>Status</th>




            </tr>
        </thead>
        <tbody>

            @foreach($user->post as $order)

            @foreach($order->order as $orders)
            <?php  $datefin = \Carbon\Carbon::createFromFormat('Y-m-d', $orders->date_fin_location)    ;  ?>

@if($orders->commented_by_partenaire == 1 || $orders->refused==1)
            <tr>
<td>{{$orders->id}}</td>
<td>{{$orders->post->item->titre}}</td>
<td>{{$orders->user->name.' '.$orders->user->prenom}}</td>
<?php

$start_date = \Carbon\Carbon::createFromFormat('Y-m-d', $orders->date_debut_location)    ;
$end_date = \Carbon\Carbon::createFromFormat('Y-m-d', $orders->date_fin_location);
$duree = $start_date->diffInDays($end_date);


?>
<?php  $dateplus = \Carbon\Carbon::createFromFormat('Y-m-d', $orders->date_fin_location)     ;  ?>
<td>{{$duree}} jours</td>
<td>{{$duree*$orders->post->prix}} MAD</td>
<td>
@if($orders->accepted==0)
<p style="color:red">non accépté</p>
@else
<p style="color:green">accépté</p>
@endif
</td>






</tr>
@endif
@endforeach


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
