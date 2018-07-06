@extends('layouts.app')

@include('backend.partial.navpartial')

@section('content')
    <div class="container">
        <div class="row">
            @auth
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="display:inline-block; width:100%">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>All Player </h3>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-info btn-md pull-right" id="create-player-btn" style="text-align:right">
                                        Create New Player
                                    </button>
                                </div>
                            </div>
                            <div class="create-player" id="create-player" style="display:none">
                                <div class="row">
                                    {{ Form::open([ 'url' => '/api/players', 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'create-player-form', 'name'=>'create-player-form']) }}
                                        <div class="col-md-2">
                                            Enter player First Name
                                            <input type="text" name="first_name" class="form-control" value="">
                                        </div>
                                        <div class="col-md-2">
                                            Enter player Last Name
                                            <input type="text" name="last_name" class="form-control" value="">
                                        </div>
                                        <div class="col-md-3">
                                            Enter player Logo URL
                                            <input type="text" name="image_url" class="form-control" value=""> 
                                        </div>
                                        <div class="col-md-3">
                                            Choose Team
                                            @if(isset($teams))
                                                <select name="team_id" class="form-control">
                                                    <option value="">Choose team</option>
                                                    @foreach ($teams as $team)
                                                            <option value="{{$team['id']}}">{{$team['name']}}</option>
                                                    @endforeach
                                                </select>
                                            @else 
                                                <input type="text" name="team_id" class="form-control" value="">
                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            Action<br>
                                            <input type="submit" name="save" value="Save" id="creat-player-save" class= 'btn btn-info'>
                                            <input type="button" name="creat-player-cancel" value="Cancel" id="player-save-cancel" class= 'btn btn-warning'>
                                        </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                            

                        </div>

                        <div class="panel-body" id="player-data">
                            
                        </div>
                    </div>
                </div>
            @endauth
        </div>
    </div>
@endsection 

@section('after-scripts')

    <script>
        var playerId = '';

        function loadPlayerData( playerData, teamData ) {
            $.post(
                "/admin/partial/playerview", 
                {data:playerData, team:teamData}, 
                function(data, status){
                    $("#player-data").html(data.data);
                },
                "json"
            );
        }

        $.ajax({
            method: 'GET', // Type of response and matches what we said in the route
            url: '/api/players', // This is the url we gave in the route
            dataType: "json",
            success: function(response){ // What to do if we succeed
                if(response.status.success === true ){
                    var teamData = null;
                     $.get(
                        "/api/teams", 
                        function(data, status){
                            loadPlayerData(response.data, data.data);
                        },
                        "json"
                    );

                } else {
                    $("#player-data").html("<p>No data found</p>");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                $("#player-data").html("<p>No data found</p>");
            }
        });

        $(document).on('click', '#edit-player-btn', function(e){
            if ( playerId ){
                $('#edit-player-'+playerId).hide('slow');
                $('.edit-player-btn-'+playerId).attr('disabled', false);
            }
            playerId = $(this).attr('playerId');
             $(this).attr('disabled', true);
            $('#edit-player-'+playerId).show('slow');
        });

        $(document).on('click', '#player-save-cancel', function(e){
            $('.edit-player-btn-'+playerId).attr('disabled', false);
            $('#edit-player-'+playerId).hide('slow');
        });

        $(document).on('click', '#player-save', function(e){
            e.preventDefault();
            var formData = $('#player-edit-form').serialize();

            $.ajax({
                type: "PUT",
                url: $('#player-edit-form').attr('action'),// where you wanna post
                data: formData,
                dataType: "json",
                error: function(jqXHR, textStatus, errorMessage) {

                    alert("Error in updating player. Please try again!"); // Optional
                    
                },
                success: function(data) {
                    if ( data.status.success == true ) {
                        alert("player has been updated successfully!");
                        location.reload();
                    } else {
                        alert(data.data.validation_errors);
                    }
                } 
            });

        });

        $(document).on('click', '#delete-player-btn', function(e){
            e.preventDefault();
            playerId = $(this).attr('playerId');
            var action = confirm("Are you sure want to delete?");
            if ( action == true ) {
                $.ajax({
                    type: "DELETE",
                    url: "/api/players/"+playerId,// where you wanna post
                    dataType: "json",
                    error: function(jqXHR, textStatus, errorMessage) {
                        alert("Error in deleting player. Please try again!"); // Optional
                    },
                    success: function(data) {
                        if ( data.status.success == true ) {
                            alert("player has been deleted successfully!");
                            location.reload();
                        }
                    } 
                });
            }
            

        });

        $('#create-player-btn').on('click', function(){
            $(this).attr('disabled', true);
            $('#create-player').show('slow');
        });

        $('#player-save-cancel').on('click', function(){
            $('#create-player-btn').attr('disabled', false);
            $('#create-player').hide('slow');
        });

        $(document).on('click', '#creat-player-save', function(e){
            e.preventDefault();
            var formData = $('#create-player-form').serialize();

            $.ajax({
                type: "POST",
                url: $('#create-player-form').attr('action'),// where you wanna post
                data: formData,
                dataType: "json",
                error: function(jqXHR, textStatus, errorMessage) {

                    alert("Error in creating player. Please try again!"); // Optional
                    
                },
                success: function(data) {
                    if ( data.status.success == true ) {
                        alert("Player has been created successfully!");
                        location.reload();
                    } else {
                        alert(data.data.validation_errors);
                    }
                } 
            });

        });

        

    </script>

@stop

