@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Teams</div>

                    <div class="panel-body" id="team-data">
                    	
                    </div>
                </div>
            </div>
	    </div>
    </div>

@endsection

@section('after-scripts')

    <script>

    	$.ajax({
		    method: 'GET', // Type of response and matches what we said in the route
		    url: '/api/teams', // This is the url we gave in the route
		    success: function(response){ // What to do if we succeed
		    	if(response.status.success === true ){
		    		var tdata = response.data;
		    		$.post(
		    			"/load/partial/teamview", 
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

	</script>

@stop






