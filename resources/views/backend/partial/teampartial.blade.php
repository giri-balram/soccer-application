@if(isset($teams))

<div class="row">
    <ul class="list-group">
@foreach ($teams as $team)
        <li class="list-group-item list-group-item-action">
            <img class="img-thumbnail" width="60" src="{{$team['logo_url']}}"/>
            {{$team['name']}}
            <button teamId="{{$team['id']}}" type="button" class="btn btn-info btn-md pull-right edit-team-btn-{{$team['id']}}" id="edit-team-btn">
                Edit
            </button> &nbsp;

            <button  teamId="{{$team['id']}}" type="button" class="btn btn-warning btn-md pull-right delete-team-btn-{{$team['id']}}" id="delete-team-btn">
                    Delete
            </button>
            <div class="row">
                <div class="edit-team" id="edit-team-{{$team['id']}}" style="display:none">

                    {{ Form::open([ 'url' => '/api/teams/'.$team['id'], 'method' => 'put', 'class' => 'form-horizontal', 'id' => 'team-edit-form', 'name'=>'team-edit-form']) }}
                        <div class="col-md-4">
                            Enter Team Name
                            <input type="text" name="name" class="form-control" value="{{$team['name']}}">
                        </div>
                        <div class="col-md-4">
                            Enter Team Logo URL
                            <input type="text" name="logo_url" class="form-control" value="{{$team['logo_url']}}"> 
                        </div>
                        <div class="col-md-4">
                            Action<br>
                            <input type="submit" name="save" value="Save" id="team-save" 'class'= 'btn btn-info pull-right'>
                            <input type="button" name="cancel" value="Cancel" id="team-save-cancel" 'class'= 'btn btn-warning pull-right'>
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
        <p> No Team available.</p>
    </div>
@endif