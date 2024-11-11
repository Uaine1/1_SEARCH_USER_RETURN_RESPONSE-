<?php 
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 

if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
	
</head>
<body>
	<?php if (isset($_SESSION['message'])) { ?>
		<h1 style="color: green; text-align: center; background-color: ghostwhite; border-style: solid;">	
			<?php echo $_SESSION['message']; ?>
		</h1>
	<?php } unset($_SESSION['message']); ?>

	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="GET">
		<input type="text" name="searchInput" placeholder="Search here">
		<input type="submit" name="searchBtn">
	</form>

	<?php if (isset($_SESSION['message'])) { ?>
		<h1 style="color: red;"><?php echo $_SESSION['message']; ?></h1>
	<?php } unset($_SESSION['message']); ?>

	<div class="greeting" style="text-align: center;">
		<h1 style="text-align: center;">Hello there! Welcome, <?php echo $_SESSION['username']; ?></h1>
		<h1><a href="core/handleForms.php?logoutUserBtn=1">Logout</a></h1>	
	</div>

	<p><a href="index.php">Clear Search Query</a></p>
	<p><a href="insert.php">Insert New Teacher</a></p>

	<table style="width:100%; margin-top: 20px;">
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Gender</th>
			<th>Subject Specialty</th>
			<th>Date Added</th>
			<th>Action</th>
		</tr>

		<?php if (!isset($_GET['searchBtn'])) { ?>
			<?php $getAllUsers = getAllUsers($pdo); ?>
				<?php foreach ($getAllUsers as $row) { ?>
					<tr>
						<td><?php echo $row['first_name']; ?></td>
						<td><?php echo $row['last_name']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['gender']; ?></td>
						<td><?php echo $row['subject_specialty']; ?></td>
						<td><?php echo $row['date_added']; ?></td>
						<td>
							<a href="edit.php?teacher_id=<?php echo $row['teacher_id']; ?>">Edit</a>
							<a href="delete.php?teacher_id=<?php echo $row['teacher_id']; ?>">Delete</a>
						</td>
					</tr>
			<?php } ?>
			
		<?php } else { ?>
			<?php $searchForAUser =  searchForAUser($pdo, $_GET['searchInput']); ?>
				<?php foreach ($searchForAUser as $row) { ?>
					<tr>
						<td><?php echo $row['first_name']; ?></td>
						<td><?php echo $row['last_name']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['gender']; ?></td>
						<td><?php echo $row['subject_specialty']; ?></td>
						<td><?php echo $row['date_added']; ?></td>
						<td>
							<a href="edit.php?teacher_id=<?php echo $row['teacher_id']; ?>">Edit</a>
							<a href="delete.php?teacher_id=<?php echo $row['teacher_id']; ?>">Delete</a>
						</td>
					</tr>
				<?php } ?>
		<?php } ?>	
		
	</table>
	
</body>
</html>
