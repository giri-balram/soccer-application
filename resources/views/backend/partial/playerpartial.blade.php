@if(isset($players))

<div class="row">
    <ul class="list-group">
@foreach ($players as $player)
        <li class="list-group-item list-group-item-action">
            <img class="img-thumbnail" width="60" src="{{$player['image_url']}}"/>
            {{$player['first_name']}} {{$player['last_name']}}
            <button playerId="{{$player['id']}}" type="button" class="btn btn-info btn-md pull-right edit-player-btn-{{$player['id']}}" id="edit-player-btn">
                Edit
            </button> &nbsp;

            <button  playerId="{{$player['id']}}" type="button" class="btn btn-warning btn-md pull-right delete-player-btn-{{$player['id']}}" id="delete-player-btn">
                    Delete
            </button>
            <div class="row">
                <div class="edit-player" id="edit-player-{{$player['id']}}" style="display:none">

                    {{ Form::open([ 'url' => '/api/players/'.$player['id'], 'method' => 'put', 'class' => 'form-horizontal', 'id' => 'player-edit-form', 'name'=>'player-edit-form']) }}
                        <div class="col-md-2">
                            Enter player First Name
                            <input type="text" name="first_name" class="form-control" value="{{$player['first_name']}}">
                        </div>
                        <div class="col-md-2">
                            Enter player Last Name
                            <input type="text" name="last_name" class="form-control" value="{{$player['last_name']}}">
                        </div>
                        <div class="col-md-3">
                            Enter player Logo URL
                            <input type="text" name="image_url" class="form-control" value="{{$player['image_url']}}"> 
                        </div>
                        <div class="col-md-3">
                            Choose Player Team
                            @if(isset($teams))
                                <select name="team_id" class="form-control">
                                    <option value="">Choose team</option>
                                    @foreach ($teams as $team)
                                        @if ( $team['id'] == $player['team_id'])
                                            <option value="{{$team['id']}}" selected="selected">{{$team['name']}}</option>
                                        @else
                                            <option value="{{$team['id']}}">{{$team['name']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @else 
                                <input type="text" name="team_id" class="form-control" value="{{$player['team_id']}}">
                            @endif
                        </div>
                        <div class="col-md-2">
                            Action<br>
                            <input type="submit" name="save" value="Save" id="player-save" 'class'= 'btn btn-info pull-right'>
                            <input type="button" name="cancel" value="Cancel" id="player-save-cancel" 'class'= 'btn btn-warning pull-right'>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </li>
    @endforeach
    </ul>
</div>


@else
    <div class="row">
        <p> No player available.</p>
    </div>
@endif