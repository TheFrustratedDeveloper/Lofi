<?php 
	include ("includes/includedFile.php");
?>
<div class="userDetails">
	<!-- email section -->
	<div class="container borderBottom">
		<h2>E MAIL</h2>
		<input type="email" name="email" placeholder="email address..." value="<?php echo $userLoggedIn->getEmail(); ?>" class="email">
		<span class="message"></span>
		<button class="button" onclick="updateEmail('email')">UPDATE EMAIL</button>
	</div>
	<!-- password section -->
	<div class="container">
		<h2>PASSWORD</h2>
		<input type="password" name="oldPassword" placeholder="current password" class="oldPassword">
		<input type="password" name="newPassword" placeholder="new password" class="newPassword">
		<input type="password" name="confirmPassword" placeholder="confirm password" class="confirmPassword">
		<span class="message"></span>
		<button class="button" onclick="updatePassword('oldPassword','newPassword','confirmPassword')">UPDATE PASSWORD</button>
	</div>
</div>
