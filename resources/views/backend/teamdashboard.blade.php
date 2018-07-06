@extends('layouts.app')

@include('backend.partial.navpartial')

@section('content')
    <div class="container">
        <div class="row">
            @auth
                <div class="col-md-12">
                    <div class="panel panel-default" >
                        <div class="panel-heading" style="display:inline-block; width:100%">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Teams </h3>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-info btn-md pull-right" id="create-team-btn" style="text-align:right">
                                        Create New Team
                                    </button>
                                </div>
                            </div>
                            <div class="create-team" id="create-team" style="display:none">
                                <div class="row">
                                    {{ Form::open([ 'url' => '/api/teams/', 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'team-create-form', 'name'=>'team-create-form']) }}
                                        <div class="col-md-4">
                                            Enter Team Name
                                            <input type="text" name="name" class="form-control" value="">
                                        </div>
                                        <div class="col-md-4">
                                            Enter Team Logo URL
                                            <input type="text" name="logo_url" class="form-control" value=""> 
                                        </div>
                                        <div class="col-md-4">
                                            Action<br>
                                            <input type="submit" name="save" value="Save" id="team-create-save" class= 'btn btn-info '>
                                            <input type="button" name="cancel" value="Cancel" id="team-create-cancel" class= 'btn btn-warning'>
                                        </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                            

                        </div>

                        <div class="panel-body" id="team-data">
                            
                        </div>
                    </div>
                </div>
            @endauth
        </div>
    </div>
@endsection 

@section('after-scripts')

    <script>
        var teamId = '';

        $.ajax({
            method: 'GET', // Type of response and matches what we said in the route
            url: '/api/teams', // This is the url we gave in the route
            success: function(response){ // What to do if we succeed
                if(response.status.success === true ){
                    $.post(
                        "/admin/partial/teamview", 
                        {data:response.data}, 
                        function(data, status){
                            $("#team-data").html(data.data);
                        },
                        "json"
                    );

                } else {
                    $("#team-data").html("<p>No data found</p>");
                }
                

            },
            error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                $("#team-data").html("<p>No data found</p>");
            }
        });

        $(document).on('click', '#edit-team-btn', function(e){
            if ( teamId ){
                $('#edit-team-'+teamId).hide('slow');
                $('.edit-team-btn-'+teamId).attr('disabled', false);
            }
            teamId = $(this).attr('teamId');
            $(this).attr('disabled', true);
            $('#edit-team-'+teamId).show('slow');
        });

        $(document).on('click', '#team-save-cancel', function(e){
            $('.edit-team-btn-'+teamId).attr('disabled', false);
            $('#edit-team-'+teamId).hide('slow');
        });

        $(document).on('click', '#team-save', function(e){
            e.preventDefault();
            var formData = $('#team-edit-form').serialize();

            $.ajax({
                type: "PUT",
                url: $('#team-edit-form').attr('action'),// where you wanna post
                data: formData,
                dataType: "json",
                error: function(jqXHR, textStatus, errorMessage) {

                    alert("Error in updating team. Please try again!"); // Optional
                    
                },
                success: function(data) {
                    if ( data.status.success == true ) {
                        alert("Team has been updated successfully!");
                        location.reload();
                    } else {
                        alert(data.data.validation_errors);
                    }
                } 
            });

        });

        $(document).on('click', '#delete-team-btn', function(e){
            e.preventDefault();
            teamId = $(this).attr('teamId');
            var action = confirm("Are you sure want to delete?");
            if ( action == true ) {
                $.ajax({
                    type: "DELETE",
                    url: "/api/teams/"+teamId,// where you wanna post
                    dataType: "json",
                    error: function(jqXHR, textStatus, errorMessage) {
                        alert("Error in deleting team. Please try again!"); // Optional
                    },
                    success: function(data) {
                        if ( data.status.success == true ) {
                            alert("Team has been deleted successfully!");
                            location.reload();
                        }
                    } 
                });
            }
        });

        $('#create-team-btn').on('click', function(){
            $(this).attr('disabled', true);
            $('#create-team').show('slow');
        });

        $('#team-create-cancel').on('click', function(){
            $('#create-team-btn').attr('disabled', false);
            $('#create-team').hide('slow');
        });

        $(document).on('click', '#team-create-save', function(e){
            e.preventDefault();
            var formData = $('#team-create-form').serialize();

            $.ajax({
                type: "POST",
                url: $('#team-create-form').attr('action'),// where you wanna post
                data: formData,
                dataType: "json",
                error: function(jqXHR, textStatus, errorMessage) {

                    alert("Error in creating team. Please try again!"); // Optional
                    
                },
                success: function(data) {
                    if ( data.status.success == true ) {
                        alert("Team has been created successfully!");
                        location.reload();
                    } else {
                        alert(data.data.validation_errors);
                    }
                } 
            });

        });
        
        
        

    </script>

@stop

