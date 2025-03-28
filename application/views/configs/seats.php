<section class="py-1">
	<div class="row mb-4">
		<div class="col-lg-12 mb-4 mb-lg-0">
			<div class="card h-60">
				<div class="card-header">
					<h2 class="h6 text-uppercase mb-0">Seats</h2>
				</div>
				<div class="card-body scroll">
					<table id="seat_listing" class="table table-striped table-bordered table-hover responsive no-footer">
						<thead>
							<tr>
								<th>Code</th>
								<th>College Name</th>
								<th>Course</th>
								<th>Course Name</th>
								<th>GEN</th>
								<th>SC</th>
								<th>ST</th>
								<th>OBC-A</th>
								<th>OBC-B</th>
								<th>PWD</th>
								<!--<th>GEN (S)</th>
								<th>SC (S)</th>-->
							</tr>
						</thead>
						<tbody>	
						</tbody>
					</table>
				
				</div>
			</div>
		</div>
				
	</div>
	
	<div class="row mb-4">	
		<div class="col-lg-12 mb-4 mb-lg-0">
			<div class="card h-50 mb-4">
				<div class="card-header">
					<h2 class="h6 text-uppercase mb-0">New/Edit Seat</h2>
				</div>
				<div class="card-body">
					<?php
					$form = array(
						'class'		=>	'',
						'role'		=>	'form',
						'id' 		=> 	'seatform'
					);	
					echo form_open('configs/create_seat', $form);
					?>
					
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
							<?php
								$colleges = array(
									'id'    => 	'col_code',
									'class' => 	'form-control selectpicker',
									'data-style' => 'select-picker',
									'data-live-search' => 'true',
									'title' => 'Select College'
								);
								echo form_dropdown('col_code', $college_options, null, $colleges);
							?>
							</div>
						</div>
						
						<div class="col-md-2">
							<div class="form-group">
							<?php
								$crs = array(
									'id'    => 	'crs_code',
									'class' => 	'form-control selectpicker',
									'data-style' => 'select-picker',
									'data-live-search' => 'true',
									'title' => 'Select Course'
								);
								echo form_dropdown('crs_code', $course_options, null, $crs);
							?>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
							<?php
								$crs_name = array(
									'id'    => 	'crs_name',
									'class' => 	'form-control selectpicker',
									'data-style' => 'select-picker',
									'data-live-search' => 'true',
									'title' => 'Select Course Name'
								);
								echo form_dropdown('crs_name', $course_name_options, null, $crs_name);
							?>
							</div>
						</div>
						
					</div>
					
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<small>GENERAL</small>
								<input type="text" name="cat_ge" id="cat_ge" placeholder="GENERAL" class="form-control">
							</div>
						</div>
						
						<div class="col-md-2">
							<div class="form-group">
								<small>SC</small>
								<input type="text" name="cat_sc" id="cat_sc" placeholder="SC" class="form-control">
							</div>
						</div>
						
						<div class="col-md-2">
							<div class="form-group">
								<small>ST</small>
								<input type="text" name="cat_st" id="cat_st" placeholder="ST" class="form-control">
							</div>
						</div>
						
						<div class="col-md-2">
							<div class="form-group">
								<small>OBC-A</small>
								<input type="text" name="cat_oa" id="cat_oa" placeholder="OBC-A" class="form-control">
							</div>
						</div>
						
						<div class="col-md-2">
							<div class="form-group">
								<small>OBC-B</small>
								<input type="text" name="cat_ob" id="cat_ob" placeholder="OBC-B" class="form-control">
							</div>
						</div>
						
						<div class="col-md-2">
							<div class="form-group">
								<small>PWD</small>
								<input type="text" name="cat_pw" id="cat_pw" placeholder="PWD" class="form-control">
							</div>
						</div>
					
					</div>			
					
					<div class="row">
						<!--<div class="col-md-2">
							<div class="form-group">
								<small>GENERAL (S)</small>
								<input type="text" name="cat_sp_ge" id="cat_sp_ge" placeholder="GENERAL (S)" class="form-control">
							</div>
						</div>-->
						
						<!--<div class="col-md-2">
							<div class="form-group">
								<small>SC (S)</small>
								<input type="text" name="cat_sp_sc" id="cat_sp_sc" placeholder="SC (S)" class="form-control">
							</div>
						</div>-->
						
						<div class="col-md-6">
							<div class="form-group">
								<div class="mb-1">&nbsp;</div>
								<input type="hidden" id="action" value='CREATE'>
								<input type="hidden" id="seat_sl" value=''>
								<button type="button" class="btn btn-primary btn-seat-save">Save</button>
								<button type="button" class="btn btn-danger btn-seat-delete ml-3" style="display: none;">Delete</button>
								
								<button type="button" class="btn btn-dark btn-seat-cancel ml-3">Cancel</button>
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