<?php

$qRemove = $http->query()->get('remove');
$qRedirect = $http->query()->get('redirect');

if( !empty( $qRemove ) ){
	
	if( $terms->hasId( $qRemove ) ){

        $terms->erase( (int)$qRemove );
		
		$http->flash("Term removed with success!!");
		
	}
	
	if( !empty( $qRedirect ) ){
		return $http->redirect( $qRedirect );
	}
	
	$http->redirect("index.php?type=2");
}

if($http->method() === 'POST'){
	
	if($termName = $http->methodPost('term_name')){

        if( $terms->has( $termName ) ){

            $http->flash("Term already exists!");

            return $http->redirect("index.php?type=2");
        }

		$terms->add($termName, $termName);

        $http->flash("Term create!");
	}

	$http->redirect("index.php?type=2");
}
?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/index.php">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Term</li>
  </ol>
</nav>

<h2 class="text-center">Create a Term</h2>

<hr class="mb-4">

<form method="POST">
	<label for="term_name" class="form-label">Name of term</label>
	<div class="input-group">
		<input type="text" name="term_name" id="term_name" class="form-control" placeholder="term name.." aria-label="term name">
	</div>
	
	<button type="submit" class="btn btn-primary mt-2">Submit</button>
</form>
<?php $allTerms = $terms->all() ?>
<?php if( count( $allTerms ) > 0 ): ?>
	<h3 class="text-center">Terms</h3>
	<hr/>
	<?php foreach($allTerms as $id => $term): ?>
		<div class="w-50 card p-3 mt-2">
			<div class="row">
				<div class="col-8 col-lg-8">
                    <div>
                        <span class="fw-bold">Name:</span> <span> <?= $term ?> </span>
                    </div>
				</div>
				<div class="col-4 col-lg-4 d-flex justify-content-center">
					<a href="/?type=2&remove=<?= $id ?>" class="align-self-center"> 
						<i class="fa-solid fa-trash"></i> 
					</a>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
<?php endif; ?>