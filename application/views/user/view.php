<section class="py-3">
	<div class="row mb-4">
		<div class="col-lg-12 mb-4 mb-lg-0">
			<div class="card mb-3">
            	<div class="card-body">
                	<div class="row align-items-center flex-row">
                		<div class="col-lg-3">
                			<img src="<?php echo getFileLocation('user-profile') . $user->user_photo;?>" alt="<?php echo $user->user_name;?>" class="rounded-circle my-2">
                  		</div>
                  		<div class="col-lg-9">
                  			<h2 class="mx-auto mb-0 text-uppercase"><?php echo $user->user_fullname;?></h2>
	                  		<span class="text-muted text-uppercase"><?php echo $user->role_name;?></span><br>
	                  		
	                  		<span class="text-muted text-uppercase"><?php echo $user->user_mobile;?></span><br>
	                  		
	                  		<span class="text-muted text-lowercase"><?php echo $user->user_email;?></span>
                  		
                  			<p class="mt-3">
                  				<a href="<?php echo $this->config->base_url();?>users/edit/<?php echo $user->user_ref;?>" class="btn btn-primary">Edit Information</a>
                  			</p>
                  		</div>
                  		
                	</div>
              	</div>
            </div>
		</div>
	</div>
</section>

<?php
$this->load->view("common/footer");
?>		