	    </div>
	    <footer class="footer bg-dark shadow align-self-end py-3 px-xl-5 w-100">
	        <!--<div class="container-fluid">
				<div class="row">
					<div class="col-md-6 text-center text-md-left text-primary">
						<p class="mb-2 mb-md-0">Company &copy; <?php echo date('Y'); ?></p>
					</div>
					<div class="col-md-6 text-center text-md-right text-gray-400">
						<p class="mb-0">Design by <a href="#" class="external text-gray-400"></a></p>
					</div>
				</div>
			</div>-->
	    </footer>
	    </div>

	    </div>

	    <script type="text/javascript">
var BASE_URL = "<?php echo $this->config->base_url(); ?>";
	    </script>

	    <!-- JavaScript files-->
	    <script src="<?php echo $this->config->base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
	    <script src="<?php echo $this->config->base_url(); ?>assets/vendor/popper.js/umd/popper.min.js"></script>
	    <script src="<?php echo $this->config->base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	    <script
	        src="<?php echo $this->config->base_url(); ?>assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js">
	    </script>
	    <script src="<?php echo $this->config->base_url(); ?>assets/vendor/jquery.cookie/jquery.cookie.js"></script>
	    <script src="<?php echo $this->config->base_url(); ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
	    <script src="<?php echo $this->config->base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.js">
	    </script>
	    <script src="<?php echo $this->config->base_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script>
	    <script src="<?php echo $this->config->base_url(); ?>assets/vendor/jspdf/jspdf.min.js"></script>
	    <script src="<?php echo $this->config->base_url(); ?>assets/vendor/jspdf/jspdf.plugin.text-align.js"></script>
	    <script src="<?php echo $this->config->base_url(); ?>assets/vendor/jspdf/jspdf.plugin.autotable.min.js"></script>
	    <script src="<?php echo $this->config->base_url(); ?>assets/js/jquery.fullscreen.min.js"></script>
	    <script src="<?php echo $this->config->base_url(); ?>assets/js/front.js"></script>
	    <?php
		if ($this->router->fetch_class() == 'auth') {
		?>
	    <script src="<?php echo $this->config->base_url(); ?>assets/js/app/auth.min.js"></script>
	    <?php
		} elseif ($this->router->fetch_class() == 'user') {
		?>
	    <script src="<?php echo $this->config->base_url(); ?>assets/js/app/user.min.js"></script>
	    <?php
		} elseif ($this->router->fetch_class() == 'configs') {
		?>
	    <script src="<?php echo $this->config->base_url(); ?>assets/js/app/configs.min.js"></script>
	    <?php
		} elseif ($this->router->fetch_class() == 'counsel') {
		?>
	    <script src="<?php echo $this->config->base_url(); ?>assets/js/app/counsel.min.js"></script>
	    <?php
		} elseif ($this->router->fetch_class() == 'reports') {
		?>
	    <script src="<?php echo $this->config->base_url(); ?>assets/js/app/reports.min.js"></script>
	    <?php
		} elseif ($this->router->fetch_class() == 'admin') {
		?>
	    <script src="<?php echo $this->config->base_url(); ?>assets/js/app/admin.min.js?<?php echo uniqid(); ?>"></script>


	    <?php
		} elseif ($this->router->fetch_class() == 'examMarks') {
		?>
	    <script src="<?php echo $this->config->base_url(); ?>assets/js/app/exammarks.min.js?<?php echo uniqid(); ?>">
	    </script>
	    <?php
		} elseif ($this->router->fetch_class() == 'smfAdmin') {
		?>
	    <script src="<?php echo $this->config->base_url(); ?>assets/js/app/smfadmin.min.js?<?php echo uniqid(); ?>">
	    </script>
	    <?php
		}
		?>

	    </body>

	    </html>