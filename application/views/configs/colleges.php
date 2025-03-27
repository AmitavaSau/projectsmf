<section class="py-1">
	<div class="row mb-4">
		<div class="col-lg-6 mb-4 mb-lg-0">
			<div class="card h-100">
				<div class="card-header">
					<h2 class="h6 text-uppercase mb-0">Colleges</h2>
				</div>
				<div class="card-body scroll">
					<table id="college_listing" class="table table-striped table-bordered table-hover responsive no-footer">
						<thead>
							<tr>
								<th>Code</th>
								<th>Name</th>
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
					<h2 class="h6 text-uppercase mb-0">New/Edit College</h2>
				</div>
				<div class="card-body">
					<?php
					$form = array(
						'class'		=>	'',
						'role'		=>	'form',
						'id' 		=> 	'collegeform'
					);	
					echo form_open('configs/create_college', $form);
					?>
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
							
								<div class="col-md-4 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
									<input type="text" name="col_code" id="col_code" placeholder="Code" class="form-control">
								</div>
								<div class="col-md-8 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
									<input type="text" name="col_name" id="col_name" placeholder="College Name" class="form-control">
								</div>
							</div>
							<div class="row mt-2">
							
								<div class="col-md-12 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
									<textarea name="col_address" id="col_address" placeholder="College Address" class="form-control"></textarea>
								</div>
								
							</div>	
							<div class="row mt-2">
								<div class="col-md-4 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
									<input type="hidden" id="action" value='CREATE'>
									<input type="hidden" id="col_sl" value=''>
									<button type="button" class="btn btn-primary btn-college-save">Save</button>
									<button type="button" class="btn btn-danger btn-college-delete ml-3" style="display: none;">Delete</button>
									
									<button type="button" class="btn btn-dark btn-college-cancel ml-3">Cancel</button>
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