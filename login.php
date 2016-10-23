<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>contoh session</title>
</head>
<body>
	<?php
			require_once "database.php";
			$conn = connection();
			if(isset($_POST['username']) && isset($_POST['password'])) {
				$username = $_POST['username'];
				$password = md5($_POST['password']);
				
				$query = $conn->prepare("select * from register where username=? && password=?");
				$query->bind_param("ss", $username, $password);
				$result = $query->execute();

				if(! $result)
					die("Gagal query");

				$rows = $query->get_result();
				if($rows->num_rows == 1) {
					header("location:profile.php");
				}
				else{
					echo "<p>gagal login</p>";
				}
			}else {
				echo "<p>anda belum login</p>";
			}
	?>
	
</body>
</html>