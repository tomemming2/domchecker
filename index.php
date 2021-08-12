<?php
require_once "Authenticate.php";

$domain_extensions = array("nl", "com", "eu", "info", "be", "de", "net", "bizz", "online", "shop");

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if domain name is empty
    if(empty(trim($_POST["domain"]))) {
        $domain_err = "Please enter domain name.";
	} else {
		$domain =  explode('.', $_POST['domain'])[0];
		$domainExtension = explode('.', $_POST['domain'], 2)[1];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="css/utilities.css">
	<link rel="stylesheet" href="css/styles.css">
	<script src="scripts/script.js"></script>
    <title>Tom Emming | Domain availability checker</title>
</head>
<body>
	<!-- Showcase -->
	<section id='home' class="showcase">
		<div class="container grid-1 text-center py-5">
			<div class="showcase-text">
				<h1 class='lg'>Domain availability checker</h1>
				<h3 class='lead'>Check whether or not the domain is available for purchase</h3>
			</div>
			<div class="container flex py-5">
            	<div class="card">
					<form action="domain.php" method="post">
						<span class="input-group-text lead" id="basic-addon3">https://www.</span>
						<input type="text" onkeyup="fixme(this)" onblur="fixme(this)" name="domain" class="form-control lead" placeholder="domain.com" required value="<?php echo trim($_POST["domain"]); ?>">
						<input type="submit" class="btn btn-primary" value="Check →">
					</form>
            	</div>
			</div>
		</div>
	</section>

	<!-- Output -->
	<section class="output">
	<div class="container flex">
		<div class="card text-center">
			<table class="output-table m-2">
				<tr>
					<th class="md p-1">Domain Name</th>
					<th class="md p-1">Availability</th>
				</tr>
				<?php 
				if (isset($domainExtension)) {
					$fullDomainname = "$domain.$domainExtension";
					$domain_check = $api->domainAvailability()->checkDomainName($fullDomainname);
					$result = $domain_check->getStatus();
					if ($result === "free") { 
						$domAvail = "<td style='color: green;' class='table-output lead'><i style='color: green;'class='fas fa-check'></i>Available</td>";
					} else {
						$domAvail = "<td style='color: red;' class='table-output lead text-center'><i style='color: red;' class='fas fa-times'></i>Unavailable</td>";
					}	
					echo "<tr>";
					echo "<tr>";
					echo "<td class='table-output lead'><i class='fas fa-home'></i>$fullDomainname</td>";
					echo "$domAvail";
					echo "</tr>";
				}
				?>
			</table>
		</div>
	</section>