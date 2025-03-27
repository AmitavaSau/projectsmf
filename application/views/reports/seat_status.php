<section class="py-3">
	<div class="row mb-4">
		<div class="col-lg-12 mb-4 mb-lg-0">
			<div class="card">
				<div class="card-header">
					<div class="row d-flex align-items-center flex-columnle">
						<div class="col-md-9">
							<h2 class="h6 text-uppercase mb-0">Seat Status</h2>
						</div>  
						<div class="col-md-3 text-right">
							<a href="javascript:void(0)" class="download-seatstatus-pdf" style="display: none;">Download</a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<table id="seatstatus_listing" class="table table-striped table-bordered table-hover responsive" width="100%">
							<thead>
								<tr>
									<th rowspan=2 style="width:40%">College</th>
									<th rowspan=2 style="width:10%">Course</th>
									<?php
										foreach($category_option as $key=>$val) {
											$num = count($category_option);
											$width = 50/($num-1);
											if($val !=''){
									?>
									<th colspan=3 style="width:<?php echo $width;?>%"><?php echo $val;?></th>
									<?php
											}		
										}
									?>
									
								</tr>
								<tr>
									<?php
										foreach($category_option as $key=>$val) {
											if($val !=''){
									?>
									<th>Tot</th>
									<th>Fil</th>
									<th>Vac</th>
									<?php
											}		
										}
									?>
									
								</tr>
							</thead>
								
							<tbody>
								
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