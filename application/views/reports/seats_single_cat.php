
<style>
	thead{
		background-color:black !important;
		color:white !important;
		/* width: 100%; */
	}
	th{
		/* font-size:8px !important; */
		/* width:auto !important; */
		padding: 1px 1px !important;
		text-align: center !important;
		
	}
	td{
		
		padding: 1px 1px !important;
		text-align: center !important;
	}
	 #clg_name{
		/* color:blue !important; */
		font-size:12px !important;
		text-align:left !important;
		padding-left:7px !important
		} 
</style>
<section class="py-3">
	<div class="row mb-4">
		<div class="col-lg-12 mb-4 mb-lg-0">
			<div class="card">
				<div class="card-body">
					<div class="fullscreen_single">
						<h3 class="mt-3 col_name"></h3>
						<table id="seat_available_all_cat" class="table table-striped table-bordered table-hover"  style="height:500px !important" style="width:100% !important;">
							<thead>
							    <?php $type_arr     =   array(
							        'ge'    => 'GENERAL',
							        'st'    =>  'ST',
							        'sc'    =>  'SC',
							        'oa'    =>  'OBC-A',
							        'ob'    =>  'OBC-B',
							        'pw'    =>  'PWD'
							        );
							    ?>       
							    
								<tr style="display: block;">
									
									
									 <th style="width:50px">Sl.</th>
									 <th style="width:400px">College</th>
                                    <th style="width:50px">Type</th>
                                    <th style="width:60px">category</th>

									<th style="width:50px">DMLT</th>
									<th style="width:50px">DRD</th>
									<th style="width:50px">DPT</th>
									<th style="width:50px">DRT</th>
									
									<th style="width:60px">D.OPT</th>
									<th style="width:50px">DNEP</th>
                                    <th style="width:50px">DPFT</th>
                                    <th style="width:50px">DCLT</th>
                                    <th style="width:60px">DIALYSIS</th>
                                    <th style="width:50px">DCCT</th>
                                    <th style="width:50px">DOTT</th>
                                    <th style="width:50px">DDCT</th>
                                    <th style="width:50px">ECG</th> 
                                    <th style="width:50px">Total</th> 
								</tr>
							</thead>
							
							

                            <tbody id="scrolling_contentall" style="display:block;overflow: auto;height:710px;width: 100%;"></tbody>
								
						</table>
						
						
					</div>
					
							<div class="row">
						<div class="col-md-3">
							<div class="form-group mt-3">
							
								<a href="#" class="btn btn-primary requestfullscreensingle">View Fullscreen</a>
							</div>
						</div>
                        <input type="hidden" id="category" class="form-control" name="category" value="<?php echo $category; ?>">
						<!--
						<div class="col-md-1">
							<div class="form-group mt-3">
								<input type="text" id="timer_val" class="form-control" value="5"> seconds
							</div>
						</div>-->
						
					</div>			
					
					
			
			
			
			
		</div>
	</div>
</section>	

	


<?php
$this->load->view("common/footer");