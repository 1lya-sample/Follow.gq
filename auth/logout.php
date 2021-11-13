<?php
error_reporting(0);
session_start();
$_SESSION["id"] = 0;
echo'<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../incl/css/main.css" />
	</head>
	<body class="is-preload">

		<!-- Wrapper-->
			<div id="wrapper">
								<div id="main">
									<article class="panel">
	 Ты вышел из аккаунта. <a href="/">Перейти на главную</a>
	</article>
</div>
				<!-- Footer -->
					<div id="footer">
						<ul class="copyright">
							<li>&copy; Chernov Studio, 2021</li>
						</ul>
					</div>
					
</div>
					
		<!-- Scripts -->
			<script src="../incl/js/jquery.min.js"></script>
			<script src="../incl/js/browser.min.js"></script>
			<script src="../incl/js/breakpoints.min.js"></script>
			<script src="../incl/js/util.js"></script>
			<script src="../incl/js/main.js"></script>

	</body>
</html>';
?>
