<section class="py-3">
	<div class="row mb-4">
		<div class="col-lg-12 mb-4 mb-lg-0">
			<div class="card">
				<div class="card-body">
					<h1 class="text-uppercase mb-3 text-red page404">404</h1>
					<h3 class="mb-5 text-muted">Page Not Found</h3>
					<p class="text-muted">
						Return to <a href="<?php echo $this->config->base_url();?>dashboard">Dashboard</a>
					</p>
				</div>			
            </div>
		</div>
	</div>
</section>

<?php
$this->load->view("common/footer");
?>		