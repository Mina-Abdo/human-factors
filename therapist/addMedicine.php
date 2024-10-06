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
							<h1 id="logo"><a href="../index.php">Website name</a></h1>
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
                if (isset($_POST['user_id'])) {
                
                    $user_id = $_POST['user_id']; // Sanitize the user ID (already integer)
                    
                    // Correct SQL query string
                    $user_sql = "SELECT * FROM User WHERE id = ?"; 
                    
                    // Prepare the SQL statement
                    $stmt1 = mysqli_prepare($conn, $user_sql);
                    
                    // Bind the parameter to the SQL query
                    mysqli_stmt_bind_param($stmt1, 'i', $user_id); // 'i' for integer
                
                    // Execute the statement
                    mysqli_stmt_execute($stmt1);
                
                    // Fetch the result
                    $user_result = mysqli_stmt_get_result($stmt1);
                
                    // Check if a user is found
                    if (mysqli_num_rows($user_result) >= 1) {
                        $user = mysqli_fetch_assoc($user_result); // Fetch the user's data
                        // You can now use $user data
                    } else {
                        echo "No user found with the provided ID.";
                    }
                
                } else {
                    echo "<p> No user selected.</p>";
                }
                ?>
                <div id="body-wrapper">
                    <form action="controllers/addMedicine.php" method="post">
                        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id) ?>">
                        <input type="hidden" name="therapist_id" value="<?php echo htmlspecialchars($_SESSION['therapist_id']) ?>">
                        <h2>Add Medicine:</h2>
                        <label for="name">Medicine</label>
                        <input type="text" name="name" value="">
                        <label for="dose">Dose</label>
                        <input type="text" name="dose" value="">
                        <label for="daily-intake">Daily intake</label>
                        <input type="number" name="daily-intake" value="">
                        <input type="submit" value="Add">
                    </form>
                </div>
        </div>
    </body>
</html>