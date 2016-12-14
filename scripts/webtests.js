//@codekit-prepend "jquery-1.11.1.min.js"
//@codekit-prepend "modal.js"


function actionDefault(id,d1){
	var ajx = $.get(
		"/t/~actions/default/",
		{user_id:id, data1:d1 },
		function( data ) {
			if(data.error === '0'){
				window.location = data.redir;
			}else{

			}
		},
		"json"
	);
	ajx.fail( function(){

	});
}
