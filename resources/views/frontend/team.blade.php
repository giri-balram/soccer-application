@extends('layouts.app')

@section('script')

    <script>
        window.team ={{$id}}
    </script>

@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-heading">
                            <img width="80" src="" alt="" id="team-logo"/> <span id="team-name"></span>
                        </div>
                    </div>

                    <div class="panel-body" id="player-data">


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after-scripts')

    <script>
        $.get(
            "/api/teams/{{$id}}",
            function(data){
                if(data.status.success === true ){
                    var logoUrl = "{{url('storage/uploads/teams/')}}/"+data.data.logo_url;
                    $('#team-logo').attr('src', logoUrl);
                    $('#team-name').html(data.data.name);
                }
            },
            "json"
        );

        $.ajax({
            method: 'GET', // Type of response and matches what we said in the route
            url: '/api/teams/{{$id}}/players', // This is the url we gave in the route
            success: function(response){ // What to do if we succeed
                if(response.status.success === true ){
                    $.post(
                        "/load/partial/teamplayerview",
                        {data:response.data},
                        function(data, status){
                            $("#player-data").html(data.data);
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

    </script>

@stop
