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
        <a href="/order/historique"><button class="btn btn-primary mb-5">Historique</button></a>
            <div class="card">


                <div class="card-body">
                <div class="container">
    @if(isset($message))
    <h1>{{$message}}</h1>
    @endif

    @if(isset($orders))

    <h2>Vos commandes</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Numéro de commande</th>
                <th>titre d'objet</th>
                <th>Propriétaire</th>
                <th>Durée</th>
                <th>Prix totale</th>
                <th>Status</th>

                <th>numéro de telephone</th>

                <th></th>

            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <?php  $datefin = \Carbon\Carbon::createFromFormat('Y-m-d', $order->date_fin_location)     ;  ?>
            <?php  $dateplus = \Carbon\Carbon::createFromFormat('Y-m-d', $order->date_fin_location)     ;  ?>

            @if($order->commented_by_user==0 && $order->refused == 0)

            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->post->item->titre}}</td>
                <td>{{$order->post->item->user->name." ".$order->post->item->user->prenom}}</td>


               <?php

                    $start_date = \Carbon\Carbon::createFromFormat('Y-m-d', $order->date_debut_location)    ;
  $end_date = \Carbon\Carbon::createFromFormat('Y-m-d', $order->date_fin_location);
  $duree = $start_date->diffInDays($end_date);


?>






                <td>{{$duree}} jours</td>
                <td>{{$duree*$order->post->prix}} MAD</td>

                @if($order->accepted==0 && $order->refused==0)
<td><p style="color:#5cb85c"><strong>en traitement</strong></p></td>
@elseif($order->refused==1)
<td>
<p style="color:#F32013">Refusée par le propriétaire</p>




</td>
@else
<td><p style="color:#0275d8">
accepté par le propriétaire</p>
</td>
@endif
@if($order->accepted==1)
<td>{{$order->post->item->user->telephone}}</td>

@else
<td>non visible</td>
@endif

@if($order->accepted==1 && $dateplus > date('Y-m-d'))
<td><a><button disabled class="btn btn-primary" >Laisser un commentaire</button></a></td>

@elseif($order->accepted==1 && $dateplus <= date('Y-m-d'))
@if($order->commented_by_user==0)
<td><a href="/comments/{{$order->post->item->id}}/{{$order->id}}"><button  class="btn btn-primary" >Laisser un commentaire</button></a></td>
@else
<td></td>
@endif
@else

@endif




                </td>

            </tr>
            @endif
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
