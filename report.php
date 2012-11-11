<?php include 'bootstrap.php'; ?>
<!DOCTYPE html>
<html>
<head>

<title>OCCUPYSMS: Mutual Aid Platform: Report</title>

<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.7.3/build/cssreset/cssreset-min.css">
<link rel="stylesheet" type="text/css" href="<?php echo URL ?>/css/main.css">

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

</head>
<body>
	
<?php include ('_logo.php'); ?>

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
				alert(response.responseText);
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
	
<div id="main" class="report">

	<div class="block">
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
					
					<dt>
						What's your address, including apt #?<br/>
						<span class="helper">(add your neighborhood if it is different from the one you selected above)</span>
					</dt>
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
				
				<input type="submit" class="button submit" value="SUBMIT"/>
				
			</fieldset>
		</form>
	</div>
	
</div>
	
</body>
</html>