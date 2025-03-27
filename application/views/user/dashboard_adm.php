<section class="py-0">
	<div class="row mb-2">
		<div class="col-xl-3 col-lg-3 mb-4 mb-xl-0">
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
		
	<!--	<div class="col-xl-3 col-lg-3 mb-4 mb-xl-0">
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
		
		<div class="col-xl-3 col-lg-3 mb-4 mb-xl-0">
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
		<div class="col-xl-3 col-lg-3 mb-4 mb-xl-0">
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
		<div class="col-xl-3 col-lg-3 mb-4 mb-xl-0">
			<div class="bg-violet shadow roundy p-4 d-flex align-items-center justify-content-between">
				<div class="flex-grow-1 d-flex align-items-center">
					<div class="dot mr-3 bg-white"></div>
					<div class="text">
						<h6 class="mb-0">GENERAL</h6>
						<span class="">Total - 3189</span><br>
						<span class="">Alloted - <?php  echo $stats->ge_approved; ?></span><br>
						<span class="">Balance - <?php  echo (3189 - $stats->ge_approved); ?></span><br>
						<span class="">Seats Avl- <?php  echo $statsbls->ge_avl; ?></span>
					</div>
				</div>
				<div class="icon text-violet bg-white"><i class="fas fa-user-edit"></i></div>
			</div>
		</div>
		
		<div class="col-xl-3 col-lg-3 mb-4 mb-xl-0">
			<div class="bg-blue shadow roundy p-4 d-flex align-items-center justify-content-between">
				<div class="flex-grow-1 d-flex align-items-center">
					<div class="dot mr-3 bg-white"></div>
					<div class="text">
						<h6 class="mb-0">SC</h6>
						<span class="">Total - 365</span><br>
						<span class="">Alloted - <?php  echo $stats->sc_approved; ?></span><br>
						<span class="">Balance - <?php  echo (365 - $stats->sc_approved); ?></span><br>
						<span class="">Seats Avl- <?php  echo $statsbls->sc_avl; ?></span>
					</div>
				</div>
				<div class="icon text-blue bg-white"><i class="fas fa-user-tie"></i></div>
			</div>
		</div>
		
		<div class="col-xl-3 col-lg-3 mb-4 mb-xl-0">
			<div class="bg-green shadow roundy p-4 d-flex align-items-center justify-content-between">
				<div class="flex-grow-1 d-flex align-items-center">
					<div class="dot mr-3 bg-white"></div>
					<div class="text">
						<h6 class="mb-0">ST</h6>
						<span class="">Total - 172</span><br>
						<span class="">Alloted - <?php  echo $stats->st_approved; ?></span><br>
						<span class="">Balance - <?php  echo (172 - $stats->st_approved); ?></span><br>
						<span class="">Seats Avl- <?php  echo $statsbls->st_avl; ?></span>
					</div>
				</div>
				<div class="icon text-green bg-white"><i class="fas fa-user-minus"></i></div>
			</div>
		</div>
		
		<div class="col-xl-3 col-lg-3 mb-4 mb-xl-0">
			<div class="bg-warning shadow roundy p-4 d-flex align-items-center justify-content-between">
				<div class="flex-grow-1 d-flex align-items-center">
					<div class="dot mr-3 bg-white"></div>
					<div class="text">
						<h6 class="mb-0">PH</h6>
						<span class="">Total - 33</span><br>
						<span class="">Alloted - <?php  echo $stats->pw_approved; ?></span><br>
						<span class="">Balance - <?php  echo (33 - $stats->pw_approved); ?></span><br>
						<span class="">Seats Avl- <?php  echo $statsbls->ph_avl; ?></span>
					</div>
				</div>
				<div class="icon text-green bg-white"><i class="fas fa-user-check"></i></div>
			</div>
		</div>
		
		</div>
		
		<div class="row mb-2">
		
		<div class="col-xl-3 col-lg-3 mb-4 mb-xl-0">
			<div class="bg-violet shadow roundy p-4 d-flex align-items-center justify-content-between">
				<div class="flex-grow-1 d-flex align-items-center">
					<div class="dot mr-3 bg-white"></div>
					<div class="text">
						<h6 class="mb-0">OBC-A</h6>
						<span class="">Total - 155</span><br>
						<span class="">Alloted - <?php  echo $stats->oa_approved; ?></span><br>
						<span class="">Balance - <?php  echo (155 - $stats->oa_approved); ?></span><br>
						<span class="">Seats Avl- <?php  echo $statsbls->oa_avl; ?></span>
					</div>
				</div>
				<div class="icon text-violet bg-white"><i class="fas fa-user-edit"></i></div>
			</div>
		</div>
		
		<div class="col-xl-3 col-lg-3 mb-4 mb-xl-0">
			<div class="bg-blue shadow roundy p-4 d-flex align-items-center justify-content-between">
				<div class="flex-grow-1 d-flex align-items-center">
					<div class="dot mr-3 bg-white"></div>
					<div class="text">
						<h6 class="mb-0">OBC-B</h6>
						<span class="">Total - 109</span><br>
						<span class="">Alloted - <?php  echo $stats->ob_approved; ?></span><br>
						<span class="">Balance - <?php  echo (109 - $stats->ob_approved); ?></span><br>
						<span class="">Seats Avl- <?php  echo $statsbls->ob_avl; ?></span>
					</div>
				</div>
				<div class="icon text-blue bg-white"><i class="fas fa-user-tie"></i></div>
			</div>
		</div>
	</div>
	
	
</section>


<?php
$this->load->view("common/footer");
?>