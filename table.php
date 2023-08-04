<?php

/**
 * Create a function for calculate a table - Fellipe Anthony 01/08/23
 * github: sunwave1
 */
 
$tabResponse = NULL;

if($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['tab']){
    $tabResponse = (int)$_POST['tab'];
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
         <title>Table</title>
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css" integrity="sha512-Z/def5z5u2aR89OuzYcxmDJ0Bnd5V1cKqBEbvLOiUNWdg9PQeXVvXLI90SE4QOHGlfLqUnDNVAYyZi8UwUTmWQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body data-bs-theme="dark">
		<div class="container mt-4">
			<form method="POST" class="d-flex justify-content-center">
				<div class="card p-3">
					<label for="tab">Insert a number for create a table..</label>
					<input type="number" class="form-control" id="tab" name="tab" min="1" placeholder="number..">
					<button type="submit" class="btn btn-primary mt-2">Send</button>
				</div>
			</form>
			<?php if($tabResponse !== NULL): ?>
				<h4 class="text-center">Answer:</h4>
				<div class="card p-2 mx-2 text-center">
					<?php foreach(range(1, 10) as $key => $data): ?>
						<div>
							<span class="fw-bold"><?= $tabResponse ?> * <?= $key ?></span> = <?= $tabResponse * $key?>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
    </body>
</html>