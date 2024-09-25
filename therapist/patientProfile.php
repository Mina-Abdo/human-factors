<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="Mina Mikhail">
	<link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/therapist/headerAndFooter.css"/>
    <link rel="stylesheet" href="../assets/css/therapist/patientProfile.css"/>
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
										<li><a href="../index.html">logout</a></li>
									</ul>
								</li>
							</ul>
						</nav>
					</div>
                </div>
                <section id='profile-wrapper'>
                    <?php
                        session_start();
                        // Check if the form has been submitted with a valid user_id
                        if (isset($_POST['user_id'])) {
                            // Store the user ID in the session
                            $_SESSION['user_id'] = intval($_POST['user_id']);
                        }

                        // If the user ID is not set in the session, redirect to the main page or show an error
                        if (!isset($_SESSION['user_id'])) {
                            echo "No user selected.";
                            exit; // Stop further execution
                        }
                        // Retrieve the user ID from the session
                        $userId = $_SESSION['user_id'];
                        // Include your database connection
                        require_once "../assets/inc/dbconn.inc.php";
                        // Now use the $userId to get user details
                        $sql = "SELECT * FROM User WHERE id = ?";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, 'i', $userId);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        // Fetch and display the user's profile information
                        if ($row = mysqli_fetch_assoc($result)) {
                            echo "<div id='patientInfo'>";
                            echo"<p>Patient: ";
                            echo" <span>".htmlspecialchars($row['name'])."</span></p>";
                            echo "<p>Email: <span>".htmlspecialchars($row['email']). "</span> </p>";
                            echo "<p>Last Visit: <span>".htmlspecialchars((new DateTime($row['last_visit']))->format('d M Y')). "</span> </p>";
                            if($row['needs_followup']){
                                echo "<p>Needs Followup: <span>Yes</span> </p>";
                            }else{
                                echo "<p>Needs Followup: <span>No</span> </p>";
                            }
                            echo "</div>";
                            echo "<div id='medication'>
                            <h2>Medication: </h2>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Medicine</th>
                                        <th>Dose</th>
                                        <th>No of doses per day</th>
                                        <th>No of patient logs per day</th>
                                        <th>No of of days logs per week</th>
                                    </tr>
                                </thead>
                                <tbody>";
                           
                            // Output more user details as needed...
                            $medication_sql = "SELECT * FROM Medication WHERE user = ?";
                            $stmt1 = mysqli_prepare($conn, $medication_sql);
                            mysqli_stmt_bind_param($stmt1, 'i', $userId);
                            mysqli_stmt_execute($stmt1);
                            $medication_result = mysqli_stmt_get_result($stmt1);
                            if(mysqli_num_rows($medication_result) >=1){
                                while($medicine = mysqli_fetch_assoc($medication_result)){
                                    echo"<tr>";
                                        echo "<td>" .htmlspecialchars($medicine['medicine']) . "</td>";
                                        echo "<td>" .htmlspecialchars($medicine['dose']) ."</td>";
                                        echo "<td id='medicationDose'>" . htmlspecialchars($medicine['dose_per_day']) . "</td>";
                                        echo "<td id='medicineDailyLog'>" . htmlspecialchars($medicine['dose_daily_logs']) . "</td>";
                                        echo "<td id='medicineWeeklyLog'>" . htmlspecialchars($medicine['dose_weekly_logs']) . "</td>";
                                    echo "</tr>";
                                }
                            }else{
                                echo "<tr><td colspan='5'>No Medication for this patient.</td></tr>";
                            }
                            echo "</tbody>
                            </table>
                            </div>";
                            echo "<div id='sleep'>
                            <h2>Sleep: </h2>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Daily sleep Hours</th>
                                        <th>NO of Logs per week</th>
                                    </tr>
                                </thead>
                                <tbody>";
                                echo "<tr>";
                                echo "<td id='sleepHrs'>" . htmlspecialchars($row['daily_sleep_hours']) . "</td>";
                                echo "<td id='sleepLogs'>" . htmlspecialchars($row['sleep_hours_logs']) . "</td>";
                                echo "</tr>";
                                echo "</tbody>
                                        </table>
                                    </div>";
                                    echo "<div id='excercise'>
                            <h2>Excercise: </h2>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Excercise type</th>
                                        <th>Daily duration</th>
                                        <th>NO of Logs per week</th>
                                    </tr>
                                </thead>
                                <tbody>";
                                $excercise_sql = "SELECT * FROM Exercise WHERE user = ?";
                                $stmt2 = mysqli_prepare($conn, $excercise_sql);
                                mysqli_stmt_bind_param($stmt2, 'i', $userId);
                                mysqli_stmt_execute($stmt2);
                                $exercise_result = mysqli_stmt_get_result($stmt2);
                                if(mysqli_num_rows($exercise_result)>= 1){
                                    while($exercise_row = mysqli_fetch_assoc($exercise_result)){
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($exercise_row['exercise_type']) . "</td>";
                                        echo "<td>" . htmlspecialchars($exercise_row['daily_duration']) . "</td>";
                                        echo "<td id='excerciseLogs'>" . htmlspecialchars($exercise_row['weekly_logs']) . "</td>";
                                        echo "</tr>";
                                    }
                                }else{
                                    echo "<p> No exercise for this user. </p>";
                                }
                                echo "</tbody>
                                </table>
                                </div>";
                        } else {
                            echo "User not found.";
                        }
                    ?>
                </section>

                
        <!-- Footer -->
		<div id="footer-wrapper">
			<div id="copyright" class="container">
				<ul class="menu">
					<li>&copy; Untitled. All rights reserved.</li>
				</ul>
			</div>
		</div>
    </div>
</body>
    <!-- Scripts -->
    <script src="../assets/js/therapist/patientProfile.js"></script>
</html>