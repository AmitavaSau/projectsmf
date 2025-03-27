<section class="py-0">
	<div class="row mb-2">
		<div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
			<div class="bg-violet shadow roundy p-4 d-flex align-items-center justify-content-between">
				<div class="flex-grow-1 d-flex align-items-center">
					<div class="dot mr-3 bg-white"></div>
					<div class="text">
						<h6 class="mb-0">Registered</h6>
						<span class=""><?php echo $stats->total_registered;?></span>
					</div>
				</div>
				<div class="icon text-violet bg-white"><i class="fas fa-user-edit"></i></div>
			</div>
		</div>
		
	<!--	<div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
			<div class="bg-blue shadow roundy p-4 d-flex align-items-center justify-content-between">
				<div class="flex-grow-1 d-flex align-items-center">
					<div class="dot mr-3 bg-white"></div>
					<div class="text">
						<h6 class="mb-0">Appeared</h6>
						<span class=""><?php //echo $stats->total_appeared;?></span>
					</div>
				</div>
				<div class="icon text-blue bg-white"><i class="fas fa-user-tie"></i></div>
			</div>
		</div>
		
		<div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
			<div class="bg-red shadow roundy p-4 d-flex align-items-center justify-content-between">
				<div class="flex-grow-1 d-flex align-items-center">
					<div class="dot mr-3 bg-white"></div>
					<div class="text">
						<h6 class="mb-0">Withdraw</h6>
						<span class=""><?php //echo $stats->total_rejected;?></span>
					</div>
				</div>
				<div class="icon text-red bg-white"><i class="fas fa-user-minus"></i></div>
			</div>
		</div>
	-->	
		<div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
			<div class="bg-green shadow roundy p-4 d-flex align-items-center justify-content-between">
				<div class="flex-grow-1 d-flex align-items-center">
					<div class="dot mr-3 bg-white"></div>
					<div class="text">
						<h6 class="mb-0">Alloted</h6>
						<span class=""><?php echo $stats->total_approved;?></span>
					</div>
				</div>
				<div class="icon text-green bg-white"><i class="fas fa-user-check"></i></div>
			</div>
		</div>
	</div>
	
	<div class="row mb-2">
		<div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
			<div class="bg-violet shadow roundy p-4 d-flex align-items-center justify-content-between">
				<div class="flex-grow-1 d-flex align-items-center">
					<div class="dot mr-3 bg-white"></div>
					<div class="text">
						<h6 class="mb-0">GENERAL</h6>
						<span class="">Total - 3189</span><br>
						<span class="">Alloted - <?php  echo $stats->ge_approved; ?></span><br>
						<span class="">Balance - <?php  echo (3189 - $stats->ge_approved); ?></span>
					</div>
				</div>
				<div class="icon text-violet bg-white"><i class="fas fa-user-edit"></i></div>
			</div>
		</div>
		
		<div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
			<div class="bg-blue shadow roundy p-4 d-flex align-items-center justify-content-between">
				<div class="flex-grow-1 d-flex align-items-center">
					<div class="dot mr-3 bg-white"></div>
					<div class="text">
						<h6 class="mb-0">SC</h6>
						<span class="">Total - 365</span><br>
						<span class="">Alloted - <?php  echo $stats->sc_approved; ?></span><br>
						<span class="">Balance - <?php  echo (365 - $stats->sc_approved); ?></span>
					</div>
				</div>
				<div class="icon text-blue bg-white"><i class="fas fa-user-tie"></i></div>
			</div>
		</div>
		
		<div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
			<div class="bg-green shadow roundy p-4 d-flex align-items-center justify-content-between">
				<div class="flex-grow-1 d-flex align-items-center">
					<div class="dot mr-3 bg-white"></div>
					<div class="text">
						<h6 class="mb-0">ST</h6>
						<span class="">Total - 172</span><br>
						<span class="">Alloted - <?php  echo $stats->st_approved; ?></span><br>
						<span class="">Balance - <?php  echo (172 - $stats->st_approved); ?></span>
					</div>
				</div>
				<div class="icon text-green bg-white"><i class="fas fa-user-minus"></i></div>
			</div>
		</div>
		
		<div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
			<div class="bg-warning shadow roundy p-4 d-flex align-items-center justify-content-between">
				<div class="flex-grow-1 d-flex align-items-center">
					<div class="dot mr-3 bg-white"></div>
					<div class="text">
						<h6 class="mb-0">PH</h6>
						<span class="">Total - 33</span><br>
						<span class="">Alloted - <?php  echo $stats->pw_approved; ?></span><br>
						<span class="">Balance - <?php  echo (33 - $stats->pw_approved); ?></span>
					</div>
				</div>
				<div class="icon text-green bg-white"><i class="fas fa-user-check"></i></div>
			</div>
		</div>
		
		</div>
		
		<div class="row mb-2">
		
		<div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
			<div class="bg-violet shadow roundy p-4 d-flex align-items-center justify-content-between">
				<div class="flex-grow-1 d-flex align-items-center">
					<div class="dot mr-3 bg-white"></div>
					<div class="text">
						<h6 class="mb-0">OBC-A</h6>
						<span class="">Total - 155</span><br>
						<span class="">Alloted - <?php  echo $stats->oa_approved; ?></span><br>
						<span class="">Balance - <?php  echo (155 - $stats->oa_approved); ?></span>
					</div>
				</div>
				<div class="icon text-violet bg-white"><i class="fas fa-user-edit"></i></div>
			</div>
		</div>
		
		<div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
			<div class="bg-blue shadow roundy p-4 d-flex align-items-center justify-content-between">
				<div class="flex-grow-1 d-flex align-items-center">
					<div class="dot mr-3 bg-white"></div>
					<div class="text">
						<h6 class="mb-0">OBC-B</h6>
						<span class="">Total - 109</span><br>
						<span class="">Alloted - <?php  echo $stats->ob_approved; ?></span><br>
						<span class="">Balance - <?php  echo (109 - $stats->ob_approved); ?></span>
					</div>
				</div>
				<div class="icon text-blue bg-white"><i class="fas fa-user-tie"></i></div>
			</div>
		</div>
	</div>
	
	
</section>

<section style="display:none">
	<div class="row mb-4">
		<div class="col-lg-12 mb-4 mb-lg-0">
			<div class="card">
				<div class="card-header">
					<h2 class="h6 text-uppercase mb-0">Your Last 20 Activities</h2>
				</div>
				<div class="card-body">
					<p class="text-gray">
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
								foreach($last_activities as $val){
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
					</p>
				</div>
			</div>
		</div>
	</div>
		
</section>

<?php
$this->load->view("common/footer");
?>