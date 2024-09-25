<!DOCTYPE html>
<html>
    <head>
        <title>therpay clinic</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="Author" content="Mina Mikhail">
		<link rel="stylesheet" href="../assets/css/main.css" />
        <link rel="stylesheet" href="../assets/css/therapist/login.css"/>
    </head>
    <body class="homepage is-preload">
        <div id="page-wraper">
                <!-- Header -->
				<div id="header-wrapper">
					<div id="header" class="container">

						<!-- Logo -->
							<h1 id="logo"><a href="../index.php">Website name</a></h1>
					</div>
                </div>
                <div id="login-wrapper">
                    <form id="login" method="post" action="therapistIndex.php">
                        <h2>Therapist Login</h2>
                        <label for="email">Email:</label>
                        <input id="email" name="email" type="email" placeholder="Enter your Email">
                        <label for="password">Password:</label>
                        <input id="password" name="password" type="password" placeholder="Enter your password">
                        <input type="submit" class="button" id="loginSubmit">
                        <div id="wrapper">
                            <a id="forgot-password" href="#">Forgot password?</a>
                            <a id="register" href="register.php">Register</a>
                        </div>
                    </form>
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
    <!-- scripts -->
     <script src="../assets/js/therapist/login.js"></script>
</html>