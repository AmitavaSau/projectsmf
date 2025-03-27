<section class="py-3">
	<div class="row mb-4">
		<div class="col-lg-12 mb-4 mb-lg-0">
			<div class="card">
				<div class="card-header">
					<h2 class="h6 text-uppercase mb-0">Activity Log</h2>
				</div>
				<div class="card-body">
					<table id="user_activity_listing" class="table table-striped table-bordered table-hover responsive datatbl" width="100%">
							<thead>
								<tr>
									<th style="width:5%">#</th>
									<th style="width:45%">Activity</th>
									<th style="width:30%">User</th>
									<th style="width:20%">Date</th>
								</tr>
							</thead>
								
							<tbody>
								<?php
									$n = 1;
									foreach($activities as $val) {
								?>
									<tr>
										<td><?php echo $n;?></td>
										<td><?php echo $val->at_message;?></td>
										<td><?php echo $val->user_fullname;?></td>
										<td><?php echo $val->activity_date;?></td>
									</tr>
								<?php	
										$n++;	
									}
								?>
							</tbody>
								
						</table>
				</div>			
            </div>
		</div>
	</div>
</section>	


<?php
$this->load->view("common/footer");
?>
