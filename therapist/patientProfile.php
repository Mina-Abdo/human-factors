<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="Mina Mikhail">
	<link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/therapist/headerAndFooter.css"/>
    <link rel="stylesheet" href="../assets/css/therapist/patientProfile.css"/>
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
                        session_start();
                        require_once __DIR__ . '/../vendor/autoload.php';  // Adjust the path to where your vendor folder is

                        use PhpOffice\PhpWord\IOFactory;
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
                                        <th>logs per day</th>
                                        <th>logs per week</th>
                                        <th>Actions</th>
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
                                        echo "<td class='actions'>";
                                        echo "<form action='editMedicine.php' method='post'>";
            							echo "<input type='hidden' name='medicine_id' value='" . htmlspecialchars($medicine['id']) . "'>";
            							echo "<button type='submit' class='edit'><i class='fas fa-edit'></i></button>";
            							echo "</form>";
                                        echo "<form action='controllers/deleteMedicine.php' method='post'>";
            							echo "<input type='hidden' name='medicine_id' value='" . htmlspecialchars($medicine['id']) . "'>";
            							echo "<button type='submit' class='delete'><i class='fas fa-trash'></i></button>";
            							echo "</form>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                            }else{
                                echo "<tr><td colspan='6'>No Medication for this patient.</td></tr>";
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
                                    echo "<tr><td colspan='3'> No exercise for this user. </td></tr>";
                                }
                                echo "</tbody>
                                </table>
                                </div>";
                        } else {
                            echo "User not found.";
                        }
                        echo "<div id='log'>
                            <h2>Diaires: </h2>";
                            $filePath = dirname(__DIR__) . "/assets/docs/users/" . htmlspecialchars($row['diaries']); // Sanitize the file path to avoid injection
                            echo "<div>";
                            // Check if the file exists and is readable
                            if (file_exists($filePath) && is_readable($filePath)) {
                                try {
                                    // Load the .docx file
                                    $phpWord = IOFactory::load($filePath);
                            
                                    // Initialize a variable to hold the extracted content
                                    $content = '';
                            
                                    // Iterate over sections and elements to extract content
                                    foreach ($phpWord->getSections() as $section) {
                                        foreach ($section->getElements() as $element) {
                                            // Handle simple text elements
                                            if (method_exists($element, 'getText')) {
                                                $content .= $element->getText() ."<br>";
                                            }                                            
                                        }
                                    }
                            
                                    // Sanitize and display the extracted content on the page
                                    echo $content;
                            
                                } catch (Exception $e) {
                                    // Handle errors while loading or parsing the file
                                    echo 'Document does not exist ';
                                }
                            } else {
                                // Handle the case where the file doesn't exist or can't be read
                                echo "<p>Log file not found or cannot be opened.</p>";
                            }
                    ?>
                    </div>
                    </div>
                    <div id="notes">
                        <h2>Notes:</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Uploaded</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $notes_sql = "SELECT * FROM Notes WHERE user = ?";
                                $stmt2 = mysqli_prepare($conn, $notes_sql);
                                mysqli_stmt_bind_param($stmt2, 'i', $userId);
                                mysqli_stmt_execute($stmt2);
                                $notes_result = mysqli_stmt_get_result($stmt2);
                                // print_r($notes_result);
                                if(mysqli_num_rows($exercise_result)>= 1){
                                    while($notes_row = mysqli_fetch_assoc($notes_result)){
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($notes_row['note']) . "</td>";
                                        echo "<td>" . htmlspecialchars((new DateTime($notes_row['updated']))->format('d M Y, h:i A')) . "</td>";
                                        echo "</tr>";
                                    }
                                }else{
                                    echo "<tr><td colspan='3'> No Notes for this user. </td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <form id="notesForm" method="post" action="controllers/uploadTherapistNotes.php" enctype="multipart/form-data">
                            <label for="notes">Attach notes</label>
                            <input name="notes" type="file" required>
                            <input type="submit" value="Upload">
                        </form>
                    </div>
                    <!-- <input type="file">
                    <label></label> -->
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