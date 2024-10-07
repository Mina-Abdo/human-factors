<!DOCTYPE html>
<html>
	<?php session_start(); ?>
    <head>
        <title>therpay clinic</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="Author" content="Mina Mikhail">
		<link rel="stylesheet" href="../assets/css/main.css" />
        <link rel="stylesheet" href="../assets/css/therapist/editMedicine.css"/>
		<link rel="stylesheet" href="../assets/css/therapist/headerAndFooter.css"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	</head>
    <body class="homepage is-preload">
        <div id="page-wraper">
            <!-- Header -->
				<div id="header-wrapper">
					<div id="header" class="container">

						<!-- Logo -->
							<h1 id="logo"><a href="therapistIndex.php">Website name</a></h1>
                        <!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="#">Logo holder</a></li>
								<li class="break">
									<a href="#" id="user-icon">user name</i></a>
									<ul id="dropdown" class="dropdown-content">
										<li><a href="therapistProfile.php">profile</a></li>
										<li><a href="login.php">logout</a></li>
									</ul>
								</li>
							</ul>
						</nav>
					</div>
                </div>
				<?php
                require_once "../assets/inc/dbconn.inc.php";
                if(isset($_POST['medicine_id'])){
                    $medicine_id = $_POST['medicine_id'];
                    $_SESSION['medicine_id'] = $medicine_id;
                    $medication_sql = "SELECT * FROM Medication WHERE id = ?";
                    $stmt1 = mysqli_prepare($conn, $medication_sql);
                    mysqli_stmt_bind_param($stmt1, 'i', $medicine_id);
                    mysqli_stmt_execute($stmt1);
                    $medication_result = mysqli_stmt_get_result($stmt1);
                    if(mysqli_num_rows($medication_result) >= 1){
                        $medicine = mysqli_fetch_assoc($medication_result);
                        // print_r($medicine);
                    }
                }else{
                    echo "<p> NO medicine selected.</p>";
                }
                ?>
                <div id="body-wrapper">
                    <form action="controllers/editMedicine.php" method="post">
                        <h2>Edit Medicine:</h2>
                        <label for="name">Medicine</label>
                        <input type="text" name="name" value="<?php echo htmlspecialchars($medicine['medicine']) ?>">
                        <label for="dose">Dose</label>
                        <input type="text" name="dose" value="<?php echo htmlspecialchars($medicine['dose']) ?>">
                        <label for="daily-intake">Daily intake</label>
                        <input type="number" name="daily-intake" value="<?php echo htmlspecialchars($medicine['dose_per_day']) ?>">
                        <input type="submit" value="Edit">
                    </form>
                </div>
        </div>
    </body>
</html>