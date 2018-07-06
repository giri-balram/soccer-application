
<h3>Players</h3>

<hr/>


@if(isset($players))

@foreach ($players as $player)

<div class="card col-md-3" >
    <img class="card-img-top" width="70%" src="{{$player['image_url']}}" alt="Card image cap">
    <div class="card-block">
        <p class="card-text"> {{$player['first_name'].' '.$player['last_name'] }}</p>
    </div>
</div>
    

@endforeach


@else
    <div class="row">
        <p> No information available.</p>
    </div>
@endif