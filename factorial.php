<?php

/**
 * Create a function for calculate factorial - Fellipe Anthony 01/08/23
 * github: sunwave1
 */
 
function fac($n){
    return $n < 2 ? 1 : $n * fac( $n - 1);
};

$facResponse = NULL;

if($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['n_fac']){
    $facResponse = fac((int)$_POST['n_fac']);
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
         <title>Factorial</title>
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css" integrity="sha512-Z/def5z5u2aR89OuzYcxmDJ0Bnd5V1cKqBEbvLOiUNWdg9PQeXVvXLI90SE4QOHGlfLqUnDNVAYyZi8UwUTmWQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body data-bs-theme="dark">
		<div class="container mt-4">
			<form method="POST" class="d-flex justify-content-center">
				<div class="card p-3">
					<label for="fac">Insert a number for factorial..</label>
					<input type="number" class="form-control" id="fac" name="n_fac" min="2" placeholder="number..">
					<button type="submit" class="btn btn-primary mt-2">Send</button>
				</div>
				<?php if($facResponse !== NULL): ?>
					<div class="card p-2 mx-2">
						<div>Awnser: <?= $facResponse ?></div>
					</div>
				<?php endif; ?>
			</form>
		</div>
    </body>
</html>