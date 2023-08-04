<?php

require_once __DIR__ . "/lib.php";

session_start();

$http = http();
$sto = storage();
$terms = terms();

$compac = compact('http', 'sto', 'terms');

?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
        <title>Grade</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css" integrity="sha512-Z/def5z5u2aR89OuzYcxmDJ0Bnd5V1cKqBEbvLOiUNWdg9PQeXVvXLI90SE4QOHGlfLqUnDNVAYyZi8UwUTmWQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js" integrity="sha512-Sct/LCTfkoqr7upmX9VZKEzXuRk5YulFoDTunGapYJdlCwA+Rl4RhgcPCLf7awTNLmIVrszTPNUFu4MSesep5Q==" crossorigin="anonymous" referrerpolicy="no-referrer" async defer></script>
	</head>
    <body data-bs-theme="dark">
	
		<div class="container mt-4">
			<?php if( $http->hasFlash() ): ?>
				<div class="alert alert-<?= $http->getType() == "error" ? "danger" : "success" ?>" role="alert">
					<?= $http->show() ?>
				</div>
			<?php endif; ?>
			
			<?php 
				$query = $http->query()->get('type');
				if(!is_null($query)){
					switch( $query ){
						case 1: {
							
							echo http()->view( __DIR__ . "/students.php", $compac);
							
							break;
						}
						
						case 2: {
							
							echo http()->view( __DIR__ . "/term.php", $compac);
							
							break;
						}
						
						case 3: {
							
							echo http()->view( __DIR__ . "/edit.php", $compac);
							
							break;
						}
						
						default: {
							
							echo "No match.";
							
							break;
						}
					}
				} else {
					echo http()->view( __DIR__ . "/default.php", $compac);
				}
			?>
		</div>
    </body>
</html>