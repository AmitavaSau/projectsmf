<section>
		<div class="row mb-4">
			<div class="col-lg-12 mb-4 mb-lg-0">
				<div class="card">
					<div class="card-header">
					<div class="row">
						<div class="col-md-9">	
							<h2 class="h6 text-uppercase mb-0"><?php echo $page_title;?></h2>
						</div>
						<div class="col-md-3 text-right">
							<a href="<?php echo $this->config->base_url(); ?>reports/college_wise_report_dump_all"> Download </a>
						</div>
					</div>
					</div>
					<div class="card-body">
						 

						<!-- /////// Candidate Show ///////// -->

				<div class="row mb-4">
					<div class="col-lg-12 mb-4 mb-lg-0">
						<div class="card">
				

							<div class="card-body">
										
								<table id="user_activity_listing" class="table table-striped table-bordered table-hover responsive datatbl" width="100%">
									<thead>
										<tr>
											<th style="width:5%">#</th>
											<th style="width:70%">College Name</th>
											<th style="width:7%">Alloted</th>
											<th style="width:7%">Download</th>
			
										</tr>
									</thead>
													
									<tbody>
									<?php
									if(!empty($result)){
									$n = 1;
									
									//echo '<pre>'; print_r($all_candidate); exit();
										foreach($result as $can){
									?>
										<tr>
											<td><?php echo $n;?></td>
											 
											<td><?php echo $can['col_name'];?>
												
											</td>
											<td><?php echo  $can['alloted'] ?></td>
											<td>
											 <a href="<?php echo $this->config->base_url(); ?>reports/college_wise_report_dump/<?php echo $can['college_code'];?>"> Download </a>
											</td>
															
										</tr>
									<?php	
										$n++;	
									}
								}
								else{


									}
									?>
								</tbody>
													
								</table>
							</div>
						</div>
					</div>
				</div>

						<!-- //////// Candidate Show Ends /////// -->
			</div>
		</div>
	</div>
</div>


		
	</section>

	

<?php
$this->load->view("common/footer");
?>