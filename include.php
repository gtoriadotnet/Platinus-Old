<!DOCTYPE html>
<html>
	<head>
		<title>Closure</title>
		<style>
			@import url("https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,400italic");
			
			body, html {
				height: 100%!important;
			}
			
			body {
				font-family: Source Sans Pro;
				display: flex;
				flex-direction: column!important;
				margin: 0;
				background-image: linear-gradient(0deg, rgb(50,50,90), rgb(80,80,120));
			}
			
			h1, h3 {
				margin: 0;
			}
			
			h3 {
				color: rgb(210,210,215);
			}
			
			img {
				margin-top: 20px;
			}
			
			.closurebutton {
				margin: auto;
				color: rgb(250,250,255);
				text-align: center;
				text-decoration: none;
				background-color: rgb(0, 0, 0, 0.3);
				padding: 20px;
				border: 5px rgb(80, 80, 150, 0.3);
				border-style: solid;
				border-radius: 20px;
			}
			
			.closurebutton:hover {
				background-color: rgb(20, 20, 20, 0.5);
			}
		</style>
	</head>
	<body>
		<a class="closurebutton" href="https://gtoria.net/">
			<span>
				<h1>plate nut dead</h1>
				<h3>click here to join Graphictoria, lol</h3>
				<img width="80" height="80" src="https://cdn.discordapp.com/emojis/845732271738847253.png?v=1"/>
			</span>
		</a>
	</body>
</html>
<?php
exit;
//xlxi 2020
try{
	global $sql;
	$sql = new PDO("mysql:host=localhost;port=3308;dbname=platinus", "Platinus", "LmnC3T50TvXejKp6");
	$sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
	$sql->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}catch(exception $e){
	exit("Uh oh! We ran into an error while connecting to the database. Be sure to check back soon!");
}
function getUserIpAddr(){ if(!empty($_SERVER['HTTP_CLIENT_IP'])){ $ip = $_SERVER['HTTP_CLIENT_IP']; }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){ $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; }else{ $ip = $_SERVER['REMOTE_ADDR']; } return $ip; }

$ipbans = $GLOBALS["sql"]->prepare("SELECT * FROM `ipbans`");
$ipbans->execute();

foreach ($ipbans as $ipban){
	if($ipban["ip"]==getUserIpAddr()){
		require_once($_SERVER["DOCUMENT_ROOT"] . "/internal/errordocs/begone.php");
		exit;
	}
}

if(file_get_contents(dirname($_SERVER["DOCUMENT_ROOT"]) . "/offline.txt")=="1"&&dirname($_SERVER["REQUEST_URI"])!=="/maintenance/constraint"){
	header("Location: https://" . $_SERVER['HTTP_HOST'] . "/maintenance/constraint/?return=" . urlencode("https://" . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"]));
	exit;
}

?>