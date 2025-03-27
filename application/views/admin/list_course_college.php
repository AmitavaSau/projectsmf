<section>
		<div class="row mb-4">
			<div class="col-lg-12 mb-4 mb-lg-0">
				<div class="card">
					<div class="card-header">
						<h1 class="h6 text-uppercase mb-0" style="text-align: center;"><?php echo $college_name;?></h1>
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
											<th style="width:5%">Reg No</th>
											
											<th style="width:15%">Name</th>
											<th style="width:8%">Rank</th>
											<th style="width:20%">Alloted Course</th>
											<th style="width:8%">Category</th>
											<th style="width:8%">Alloted Category</th>
											
											<!--<th style="width:10%">Dv Status</th>-->
											<?php if($_SESSION['AX_role_id']=='10'){?> 
											<th style="width:30%">Student Reported Status</th>
											<?php
											}
											?>
														
										</tr>
									</thead>
													
									<tbody>
									<?php
									if(!empty($college_result)){
									$n = 1;
									
									//echo '<pre>'; print_r($college_result); exit();
										foreach($college_result as $can){
									?>
										<tr>
											<td><?php echo $n;?></td>
											<td><?php echo $can['appl_reg_num'];?></td>
											<td><?php echo $can['appl_fullname'];?></td>
											
											<td>
											<?php 
												if(isset($can['appl_gmr']))
											 	{	
											 		echo $can['appl_gmr'];
												}
												
											?>	
											</td>	
											<td>
											<?php
												echo $can['crs_name']
											?>
											</td>
											<td><?php echo $can['appl_category']; ?> </td>
											
											<td><?php echo $can['alloted_category']; ?> </td>
											
											<?php if($_SESSION['AX_role_id']=='10'){?> 
											
											<td>
											<?php if($can['cand_refund']=='0'){?>
											<?php if($can['cand_clg_report']=='0'){?> 
												<div class="row"> 
												<div class="col-md-4 mr-4">

												<button type="button" data-cand_code="<?php echo $can['appl_reg_num'];?>" data-report="1" class="btn btn-success btn-clg-report">Reported</button>
												</div>
										  		<div class="col-md-2">

												<button type="button" data-cand_code="<?php echo $can['appl_reg_num'];?>" data-report="2" class="btn btn-info btn-clg-report">Not Reported</button>
												</div>
												</div>
											<?php
												}
												else if($can['cand_clg_report']=='1'){
												echo 'Reported';
												}else if($can['cand_clg_report']=='2'){
												echo 'Not Reported';
												}
											}else{
											echo 'Requested For Refund';
											}
											?>
												
											</td>
											
											<?php
											}
											?>
											
															
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