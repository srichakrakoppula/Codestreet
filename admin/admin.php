<?php
	include '../session_func.php';
	confirmLoggedIn();
	if(($_SESSION['isadmin']===false))
		header('Location: ../index.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin</title>
<script src="../js/jquery-latest.min.js"></script>
<link href="../css/style_admin.css" rel="stylesheet" type="text/css">
</head>

<body>
<div style="width:100%;text-align:right;">
<a href="../logout.php" style="margin-right:100px;">Logout</a>
</div>
<h1 style="text-align:center;font-size:36px">Welcome <?php echo $_SESSION['name']; ?></h1>
<div id="container">
<ul>
<li><a href="create_tests.html">Create Tests</a></li><br>
<li><a href="create_ques.html">Create Questions</a></li><br>
<li><a href="edit_tests.html">Reschedule Tests</a></li><br>
<li><a href="analyze_results.html">Analyze Results</a></li>
</ul>
</div>
</body>
</html>