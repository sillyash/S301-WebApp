<?php session_start();
$_SESSION["logged"] = "true"; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>DemoCité</title>
	<link
		rel="stylesheet"
		href="<?php echo ROOT_URL.'/css/app.css'; ?>"
	/>
	<link
		rel="icon"
		type="image/x-icon"
		href="<?php echo ROOT_URL.'/assets/favicon.svg'; ?>"
	/>
</head>
<body>
	<header class="flex align-center bg-white shadow-md h-(--height-header)">
		<a class="flex justify-center items-center size-(--height-header)" href="<?php echo ROOT_URL.'/index.php' ?>">
			<img class="block size-[calc(var(--height-header)_-_20px)] mx-auto" src="<?php echo ROOT_URL.'/assets/favicon.svg'; ?>" alt="logo"/>
		</a>
		<?php
		if ($_SESSION["logged"] == "false"){
			include(VUE . "/headerLanding.html");
		} else {
			include(VUE . "/header.html");
		}
		?>
	</header>
	<main class="flex flex-col min-h-[calc(100vh_-_var(--height-header)_-_var(--height-footer))] w-full p-12 bg-gray-200 justify-center items-center">
