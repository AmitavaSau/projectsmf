<section class="py-3">
	<div class="row mb-4">
		<div class="col-lg-12 mb-4 mb-lg-0">
			<div class="card">
				<div class="card-body">
					<div class="fullscreen-1">
						<h3 class="mt-3 col_name"></h3>
						<table id="seat_available_cat" class="table table-striped table-bordered table-hover">
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
							    <tr>
							        <td style= 'font-weight: bold; text-align: center;' colspan='14'>VACANT SEAT FOR <?php echo $type_arr[$Type] ; ?></td>
 							    </tr>
								<tr>
									<th style="width:35%">College</th>
									<th style="width:7%;text-align: center;">DMLT</th>
									<th style="width:7%;text-align: center;">DRD</th>
									<th style="width:7%;text-align: center;">DPT</th>
									<th style="width:7%;text-align: center;">DRT</th>
									
									<th style="width:7%;text-align: center;">D.OPT</th>
									<th style="width:7%;text-align: center;">DNEP</th>
                                    <th style="width:7%;text-align: center;">DPFT</th>
                                    <th style="width:7%;text-align: center;">DCLT</th>
                                    <th style="width:7%;text-align: center;">DIALYSIS</th>
                                    <th style="width:7%;text-align: center;">DCCT</th>
                                    <th style="width:7%;text-align: center;">DOTT</th>
                                    <th style="width:7%;text-align: center;">DDCT</th>
                                    <th style="width:7%;text-align: center;">ECG</th>
									
								</tr>
							</thead>
							
							

                            <tbody id="scrolling_content1">
						<?php
						foreach($college as $val){
							?>
							<tr>
								<td style='font-weight: bold;'><?php echo $val['col_name'];?></td>
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
						?>
                        
					
                            </tbody>
								
						</table>
						
						
					</div>
					
							<div class="row">
						<div class="col-md-3">
							<div class="form-group mt-3">
							
								<a href="#" class="btn btn-primary requestfullscreen1">View Fullscreen</a>
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

			


<?php
$this->load->view("common/footer");