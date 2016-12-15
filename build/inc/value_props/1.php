<?php
	// generate price
	$prices = array('$100', '$250');
	$price = $prices[array_rand($prices)];
?>




<div class="background_container">
	<div class="holder">
		<img class="logo" src="/img/logo_white.png">
	</div>
	<div class="holder">
		<div class="text-content top_padded">
			<h2 class="tagline">Why wonder? Know what to expect. Know you're OnTrack™.</h2>
			<p>Without OnTrack, 15 out of 100 people will make a scheduling or medication mistake during their IVF treatment. OnTrack puts you back in control and let's you know you're doing everything right.</p>
			<div class="button" id="button1">Learn More</div>
		</div>
		<div class="image-content">
			<img src="/img/macbook_iphone.png">
		</div>
	</div>
</div>
<div class="background_container light_back">
	<div class="holder">
		<div class="image-content left">
			<img src="/img/tilted_iphone.png">
		</div>
		<div class="text-content right">
			<ul class="features">
				<li>
					<img src="/img/multi_platform.png">
					<p>OnTrack™ is a cloud-based web application for helping women engaged in fertility treatment manage their treatment better.</p>
				</li>
				<li>
					<img src="/img/med_management.png">
					<p>It keeps track of your medication supply and tells you when you need to get more based on your pharmacy’s hours.</p>
				</li>
				<li>
					<img src="/img/checklist.png">
					<p>OnTrack™ is your personal guide through the IVF treatment process.</p>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="background_container foot_back">
	<div class="holder bottom_call_to_action">
		<h2 class="tagline">Why wonder? Know what to expect. Know you're OnTrack™.</h2>
		<div class="button center" id="button2">Learn More</div>
	</div>
</div>
<div class="background_container black_back foot_back">
	<div class="footer">
		<p>&copy; OnTrack LLC, 2016</p>
	</div>
</div>




<div class="modal-holder" id="email_modal">
	<div class="modal-wrap">
		<div class="modal">
			<i id="modal_close" class="close fa fa-times" aria-hidden="true" onclick="hideModal('email_modal');"></i>

			<div id="modal_content">
				<div class="vision"><p>A world without the pain and uncertainty of infertility</p><span>Our Vision</span></div>
				<h2>Thanks for wanting to learn more about OnTrack!</h2>
				<p>We're currently developing the application. If you would like to know when it's ready, enter your email address and we'll let you know. <i class="fa fa-smile-o" aria-hidden="true"></i></p>
				<p>We will not share your email with anyone.</p>
				<fieldset id="email_form">
					<input type="text" id="email">
					<button id="email_button">Submit</button>
				</fieldset>
				<div><input type="checkbox"> </div>
				<div class="survey">
					<p><a href="#">Also, will you help us out by answering a few additional questions?</a></p>
					<p style="font-size:.7em;">No thanks</p>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="blackout" class="blackout"></div>




<script>
	// action for this page
	function sendAction(d1){

		// get the id from the php varible
		var id = '<?php echo $user_id ?>';

		// ajax send the action data
		var ajx = $.get(
			"/t/~actions/default/",
			{user_id:id, data1:d1 },
			function( data ) {
				if(data.error === 0){
					showModal('email_modal');
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

	// first button
	$('#button1').click(function(){
		// check if button is checked

		//data json
		var d1 = {
			'button'	: '1',
			'price'		: '<?php echo $price; ?>'
		};
		sendAction(d1);
	});

	// second button
	$('#button2').click(function(){
		var d1 = {
			'button'	: '2',
			'price'		: '<?php echo $price; ?>'
		};
		sendAction(d1);
	});

	// email button script
	
</script>
