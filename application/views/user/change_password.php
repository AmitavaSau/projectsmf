<section class="py-3">
	<div class="row mb-4">
		<div class="col-lg-12 mb-4 mb-lg-0">
			<div class="card">
				<div class="card-header">
					<h2 class="h6 text-uppercase mb-0">Change Password</h2>
				</div>
				<div class="card-body">
				<?php
				if($this->session->flashdata('failure')){
				?>
				<h3 class="mb-3 text-red"><?php echo $this->session->flashdata('failure');?></h3>
				<?php
				}
				elseif($this->session->flashdata('success')){
				?>
				<h3 class="mb-3 text-green"><?php echo $this->session->flashdata('success');?></h3>
				<?php		
				}
				?>
				
				<?php
					$form = array(
						'class'		=>	'',
						'role'		=>	'form',
						'id' 		=> 	'passform'
					);	
					echo form_open('user/change_password', $form);
				?>
						<div class="form-group row">
							<label class="col-md-2 form-control-label">New Password</label>
							<div class="col-md-3">
								<input type="password" name="user_password" id="user_password" class="form-control">
							</div>
							<div class="col-md-3">
								<button type="button" class="btn btn-primary btn-change-pass">Save</button>
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
