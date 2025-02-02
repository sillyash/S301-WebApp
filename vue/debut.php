<?php session_start(); ?>
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
		if (isset($_SESSION["logged"])){
			if ($_SESSION["logged"] == false){
				include(VUE . "/headerLanding.php");
			} else {
				include(VUE . "/header.php");
			}
		} else {
			include(VUE . "/headerLanding.php");
		}
		?>
	</header>
	<main class="flex flex-col min-h-[calc(100vh_-_var(--height-header)_-_var(--height-footer))] w-full px-12 pb-10 bg-gray-200 items-center">