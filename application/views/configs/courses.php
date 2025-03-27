<?php

?><section class="py-1">
	<div class="row mb-4">
		<div class="col-lg-6 mb-4 mb-lg-0">
			<div class="card h-100">
				<div class="card-header">
					<h2 class="h6 text-uppercase mb-0">Courses</h2>
				</div>
				<div class="card-body scroll">
					<table id="courses_listing" class="table table-striped table-bordered table-hover responsive no-footer">
						<thead>
							<tr>
								<th>Course</th>
								<th>Dept.</th>
								<th>Course Name</th>
							</tr>
						</thead>
						<tbody>	
						</tbody>
					</table>
				
				</div>
			</div>
		</div>
				
		<div class="col-lg-6 mb-4 mb-lg-0">
			<div class="card h-50 mb-4">
				<div class="card-header">
					<h2 class="h6 text-uppercase mb-0">New/Edit Courses</h2>
				</div>
				<div class="card-body">
					<?php
					$form = array(
						'class'		=>	'',
						'role'		=>	'form',
						'id' 		=> 	'courseform'
					);	
					echo form_open('configs/create_course', $form);
					?>
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
							
								<div class="col-md-4 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
							<?php
								$course = array(
									'id'    => 	'crs_course',
									'class' => 	'form-control selectpicker',
									'data-style' => 'select-picker',
									'data-live-search' => 'false',
									'title' => 'Select Course'
								);
								echo form_dropdown('crs_course', $course_options, null, $course);
							?>
								</div>
								<div class="col-md-4 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
									<input type="text" name="crs_dept" id="crs_dept" placeholder="Department" class="form-control">
								</div>
							</div>	
							<div class="row mt-2">
								<div class="col-md-12 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
									<input type="text" name="crs_name" id="crs_name" placeholder="Course Name" class="form-control">
								</div>
							</div>
								
							<div class="row mt-2">
								<div class="col-md-4 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
									<input type="hidden" id="action" value='CREATE'>
									<input type="hidden" id="crs_sl" value=''>
									<button type="button" class="btn btn-primary btn-course-save">Save</button>
									<button type="button" class="btn btn-danger btn-course-delete ml-3" style="display: none;">Delete</button>
									
									<button type="button" class="btn btn-dark btn-course-cancel ml-3">Cancel</button>
								</div>
							</div>
						</div>
					</div>			
					</form>	
				</div>
			</div>
		</div>
		
	</div>
		
</section>
	

<?php
$this->load->view("common/footer");
?>