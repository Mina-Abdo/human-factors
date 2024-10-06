<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="Mina Mikhail">
	<link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/therapist/headerAndFooter.css"/>
    <link rel="stylesheet" href="../assets/css/therapist/bookingPatientSession.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Patient Profile</title>
</head>
<body class="homepage is-preload">
    <div id="page-wraper">
        <!-- Header -->
				<div id="header-wrapper">
					<div id="header" class="container">

						<!-- Logo -->
							<h1 id="logo"><a href="../index.html">Website name</a></h1>
                        <!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="#">Logo holder</a></li>
								<li class="break">
									<a href="#" id="user-icon">user name</i></a>
									<ul id="dropdown" class="dropdown-content">
										<li><a href="#">profile</a></li>
										<li><a href="login.php">logout</a></li>
									</ul>
								</li>
							</ul>
						</nav>
					</div>
                </div>
                <section id='profile-wrapper'>
                    <?php
                    require_once "../assets/inc/dbconn.inc.php";
                    if(isset($_POST['user_id'])){
                        $userId = $_POST['user_id'];
                        $user_sql = "SELECT * FROM User WHERE id = ?";
                        $stmt1 = mysqli_prepare($conn, $user_sql);
                        mysqli_stmt_bind_param($stmt1, 'i', $userId);
                        mysqli_stmt_execute($stmt1);
                        $user_result = mysqli_stmt_get_result($stmt1);
                        if(mysqli_num_rows($user_result) >= 1){
                            $user = mysqli_fetch_assoc($user_result);
                        }
                    }
                    ?>
                    <form action="controllers/bookingPatientSession.php" method="post">
                        <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
                        <label for="last_visit">Last visit</label>
                        <input type="text" value="<?php echo htmlspecialchars($user['name']) ?>" disabled>
                        <label for="appointment-date">Choose a date for your appointment:</label>
                        <input type="date" id="appointment-date" name="appointment-date">
                        <label for="appointment-time">Choose a time for your appointment:</label>
                        <input type="time" id="appointment-time" name="appointment-time">
                        <input type="submit" value="Submit">
                    </form>
                </section>
    </div>
</body>
</html>