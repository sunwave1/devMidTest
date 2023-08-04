<?php

$qEdit = $http->query()->get('edit');
if( !empty($qEdit) && !$student = $sto->get( $qEdit ) ){
	$http->flash("Student not search!", "error");
	
	$http->redirect("index.php");
}

$student = $sto->get( $qEdit )['value'];
$studentReference = $sto->get( $qEdit )['reference'];

if($http->method() === 'POST'){
	
	/**
	 * Add term to student
	 */
	if($termId = $http->methodPost('term')){

		if($student->hasTerm( $termId )){
			
			$http->flash("Term has exists in student!", "error");
			
			return $http->redirect("?type=3&edit={$studentReference}");
		}

		$termReference = $terms->find( (int)$termId );

		if(empty($termReference)){

			$http->flash("Term not search!", "error");
			
			return $http->redirect("?type=3&edit={$studentReference}");
		}

		$student->addTerm($termReference['id'], [ 
			"name" => $termReference['name'],
			"grade" => []
		]);
	}

	

	/**
	 * Add grades to user
	 */
	$grade = $http->methodPost('grade');
	$termId = $http->methodPost('id');

	if(!empty($grade) && !empty($termId)){
		$student->addGrade($termId, $grade);
	}
	
	$http->redirect("?type=3&edit={$studentReference}");
}

?>


<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/index.php">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Student - <?= $student->getStudentName() ?></li>
  </ol>
</nav>

<form method="POST">
	<label for="term">Select a term for add a student - <?= $student->getStudentName() ?></label>
	<select class="form-select" id="term" name="term" aria-label="Default select">
	  <option value="null" selected>Select a term</option>
	  	<?php $termAll = $terms->all() ?>
		<?php if(count($termAll) > 0): ?>
			<?php foreach(array_diff_key($termAll, $student->terms) as $id => $term): ?>	
				<option value="<?= $id ?>"><?= $term ?></option>
			<?php endforeach; ?>
		<?php endif; ?>
	</select>
	
	<button class="btn btn-primary mt-1">Submit</button>
</form>

<?php $studentTerms = $student->getTerms() ?>
<?php if( count( $studentTerms ) > 0 ): ?>
	<h3 class="text-center">Term of student</h3>
	<hr>
	<?php foreach($studentTerms as $id => $term): ?>
		<form method="POST">
			<span>Name:</span> <?= $term['name'] ?>
			<input type="hidden" name="id" value="<?= $id ?>">
			<div class="row mt-2">
				<?php foreach(range(1, 4) as $index): ?>
					<div class="col-3 col-lg-5">
						<input type="number" value="<?= $student->getGradeByIndex($id, $index) ?>" name="grade[<?= $index ?>]" class="form-control mb-1" min="0" max="10" step="0.01" placeholder="...">
					</div>
				<?php endforeach; ?>
			</div>

			<button class="btn btn-primary">Submit</button>
			<button class="btn btn-danger">Remove</button>

			<span class="d-block mt-3">Result: <?= $student->getAverage( $id ) ?></span>
			<hr>
		</form>
	<?php endforeach; ?>
<?php endif; ?>
