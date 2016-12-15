<?php
	// generate price
	$prices = array('$100', '$250');
	$price = $prices[array_rand($prices)];

	// surveys in the database?
	$survey = 'about:blank';
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
					<input type="text" id="email" placeholder="email address">
					<button id="email_button">Submit</button>
				</fieldset>
				<p><input type="checkbox" id="even_better"> <label for="even_better">Even better - lock in your rate when OnTrack is available for $250 for your next IVF cycle.</label></p>
				<div class="survey">
					<p><a href="#">Will you help us out by answering a few additional questions?</a></p>
					<p style="font-size:.7em;">No thanks</p>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="blackout" class="blackout"></div>




<script>


	// first button
	$('#button1').click(function(){

		// get the id from the php varible
		var id = '<?php echo $user_id ?>';

		// build the action data
		var d1 = {
			'button'	: '1',
			'price'		: '<?php echo $price; ?>'
		};

		//send it, with calback to open the modal
		sendAction(id, d1, showModal('email_modal') );

	});

	// second button
	$('#button2').click(function(){

		// get the id from the php varible
		var id = '<?php echo $user_id ?>';

		// build the action data
		var d1 = {
			'button'	: '2',
			'price'		: '<?php echo $price; ?>'
		};

		//send it, with calback to open the modal
		sendAction(id, d1, showModal('email_modal') );

	});



	// email address function
	function sendEmail(){
		alert('this is the script that send the email and forwards to the survey');	
	};



	// email button script
	$('#email_button').click(function(){

		// change the submit button to spinner
		this.innerHTML = '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>';
		this.disabled = true;

		// get the id from the php varible
		var id = '<?php echo $user_id ?>';

		// get checkbox state
		if(document.getElementById('even_better').checked){
			var even_better = 'checked';
		}else{
			var even_better = 'not checked';
		}

		// create the action data
		var d1 = {
			'even_better' : even_better
		};

		//send it, with calback to open the modal
		sendAction(id, d1, sendEmail() );



	});

</script>
