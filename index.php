<?php
	session_start();

	if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == FALSE) {
		header('Location: login.php');
	}
?>

<!DOCTYPE html>
<html>

<head>
	<?php include "head.php"; ?>

	<title>Kfet - Accueil</title>
</head>
<body>

	<h1>Bonjour <?php echo htmlspecialchars($_SESSION['username']); ?></h1>

	<nav class="menu">
		<ul>
			<li><a href="profile.php">Mon Compte</a></li>
			<li>
				<a href="administration.php">Administrer</a>

				<ul>
					<li><a href="administration.php#produits">Produits</a></li>
					<li><a href="administration.php#formules">Formules</a></li>
					<li><a href="administration.php#usagers">Usagers</a></li>
					<li><a href="administration.php#statistiques">Statistiques</a></li>
				</ul>
			</li>
			<li><a href="logout.php">Se déconnecter</a></li>
		</ul>

	<div class="add-user">
		<h1>Ajouter un utilisateur</h1>
		<form action="register.php" method="post" autocomplete="off">
		
			<label for="student_number">Numéro étudiant</label>
			<input type="text" name="student_number" placeholder="182355" id="student_number" required>

			<label for="username">Nom</label>
			<input type="text" name="username" placeholder="Tom de Pasquale" id="username" required>
			
			<label for="bdlc_member">Abonné BDLC</label>
			<input type="checkbox" name="bdlc_member" id="bdlc_member">

			<label for="auth_level">Niveau d'autorisation</label>
			<select id="auth_level" name="auth_level" required>
				<option value="0">Ensimien</option>
				<option value="1">Barista</option>

<?php
	// Add the administrator only if the administrator is logged on
	if(isset($_SESSION['auth_level']) && $_SESSION['auth_level'] > 1)
		echo '<option value="2">Administrateur</option>';
?>
			</select>

			<input type="submit" value="Ajouter">
		</form>
	</div>

</body>
</html>