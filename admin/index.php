<?php 
include '../bootstrap.php';

// if update submitted
if (isset($_POST['aidee_id'])) {
	$aidee = OS_Aidee::findOne($_POST['aidee_id']);
	$aidee->set('address', $_POST['address']);
	$aidee->set('phone', $_POST['phone']);
	
	if (isset($_POST['helped']) && $_POST['helped'] === 'on') {
		$aidee->setHelped($_POST['helping']);
	} else {
		$aidee->setNotHelped();
	}
	
	$aidee->save();
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

<div id="top-alert" class="alert">
	Please be VERY CAREFUL when making changes.  There is no "undo".
</div>

<?php include ('../_logo.php'); ?>

<div id="main" class="admin">
	<table class="aidees">
		<thead>
			<tr>
				<th class="column neighborhood">Neighborhood</th>
				<th class="column need">Need</th>
				<th class="column address">Address</th>
				<th class="column contact">Phone</th>
				<th class="column date-added">Added</th>
				<th class="column helped">Helped</th>
				<th class="column helping">Volunteer Info</th>
				<th class="column controls"></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($aidees as $aidee): ?>
			<form id="aidee_<?php echo $aidee->get('id') ?>" method="POST">
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
				<td><input type="text" class="text" name="address" value="<?php echo $aidee->get('address') ?>"/></td>
				
				<!-- Contact -->
				<td><input type="text" class="text" name="phone" style="width: 95px;" value="<?php echo $aidee->get('phone') ?>"/></td>
				
				<!-- Date Added -->
				<td><?php echo strtoupper(date('M j', strtotime($aidee->get('timestamp')))) ?></td>
				
				<!-- Controls -->
				<td class="column helped">
					<input type="checkbox" name="helped" <?php echo ($aidee->hasBeenHelped()) ? 'checked' : '' ?>/>
				</td>
				
				<!-- Volunteer Info -->
				<td><input type="text" class="text" name="helping" style="width: 95px;" value="<?php echo $aidee->get('helping') ?>"/></td>
				
				<td class="controls">
					<input type="submit" class="button submit" value="SAVE"/>
					<input type="hidden" name="aidee_id" value="<?php echo $aidee->get('id') ?>"/>
				</td>
			</tr>
			</form>
		<?php endforeach; ?>
		</tbody>
	</table>
	
</div>

</body>

</html>