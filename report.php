<?php
include 'bootstrap.php';
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.7.3/build/cssreset/cssreset-min.css">
	<style>
	body { font-family: "Helvetica Neue"; font-size: 14px; line-height: 1.2em; padding: 10px 0; }
	dt { margin-bottom: 3px; font-weight: bold; }
	dd { margin-bottom: 23px; }
	
	legend { font-weight: bold; font-size: 16px; }
	form { border: 1px #ddd solid; padding: 18px; }
	
	h1, h2, h3, h4 { line-height: 1.2em; font-weight: bold; text-align: center }
	h1 { font-size: 50px; letter-spacing: 1px; }
	h2 { font-size: 22px; }
	
	#main { width: 450px; margin: 0 auto; }

	.occupy { color: #A00; }
	.hidden { display: none; }
	.helper { font-weight: normal; font-size: 13px; }
	.instructions { padding: 4px 0 23px 0; }
	input.text { width: 200px; border: 1px #bbb solid; font-size: 14px; padding: 4px; }
	input.submit { font-size: 16px; font-weight: bold; color: #fff; background-color: #A00; padding: 7px 9px; border: 0px; }
	
	ul.needs li { font-size: 13px; line-height: 1.5em; }
	ul.needs li input[type=checkbox] { position: relative; top: -1px; }
	</style>
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
</head>
<body>
	
<div id="main">

	<h1><span class="occupy">OCCUPY</span>SMS</h1>

	<br/>

	<script>
	$(function(){

		// toggle supply-request details field
		$('input[name=need\\[supplies\\]]').on('click', function(){
			$('#report-a-need').find('.supplies-needed-container').toggle();
		});

		
		// handle form submit
		$('#report-a-need').on('submit', function(e){
			e.preventDefault();

			var $form = $(this);
		
			// collect form data into request object
			var request = {};
			request.phone = $form.find('input[name=phone]').val();
			request.neighborhood = $form.find('select[name=neighborhood]').val();
			request.address = $form.find('input[name=address]').val();
			
			request.needs = [];
			$.each($form.find('input[type=checkbox][name^=need]:checked'), function(){			
				// extract need key from characters between [] in field name
				var need = $(this).attr('name').substring($(this).attr('name').indexOf('[')+1, $(this).attr('name').indexOf(']'));
				request.needs.push(need);

				// pass along list of supplies needed for supply requests only
				if (need === 'supplies') {
					request.details = $form.find('input[name=details]').val();
				}
			});

			// rudimentary client-side validation
			if (! request.neighborhood || ! request.phone || ! request.address || ! request.needs.length) {
				alert('Please complete all fields before submitting your need.');
				return false;
			}
			
			// make ajax submission
			$.ajax({
				"url": window.location.pathname.substring(0, window.location.pathname.lastIndexOf('/')) + '/ajax/aidee/new.php',
				"type": "POST",
				"dataType": "json",
				"data": request,
				"success": function(response) {
					alert(response.join('\n\n'));
					resetForm();	
				},
				"error": function(response) {
					alert(response);
				}
			});
	
		});

		function resetForm()
		{
			$form = $('#report-a-need');
			$form.find('select[name=neighborhood]')[0].selectedIndex = 0;
			$form.find('input[name=phone]').val('');
			$form.find('input[name=address]').val('');
			$form.find('input[type=checkbox][name^=need]').attr('checked', false);

			$form.find('.supplies-needed-container').hide();
			$form.find('input[name=details]').val('');
		}
		
	});
	</script>
	<form id="report-a-need">
		<fieldset>
			
			<legend>Report a need</legend>
			<p class="instructions helper">
				Please take care to enter information carefully and accurately. You can selected multiple "needs" and each will be added to the system as a unique request.
			</p> 
			
			<dl>
			
				<dt>Which area are you closest to?</dt>
				<dd>
					<select name="neighborhood">
						<option value="">Select an area</option>
						<option value="rockaway">Rockaways</option>
						<option value="coney">Coney Island</option>
						<option value="staten">Staten Island</option>
					</select>
				</dd>
				
				<dt>What's your address, including apt #? <span class="helper">(add your neighborhood if it is different from the one you selected above)</span></dt>
				<dd>
					<input type="text" class="text" name="address"/>
				</dd>
				
				<dt>Enter the number of the person in need if available <span class="helper">(otherwise, enter a volunteer's number)</span></dt>
				<dd>
					<input type="text" class="text" name="phone" style="width: 120px;" maxlength="11"/>
				</dd>
				
				<dt>What do you need?</dt>
				<dd>
					<ul class="needs">
						<li><input type="checkbox" name="need[pump]"/> Pump</li>
						<li><input type="checkbox" name="need[cleanup]"/> Cleanup</li>
						<li><input type="checkbox" name="need[repair]"/> Repair</li>
						<li>
							<input type="checkbox" name="need[supplies]"/> Supplies
							
							<div class="hidden supplies-needed-container">
								<label>Please list up to 6 specific supplies you need</label>
								<input type="text" name="details" class="text" maxlength="140"/>
							</div>
						</li>
					</ul>
				</dd>	
				
			</dl>	
			
			<input type="submit" class="submit" value="SUBMIT"/>
			
		</fieldset>
	</form>
</div>
	
</body>
</html>