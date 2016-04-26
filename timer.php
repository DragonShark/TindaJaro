		<link rel="stylesheet" type="text/css" href="TindaJaro/style.css">
		<script>
		var timer = function(){
			myTimer()
		};
			var myVar = setInterval(timer, 1000);
			function myTimer() {

				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 & xmlhttp.status == 200) {
						document.getElementById("timer").innerHTML = xmlhttp.responseText;
					}
				}
					xmlhttp.open("GET", "clock.php", true);
					xmlhttp.send();
		}
		</script>
	</head>
	<body>
		<p id="timer"></p>
	</body>
</html>
