
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
					<div class="fullscreenall">
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
									
									
									 <th style="width:400px">College</th>
                                    <th style="width:60px">Type</th>
                                    <th style="width:60px">category</th>

									<th style="width:60px">DMLT</th>
									<th style="width:60px">DRD</th>
									<th style="width:60px">DPT</th>
									<th style="width:60px">DRT</th>
									
									<th style="width:60px">D.OPT</th>
									<th style="width:60px">DNEP</th>
                                    <th style="width:60px">DPFT</th>
                                    <th style="width:60px">DCLT</th>
                                    <th style="width:60px">DIALYSIS</th>
                                    <th style="width:60px">DCCT</th>
                                    <th style="width:60px">DOTT</th>
                                    <th style="width:60px">DDCT</th>
                                    <th style="width:60px">ECG</th> 
								</tr>
							</thead>
							
							

                            <tbody id="scrolling_contentall" style="display:block;overflow: auto;height:650px;width: 100%;"></tbody>
								
						</table>
						
						
					</div>
					
							<div class="row">
						<div class="col-md-3">
							<div class="form-group mt-3">
							
								<!-- <a href="#" class="btn btn-primary requestfullscreenall">View Fullscreen</a> -->
							</div>
						</div>
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

<!-- <?php
						foreach($college as $k=>$val){
							?>
	
								<tr id="r_id_<?php echo $k;?>">
									<td style='font-weight: bold;' id="clg_name"><?php echo $val['col_name'];?></td>
									<td style='font-weight: bold;'><?php echo $val['col_type'];?></td>
									<td style='font-weight: bold;'><?php echo $type_arr[$val['cat']];?></td>
									<td  <?php echo $val['DMLT']>0 ? 'style="background-color:#C0C0C0; font-weight: bold;"':'' ?>><?php echo $val['DMLT']?></td>
									<td <?php echo $val['DRD']>0 ? 'style="background-color:#BC8F8F; font-weight: bold;"':'' ?> ><?php echo $val['DRD'];?></td>
									<td <?php echo $val['DPT']>0 ? 'style="background-color:#F4A460; font-weight: bold;"':'' ?> ><?php echo $val['DPT']?></td>
									<td <?php echo $val['DRT']>0 ? 'style="background-color:#C0C0C0; font-weight: bold;"':'' ?> ><?php echo $val['DRT'];?></td>
									<td <?php echo $val['D.OPT']>0 ? 'style="background-color:#87CEEB; font-weight: bold;"':'' ?> ><?php echo $val['D.OPT']?></td>
									<td <?php echo $val['DNEP']>0 ? 'style="background-color:#66CDAA; font-weight: bold;"':'' ?> ><?php echo $val['DNEP'];?></td>
									<td <?php echo $val['DPFT']>0 ? 'style="background-color:#00FF7F; font-weight: bold;"':'' ?> ><?php echo $val['DPFT']?></td>
									<td <?php echo $val['DCLT']>0 ? 'style="background-color:#D2B48C; font-weight: bold;"':'' ?> ><?php echo $val['DCLT'];?></td>
									<td <?php echo $val['DIALYSIS']>0 ? 'style="background-color:#D8BFD8; font-weight: bold;"':'' ?> ><?php echo $val['DIALYSIS']?></td>
									<td <?php echo $val['DCCT']>0 ? 'style="background-color:#40E0D0; font-weight: bold;"':'' ?> ><?php echo $val['DCCT'];?></td>
									<td <?php echo $val['DOTT']>0 ? 'style="background-color:#EE82EE; font-weight: bold;"':'' ?> ><?php echo $val['DOTT']?></td>
									<td <?php echo $val['DDCT']>0 ? 'style="background-color:#FFFF00; font-weight: bold;"':'' ?> ><?php echo $val['DDCT'];?></td>
									<td <?php echo $val['ECG']>0 ? 'style="background-color:#9ACD32; font-weight: bold;"':'' ?> ><?php echo $val['ECG']?></td>
									
								</tr>
								<?php		
							}
							?> -->			


<?php
$this->load->view("common/footer");