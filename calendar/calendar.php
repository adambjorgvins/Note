<?php
session_start();
require('assets/config.php');
require('assets/Main.php');

$class = new Main();

if(!isset($_SESSION['username'])){
	$_SESSION['returnUrl'] = '/calendar';
	header("Location: ../login");
}

?>
<style>
	body{
		background: #f5f5f5;
	}
	*{
		font-size: 14px; !important;
	}
	.tabs .tab a:hover, .tabs .tab a.active {
		background-color: transparent; !important;
		color: #ee6e73; !important;
	}
</style>
<div class="container">
	<div class="row">
		<?php include('assets/bar.php'); ?>

		<div class="col s12 m12 l12">
			<div id='calendar'></div>
			<a class="modal-trigger waves-effect waves-light btn" href="#modal_add">Add Event</a>
		</div>

		<!-- ########################## MODALS ##########################-->
		<div id="modal_add" class="modal modal-fixed-footer">
			<div class="modal-content">
				<div id="container">
					<div id="row">
						<h4 class="center">Add new event</h4>

						<input type="hidden" id="lat" name="lat" value="">
						<input type="hidden" id="lng" name="lng" value="">

						<div class="row">
							<div class="input-field col s12">
								<input type="text" name="title" id="title">
								<label for="title">Title</label>
							</div>
						</div>

						<div class="row">
							<div class="input-field col s6">
								<input type="date" id="start" name="start" class="datepicker" placeholder=" ">
								<label for="start">Starting date</label>
							</div>
							<div class="input-field col s6">
								<input type="text" id="end" name="end" class="datepicker" placeholder=" ">
								<label for="end">End date</label>
							</div>
						</div>

						<div class="row">
							<div class="input-field col s12">
								<select class="icons" name="color" id="color" required>
									<option value="" disabled selected>Select color for your event</option>
									<option value="#81d4fa" class="left" >Blue</option>
									<option value="#e53935" class="left">Red</option>
									<option value="#66bb6a" class="left">Green</option>
									<option value="#000000" class="left" >Black</option>
									<option value="#b39ddb" class="left" >Purple</option>
									<option value="#ffa726" class="left" >Orange</option>
									<option value="#ffeb3b" class="left" >Yellow</option>
									<option value="#795548" class="left" >Brown</option>
									<option value="#607d8b" class="left" >Grey</option>
								</select>
								<label for="color">Select Color</label>
							</div>
						</div>

						<div class="row">
							<div class="input-field col s12">
								<input type="text" id="place" name="place" class="autocomplete">
								<label for="place">Where is this event?</label>
							</div>
						</div>

						<br>
						<button class="btn" name="submit" id="submitt">Submit</button>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
			</div>
		</div>

		<div id="modal_update" class="modal">
			<div class="modal-content">
				<div id="eventInfo"></div>
				<div id="colabrator"></div>
				<div class="row">
					<div class="input-field col s6">
						<input type="text" class="autocomplete" placeholder="Invite friend to your event" id="invite" name="user" autocomplete="off">
					</div>
					<div class="input-field col s6">
						<button class="btn blue" id="invite_btn">Invite</button>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="delete" class="btn red">Delete Event</button>
				<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
			</div>
		</div>
	</div>
	<!-- ########################## MODALS ##########################-->
</div>
<script>
	$(document).ready(function(){
		// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
		$('.modal-trigger').leanModal({
			starting_top: '4%', // Starting top style attribute
			ending_top: '2%' // Ending top style attribute
		});
		$('select').material_select();

		$('.datepicker').pickadate({
			selectMonths: true,
			selectYears: 15,
			format: 'yyyy-mm-dd'
		});

		// Setur autocomplete fyrir
		$.ajax({
			url: 'assets/renderAutocomplete.php',
			type: "GET",
			success: function(data) {
				// Fix json format
				var temp = JSON.stringify(eval("(" + data + ")"));
				// And make OBJ
				var json = JSON.parse(temp);
				$('#place').autocomplete({
					data: json
				});
			}
		});

		// Lodar vinum users þegar hann er að deila event með vin
		$.ajax({
			url: 'assets/renderFriends.php',
			type: "GET",
			success: function(data) {
				var temp = JSON.stringify(eval("(" + data + ")"));
				var json = JSON.parse(temp);
				$('#invite').autocomplete({
					data: json
				});
			}
		});


	});
</script>
