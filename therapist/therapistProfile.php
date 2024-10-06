<!DOCTYPE html>
<html lang="en">
<head>
    <title>therpay clinic</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="Author" content="Mina Mikhail">
		<link rel="stylesheet" href="../assets/css/main.css" />
        <link rel="stylesheet" href="../assets/css/therapist/index.css"/>
		<link rel="stylesheet" href="../assets/css/therapist/headerAndFooter.css"/>
        <link rel="stylesheet" href="../assets/css/fontawesome-all.min.css"/>
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
                                    <li><a href="therapistProfile.html">profile</a></li>
                                    <li><a href="login.php">logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div id="body-wrapper">
                <h2>Therapist Data</h2>
                <table id="patients">
                    <thead>
                        <th>Patient ID</th>
                        <th>Patient Name</th>
                        <th>Last visit</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>mill1001</td>
                            <td>Millisa Anderson</td>
                            <td>21 Dec 2023</td>
                            <td class="actions">
                                <a href="patientProfile.html" class="profile">Edit Profile</a>
                                <a href="" class="recommendations"> Change password</a>
                            </td>
                        </tr>
                        
                        
                    </tbody>
                </table>
\            </div>
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