@if(isset($teams))

<div class="row">
@foreach ($teams as $team)
    
	    <div class="card col-md-3 team-container" style="padding: 10px;">
	        <img class="card-img-top" width="90%" src="{{$team['logo_url']}}" alt="Card image cap">
	        <div class="card-block">
	            <h4 class="card-title">{{$team['name']}}</h4>
	            <p></p>
	            <a href="team/{{$team['id']}}/players" class="btn btn-primary">View player(s)</a>
	        </div>
	    </div>
	

@endforeach
</div>


@else
    <div class="row">
    	<p> No information available.</p>
    </div>
@endif