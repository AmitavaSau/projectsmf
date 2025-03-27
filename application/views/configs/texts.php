<section class="py-1">
	<div class="row mb-4">
		<div class="col-lg-8 mb-4 mb-lg-0">
			<div class="card h-100">
				<div class="card-header">
					<h2 class="h6 text-uppercase mb-0">Text Content</h2>
				</div>
				<div class="card-body scroll">
					<table id="content_listing" class="table table-striped table-bordered table-hover responsive" width="100%">
						<thead>
							<tr>
								<th style="width:3%">#</th>
								<th style="width:30%">Text Key</th>
								<th style="width:67%">Value</th>
							</tr>
						</thead>
							
						<tbody></tbody>
					</table>		
				</div>
			</div>
		</div>
		
		<div class="col-lg-4 mb-4 mb-lg-0">
			<div class="card h-50 mb-4">
				<div class="card-header">
					<h2 class="h6 text-uppercase mb-0">New/Edit Content</h2>
				</div>
				<div class="card-body">
					<?php
					$form = array(
						'class'		=>	'',
						'role'		=>	'form',
						'id' 		=> 	'contentform'
					);	
					echo form_open('configs/create_content', $form);
					?>
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
							
								<div class="col-md-12 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
									<input type="text" name="conf_name" id="conf_name" placeholder="Text Key" class="form-control">
								</div>
							</div>
							<div class="row mt-2">
							
								<div class="col-md-12 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
									<textarea name="conf_value" id="conf_value" placeholder="Value" class="form-control"></textarea>
								</div>
								
							</div>	
							<div class="row mt-2">
								<div class="col-md-4 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
									<input type="hidden" id="action" value='CREATE'>
									<input type="hidden" id="conf_sl" value=''>
									<button type="button" class="btn btn-primary btn-text-save">Save</button>
									<button type="button" class="btn btn-danger btn-text-delete ml-3" style="display: none;">Delete</button>
									
									<button type="button" class="btn btn-dark btn-text-cancel ml-3">Cancel</button>
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
	

<!-- The Modal -->
<div class="modal" id="student_modal">
	<div class="modal-dialog modal-lg">
    	<div class="modal-content">
    		<!-- Modal Header -->
      		<div class="modal-header">
        		<h2 class="h6 text-uppercase mb-0">Student Information</h2>
      		</div>

      		<!-- Modal body -->
      		<div class="modal-body">
        	<?php
				$form = array(
					'class'		=>	'form-horizontal',
					'role'		=>	'form',
					'id' 		=> 	'studentform'
				);	
				echo form_open('configs/save_students', $form);
			?>	
      			
      			<div class="form-group row">
                	<label class="col-md-3 form-control-label">Roll Number</label>
                	<div class="col-md-3">
                  		<input id="appl_roll_num" name="appl_roll_num" type="text" placeholder="Roll Number" class="form-control">
                	</div>
                	
                	<label class="col-md-3 form-control-label">Form Number</label>
                	<div class="col-md-3">
                  		<input id="appl_form_num" name="appl_form_num" type="text" placeholder="Form Number" class="form-control">
                	</div>
              	</div>
              	
              	<div class="form-group row">
                	<label class="col-md-3 form-control-label">Candidate Name</label>
                	<div class="col-md-6">
                  		<input id="appl_fullname" name="appl_fullname" type="text" placeholder="Candidate Fullname" class="form-control">
                	</div>
              	</div>
              	
              	<div class="form-group row">
                	<label class="col-md-3 form-control-label">Father's Name</label>
                	<div class="col-md-6">
                  		<input id="appl_fathername" name="appl_fathername" type="text" placeholder="Father's Fullname" class="form-control">
                	</div>
              	</div>
              	
              	<div class="form-group row">
                	<label class="col-md-3 form-control-label">Category</label>
                	<div class="col-md-3">
              		<?php
						$category = array(
							'id'    => 	'appl_category',
							'name'   => 'appl_category',
							'class' => 	'form-control selectpicker',
							'data-style' => 'select-picker',
							'title' => 'Select Category'
						);
						echo form_dropdown('appl_category', $category_options, null, $category);
					?>
                	</div>
                	
                	<label class="col-md-3 form-control-label">Date of Birth</label>
                	<div class="col-md-3">
                  		<input id="appl_dob" name="appl_dob" type="text" placeholder="Date of Birth" class="form-control">
                	</div>
              	</div>
              	
              	<div class="form-group row">
              		<label class="col-md-3 form-control-label">&nbsp;</label>
              		<div class="col-md-9">
              			<input type="hidden" id="action" value='CREATE'>
						<input type="hidden" id="appl_sl" value=''>
              			<button type="button" class="btn btn-primary btn-student-save">Save</button>
						<button type="button" class="btn btn-danger btn-student-delete ml-3" style="display: none;">Delete</button>
									
              			<button type="button" class="btn btn-dark btn-student-cancel ml-3" >Cancel</button>
              		</div>	
              	</div>
      				
      		</form>
      		</div>

      		<!-- Modal footer -->
      		<div class="modal-footer">
        		
      		</div>

    	</div>
  	</div>
</div>


<?php
$this->load->view("common/footer");
?>