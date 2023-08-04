<?php

$qEdit = $http->query()->get('remove');
$qRedirect = $http->query()->get('redirect');

if( !empty($qEdit) ){
	if( $studentRemove = $sto->get( $qEdit )){

		$sto->erase( $qEdit );
		
		$http->flash("Student removed with success!");
		
	}
	
	if( !empty( $qRedirect ) ){
		return $http->redirect( $qRedirect );
	}
	
	$http->redirect("index.php?type=1");
}

if($http->method() === 'POST'){

	$studentName = $http->methodPost('student_name');
	
	$studentClass = $http->methodPost('class_student');

	if(
		!empty($studentName)
		&&
		!empty($studentClass)
	){
		$sto->set(
			uuId(),
			new Student($studentName, $studentClass),
			function($value){
				unset($value);
			}
		);
	}

	$http->redirect("index.php?type=1");
}
?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/index.php">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Student</li>
  </ol>
</nav>

<h2 class="text-center">Create Student</h2>

<hr class="mb-4">

<form method="POST">
	<label for="student_name" class="form-label">Name of student</label>
	<div class="input-group">
		<input type="text" name="student_name" id="student_name" class="form-control" placeholder="student name.." aria-label="student name">
	</div>
	
	<label for="class_student" class="form-label mt-2">Class of student</label>
	<div class="input-group">
		<input type="text" name="class_student" id="class_student" class="form-control" placeholder="class of student" aria-label="class student">
	</div>
	
	<button type="submit" class="btn btn-primary mt-2">Submit</button>
</form>

<?php $students = $sto->all() ?>
<?php if( count( $students ) > 0 ): ?>
	<h3 class="text-center">Students</h3>
	<hr/>
	<?php foreach($students as $uuId => $student): ?>
		<div class="w-50 card p-3 mt-2">
			<div class="row">
				<div class="col-8 col-lg-8">
					<div>
						<span class="fw-bold">Name:</span> <span> <?= $student['value']->getStudentName() ?> </span>
					</div>
					
					<div>
						<span class="fw-bold">Class:</span> <span> <?= $student['value']->getClassName() ?> </span>
					</div>
				</div>
				<div class="col-4 col-lg-4 d-flex justify-content-center">
					<a href="/?type=1&remove=<?= $uuId ?>" class="align-self-center"> 
						<i class="fa-solid fa-trash"></i> 
					</a>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
<?php endif; ?>