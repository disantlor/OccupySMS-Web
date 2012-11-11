<!DOCTYPE html>
<html>
<head>

<title>OCCUPYSMS: Mutual Aid Platform</title>

<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.7.3/build/cssreset/cssreset-min.css">
<link rel="stylesheet" type="text/css" href="css/main.css">

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

</head>
<body>
	
<div id="top-alert" class="alert">
	We need as many aid requests entered as possible so that people can start texting in to help!  Text SANDY to 69866 to report a need.
</div>
	
<?php include ('_logo.php'); ?>
	
<div id="main" class="home">
	
	<div class="block">	
		<p>
			OccupySMS expedites mutual aid on the ground by connecting people seeking and offering aid based on their specific location and needs <br/>in areas without power or Internet.
			<br/><br/>
			Volunteers offering aid (pumping, clean-up, repair, and supplies)<br/> will be given the addresses of households seeking those resources.
		</p>
	</div>
	
	<div class="block">
		<a href="https://twitter.com/share?text=<?php echo "Connecting Sandy victims + volunteers on the ground via SMS: http://occupysms.org/" ?>" class="twitter-share-button" data-lang="en">Tweet</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>	
	</div>
	
	<div class="block">
	
		<p>
			TEXT <span class="highlight">SANDY</span> TO <span class="highlight">69866</span> TO REPORT A NEED
			<div class="small">Note: Please do not include distribution centers; this is for individual (household) needs.</div>
		</p>
		
		<br/>
		
		<p>
			TEXT <span class="highlight">MUTUAL AID</span> TO <span class="highlight">69866</span> TO OFFER A RESOURCE
			<div class="small">Note: Please only text in your resource if you are <b>on-site</b> at an affected area.</div>
		</p>
				
	</div>
	
	<div class="block">
		<?php include ('_map.php'); ?>
	</div>
	
	<br/>
	
	<div class="block">
	
		<h2>OUR GOALS</h2>
	
		<div class="block">
			<h4>1. Create an efficient system that works on the ground.</h4>
			<p>
				Web-based systems cannot function in areas without Internet access. SMS allows both those in need and those providing resources to access this network of support from the ground.
			</p>
		</div>
		
		<div class="block">
			<h4>2. Connect individuals.</h4>
			<p>
				The shortest distance between two points is a straight line. Connecting individuals (families who live in affected areas) to individuals (volunteers in that area) eliminates bottlenecks at distribution hubs.
			</p>
		</div>
		
		<div class="block">
			<h4>3. Empower individuals.</h4>
			<p>
				Those affected by the storm should be able to report needs on their own. Those volunteering with aid should be able to find individuals to help on their own.
			</p>
		</div>
		
		<div class="block">
			<h4>4. Encourage efficiency by targeting specific needs.</h4>
			<p>
				By asking those in need to categorize their needs (pumping, cleaning, repairs, supplies), they can more efficiently be connected to those with these particular resources. Someone who needs a pump can find someone who has a pump.
			</p>
		</div>
		
	</div>
	
	<div class="block">
		<h2><a target="_blank" href="https://docs.google.com/document/d/1cGiQN9MRlYEXdjDHs1F60yuqCj9OpC4Y2xAawEQmb2w/edit">FAQ</a></h2>
	</div>
	
	<div class="block">
		<p>
			Contact <a href="mailto:occupysms@gmail.com">occupysms@gmail.com</a> for more information<br/> or if you are an organization that wants to add a large amount of data.
		</p>
	</div>
	
</div> <!-- #main -->
	
</body>

</html>

