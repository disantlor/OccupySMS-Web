<?php 
include '../bootstrap.php';

// Handle querystring changes
if (isset($_GET['set_helped'])) {
	$aideeToUpdate = OS_Aidee::findOne($_GET['set_helped']);	
	$aideeToUpdate->setHelped();
} else if (isset($_GET['set_not_helped'])) {
	$aideeToUpdate = OS_Aidee::findOne($_GET['set_not_helped']);	
	$aideeToUpdate->setNotHelped();
}

// fetch all AIDEE requests
$aidees = OS_Aidee::fetch();
?>
<!DOCTYPE html>
<html>

<title>OCCUPYSMS: Mutual Aid Platform: Admin</title>

<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.7.3/build/cssreset/cssreset-min.css">
<link rel="stylesheet" type="text/css" href="<?php echo URL ?>/css/main.css">

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<body>

<?php include ('../_logo.php'); ?>

<div id="main" class="admin">

	<table class="aidees">
		<thead>
			<tr>
				<th class="column neighborhood">Neighborhood</th>
				<th class="column need">Need</th>
				<th class="column address">Address</th>
				<th class="column contact">Contact</th>
				<th class="column date-added">Added</th>
				<th class="column helping">Volunteer Info</th>
				<th class="column controls"></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($aidees as $aidee): ?>
			<tr class="aidee <?php echo ($aidee->hasBeenHelped()) ? 'helped' : '' ?> <?php echo $aidee->get('neighborhood') ?>">
				<!-- Neighborhood -->
				<td class="neighborhood"><?php echo $aidee->getNeighborhoodForDisplay() ?></td>
				
				<!-- Need -->
				<td>
				<?php 
					echo ucfirst($aidee->get('type'));
					if ($aidee->get('type') === OS_Needs::SUPPLIES) {
						echo '<div class="details">(' . $aidee->get('args') . ')</div>';
					} 
				?>
				</td>
				
				<!-- Address -->
				<td><?php echo $aidee->get('address') ?></td>
				
				<!-- Contact -->
				<td><?php echo $aidee->get('phone') ?></td>
				
				<!-- Date Added -->
				<td><?php echo strtoupper(date('M j', strtotime($aidee->get('timestamp')))) ?></td>
				
				<!-- Volunteer Info -->
				<td><?php echo $aidee->get('helping') ?></td>
				
				<!-- Controls -->
				<td class="column controls">
					<?php if (! $aidee->hasBeenHelped()): ?>
						<a class="button submit" href="?set_helped=<?php echo $aidee->get('id') ?>">MARK AS HELPED</a>
					<?php else: ?>
						<a class="button submit" href="?set_not_helped=<?php echo $aidee->get('id') ?>">MARK AS <b>NOT</b> HELPED</a>
					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	
</div>

</body>

</html>