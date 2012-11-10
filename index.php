<!DOCTYPE html>
<html>

<head>

<title>OCCUPYSMS: Mutual Aid Platform</title>

<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.7.3/build/cssreset/cssreset-min.css">

<style type="text/css">
body { background-color: #fafafa; color: #111; font-family: "Helvetica Neue", "Helvetica", sans-serif; line-height: 1.5em }

h1, h2, h3, h4 { line-height: 1.2em; font-weight: bold; }
h1 { font-size: 60px; letter-spacing: 1px; }
h2 { font-size: 26px; }
h4 { font-size: 18px; }

p { font-size: 17px; }


#main { width: 600px; margin: 10px auto; text-align: center; }
#goals { margin-top: 25px; }

.small { font-size: 12px; line-height: 1.2em }
.block { padding: 15px; }
.occupy { color: #A00; }
.highlight { color: #00f; font-weight: bold; }

</style>


</head>

<body>
	
<div id="main">

	<h1><span class="occupy">OCCUPY</span>SMS</h1>
	
	<div class="block">	
		<p>
			OccupySMS expedites mutual aid on the ground by connect people needing and offering aid based on their specific location and needs <br/>in areas without power or Internet.
			<br/><br/>
			Volunteers offering support (pumping, clean-up, repair, and supplies) will be given the addresses of households seeking those resources.
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
		<?php include ('map.php'); ?>
	</div>
	
	<div id="goals" class="block">
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
				By asking those in need to categorize their needs (pumping, cleaning, medical aid, supplies, food), they can more efficiently be connected to those with these particular resources. Some who needs a pump can find someone who has a pump.
			</p>
		</div>
		
		<div class="block">
			<p>
				Contact <a href="mailto:occupysms@gmail.com">occupysms@gmail.com</a> for more information or if you are an organization that wants to add a large amount of data.
			</p>
		</div>
		
	</div>
	
</div> <!-- #main -->
	
</body>

</html>

