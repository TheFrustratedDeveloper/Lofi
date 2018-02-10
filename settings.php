<?php include ("includes/includedFile.php"); ?>
<div class="centerSection">
<div class="entityInfo">
	
	<div class="userInfo">
			<h2> <?php echo $userLoggedIn->getFirstAndLastName(); ?> </h2>
	</div>	
	<hr/>
	<div class="buttonItem">
		<button class="button bgGreen" onclick="openPagePushState('updateDetails.php')">USER  DETAILS</button>
	</div>
	<div class="buttonItem">
		<button class="button bgRed" onclick="logout()">L O G O U T</button>
	</div>
	
</div>
</div>