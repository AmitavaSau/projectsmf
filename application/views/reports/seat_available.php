<section class="py-3">
	<div class="row mb-4">
		<div class="col-lg-12 mb-4 mb-lg-0">
			<div class="card">
				<div class="card-body">
					<div class="fullscreen">
						<h3 class="mt-3 col_name"></h3>
						<table id="seat_available" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th style="width:35%">COURSE</th>
									<th style="width:9%;text-align: center;">GENERAL</th>
									<th style="width:7%;text-align: center;">SC</th>
									<th style="width:7%;text-align: center;">ST</th>
									<th style="width:9%;text-align: center;">OBC A</th>
									<th style="width:9%;text-align: center;">OBC B</th>
									<th style="width:7%;text-align: center;">PWD</th>
									<!--<th style="width:10%;text-align: center;">GENERAL (S)</th>-->
									<!--<th style="width:7%;text-align: center;">SC (S)</th>-->
								</tr>
							</thead>
							
							<tbody></tbody>
								
						</table>
						
						
					</div>
					
					<div class="row">
						<div class="col-md-3">
							<div class="form-group mt-3">
							
								<a href="#" class="btn btn-primary requestfullscreen">View Fullscreen</a>
							</div>
						</div>
						<input type="hidden" id="col_type" class="form-control" name="col_type" value="<?php echo $type; ?>">
						<!--
						<div class="col-md-1">
							<div class="form-group mt-3">
								<input type="text" id="timer_val" class="form-control" value="5"> seconds
							</div>
						</div>-->
						
					</div>			
					
				</div>
			</div>
			
			
			
		</div>
	</div>
</section>	

			


<?php
$this->load->view("common/footer");
?>