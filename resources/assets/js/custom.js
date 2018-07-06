/**
 * Place any custom jQuery code  in here.
 */
$(function(){
	//ajax requst send token in the header
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
});