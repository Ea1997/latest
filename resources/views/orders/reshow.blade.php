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
        <a href="/order/commande/historique"><button class="btn btn-primary mb-5">Historique</button></a>
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

                <th>consulter profile du client</th>
                <th>numéro de téléphone du client</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>

            @foreach($user->post as $order)

            @foreach($order->order as $orders)
            <?php  $datefin = \Carbon\Carbon::createFromFormat('Y-m-d', $orders->date_fin_location)    ;  ?>

@if($orders->commented_by_partenaire == 0 && $orders->refused==0)
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
non accépté
@else
accépté
@endif
</td>
<td><a href="/profile/{{$orders->user->id}}">visiter le profile</a></td>
<td>
@if($orders->accepted==0)
non visible
@else
{{$orders->user->telephone}}
@endif
</td>

@if($orders->accepted==0)
<td>
<a href="/order/{{$orders->id}}/accepted"><button class="btn btn-primary">Accepter</button></a>
</td>
<td>
<a href="/order/{{$orders->id}}/refused"><button class="btn btn-primary">Refuser</button></a>
</td>
@elseif($orders->accepted==1 && $dateplus > date('Y-m-d'))
<td><a><button disabled class="btn btn-primary" >Laisser un commentaire</button></a></td>

@elseif($orders->accepted==1 && $dateplus <= date('Y-m-d'))
@if($orders->commented_by_partenaire==0)

<td><a href="/commande/comments/{{$orders->user->id}}/{{$orders->id}}"><button  class="btn btn-primary" >Laisser un commentaire</button></a></td>
@else
<td></td>
@endif

@endif


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
