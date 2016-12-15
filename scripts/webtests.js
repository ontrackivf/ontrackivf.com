//@codekit-prepend "jquery-1.11.1.min.js"
//@codekit-prepend "modal.js"

// action for this page
function sendAction(id, d1, callback){

	// ajax send the action data
	var ajx = $.get(
		"/t/~actions/default/",
		{user_id:id, data1:d1 },
		function( data ) {
			if(data.error === 0){
				callback;
			}else{
				// this needs to change
				alert('there was an error, please try again. [1]');
			}
		},
		"json"
	);
	ajx.fail( function(){
		// this needs to change
		alert('there was an error, please try again. [2]');
	});
}
