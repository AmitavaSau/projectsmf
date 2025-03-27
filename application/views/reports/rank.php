<section class="py-3">
	<div class="row mb-4">
		<div class="col-lg-12 mb-4 mb-lg-0">
			<div class="card h-100">
				<div class="card-header">
					<div class="row d-flex align-items-center flex-columnle">
						<div class="col-md-9">
							<h2 class="h6 text-uppercase mb-0">Rank List</h2>
						</div>  
						<div class="col-md-3 text-right">
							<a href="javascript:void(0)" class="download-rank-pdf" style="display: none;">Download</a>
						</div>
					</div>
				</div>
				<div class="card-body scroll">
					<table id="rank_listing" class="table table-striped table-bordered table-hover responsive" width="100%">
							<thead>
								<tr>
									<th style="width:8%">Rank #</th>
									<th style="width:12%">Roll Num</th>
									<th style="width:25%">Candidate</th>
									<th style="width:25%">Father's Name</th>
									<th style="width:15%">Gender</th>
									<th style="width:15%">Category</th>
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