<!doctype html>
<html>

<head>
	<title>West Bestern</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link href="style/ess.css" rel="stylesheet" type="text/css" media="screen">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script>
		let $ = document.querySelector.bind(document);
		let t = false;

		function toggle(setT) {
			if (setT != undefined) {
				t = setT;
			} else {
				t = !t;
			}
			if (t) {
				$(".ess-menu").style.left = "0";
				$("body").style.left = "60vw";
				$(".ess-head").style.left = "60vw";
			} else {
				$(".ess-menu").style.left = "-60vw";
				$("body").style.left = "0";
				$(".ess-head").style.left = "0";
			}
		}
	</script>
	<script>

	function hexToBase64(str) {
    	return btoa(String.fromCharCode.apply(null, str.replace(/\r|\n/g, "").replace(/([\da-fA-F]{2}) ?/g, "0x$1 ").replace(/ +$/, "").split(" ")));
	}

	function showCity($str) {
		document.getElementById("resultProvinceValue").innerHTML = $str;
		if ($str=="") {
			document.getElementById("resultProvinceValue").innerHTML="";
			return;
		}
		if (window.XMLHttpRequest) {
			xmlhttp=new XMLHttpRequest();
		} else {
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
			if (this.readyState==4 && this.status==200) {
				document.getElementById("resultProvinceValue").innerHTML=this.responseText;
			}
		}
		xmlhttp.open("GET","getcity.php?q="+$str,true);
		xmlhttp.send();
	}

	function pageInit() {

	}
	document.onload = () => {
		pageInit();
	}
	</script>
</head>

<body>
	<div class="ess-head">
		<div class="ess-wrapper">
			<div class="ess-row wide">
				<div class="ess-mobile-menu-button" onclick="toggle()"></div>
				<h1 class="ess-logo">
					<a href="javascript:void(0);"><i class="fa fa-bed"></i>&nbsp;West Bestern</a>
				</h1>
				<div class="ess-menu">
					<a href="/" class="ess-menu-item">Home</a>
					<a href="/" class="ess-menu-item">About</a>
					<div class="ess-menu-item ess-dropdown">
						Member
						<div class="ess-menu-dropdown">
							<a href="/" class="ess-menu-item">Login</a>
							<a href="/" class="ess-menu-item">Register</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="ess-main" onclick="toggle(false)">
		<div class="ess-wrapper">
			<!--<div class="ess-banner ess-info"><i class="fa fa-info-circle"></i><span>Info</span></div>-->
		</div>
		<div class="ess-wrapper">
			<div class="ess-card">
				<h1>Find a hotel room</h1>
				<form>
					<select name="Province" id="select_province" onchange="showCity(this.value)">
						<?php
						$servername = "localhost";
						$username =   "ethanell_hbs";
						$password =   "password123";
						$dbname =     "ethanell_sofe2800";
						$conn = new mysqli($servername, $username, $password, $dbname);
						// Check connection
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
						}
						$sql = "SELECT prv_id, prv_name FROM province;";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							// output data of each row
							while($row = $result->fetch_assoc()) {
								echo "<option value=". $row["prv_id"].">" . $row['prv_name'] . "</option>";
							}
						} else {
							echo "0 results";
						}
						$conn->close();
						?>
					</select>
					<div id="resultProvinceValue"></div>
					Check-in: <input type="date" />
					Check-out: <input type="date" />
					Adults: <select>
						<option>0</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
					</select>
					Children: <select>
						<option>0</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
					</select>
				</form>
			</div>
			<div class="ess-card">
				<h1>Results</h1>
			</div>
	</div>
	<div class="ess-footer">
		<span>&copy; Ethan Elliott 2017</span>
	</div>
</body>

</html>
