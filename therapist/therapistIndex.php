<!DOCTYPE html>
<html>
    <head>
        <title>therpay clinic</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="Author" content="Mina Mikhail">
		<link rel="stylesheet" href="../assets/css/main.css" />
        <link rel="stylesheet" href="../assets/css/therapist/index.css"/>
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
										<li><a href="../index.php">logout</a></li>
									</ul>
								</li>
							</ul>
						</nav>
					</div>
                </div>
				
                <div id="body-wrapper">
					<h2>Patients Data</h2>
					<table id="patients">
						<thead>
							<!-- <th>Patient ID</th> -->
							<th>Patient Name</th>
							<th>Last visit</th>
							<th>Actions</th>
						</thead>
						<tbody>
						<?php 
							require_once "../assets/inc/dbconn.inc.php" ;
							$sql = "SELECT id, name, email, last_visit FROM User WHERE therapist=1";
							if($results = mysqli_query($conn, $sql)){
								if(mysqli_num_rows($results) >= 1){
									while($row = mysqli_fetch_assoc($results)){
										echo "<tr>";
										echo "<td>". htmlspecialchars($row["name"])."</td>";
										echo "<td>".htmlspecialchars($row['last_visit'])."</td>";
										echo "<td class='actions'>";
										echo "<a href=patientProfile.php' class='profile'><i class='fas fa-user'></i></a>";
										echo "<a href='' class = 'recommendations'><i class='fas fa-book'></i></a>";
										echo "<a href='' class = 'booking'><i class='fas fa-business-time'></i> </a>";
										echo "</td>";
										echo "</tr>";
									}
									mysqli_free_result($results);
								}else{
									echo "<p> No patients</p>";
								}
							}else{
								echo "Error: " . mysqli_errno($conn);
							}
							mysqli_close($conn);
							?>
						</tbody>
					</table>
					<!-- Pagination Controls -->
					<div class="pagination" id="pagination-controls"></div>
				</div>
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
		<script src="../assets/js/therapist/index.js"></script>
</html>