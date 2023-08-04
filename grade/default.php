<?php 
	$students = storage()->all();
?>

<div>
	<a href="/index.php?type=1" class="btn btn-primary">Create students</a>
	<a href="/index.php?type=2" class="btn btn-primary">Terms</a>
</div>

<h2 class="text-center">All Students</h2>

<hr class="mb-4">

<?php if( count($students) > 0 ): ?>
	<?php foreach($students as $uuId => $student): ?>
		<div class="card p-3 mt-2">
			<div class="row">
				<div class="col-6 col-lg-6">
					<div>
						<span class="fw-bold">Name:</span> <span> <?= $student['value']->getStudentName() ?> </span>
					</div>
					<div>
						<span class="fw-bold">Class:</span> <span> <?= $student['value']->getClassName() ?> </span>
					</div>
				</div>
				<div class="col-2 col-lg-2 d-flex justify-content-center">
					<a href="/?type=1&remove=<?= $uuId ?>&redirect=/index.php" class="align-self-center"> 
						<i class="fa-solid fa-trash"></i> 
					</a>
				</div>
				<div class="col-2 col-lg-2 d-flex justify-content-center">
					<a href="/?type=3&edit=<?= $uuId ?>" class="align-self-center"> 
						<i class="fa-solid fa-user-pen"></i>
					</a>
				</div>
				<div class="col-2 col-lg-2 d-flex justify-content-center align-items-center">
					<a data-bs-toggle="collapse" href="#collapseExample<?= $student['value']->getStudentName() ?>" role="button" aria-expanded="false" aria-controls="collapseExample<?= $student['value']->getStudentName() ?>">
						<i class="fa-solid fa-arrow-down"></i>
					</a>
				</div>
			</div>
			<div class="collapse" id="collapseExample<?= $student['value']->getStudentName() ?>">
				<div class="row flex-column">
					<?php foreach($student['value']->getTerms() as $id => $term): ?>
						<div class="col">
							<span class="d-block mt-2"><span class="fw-bold">Name:</span> <span><?= $term['name'] ?></span></span>
							<span class="d-block mb-2"><span class="fw-bold">Average:</span> <span><?= $student['value']->getAverage($id) ?></span></span>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
<?php endif; ?>