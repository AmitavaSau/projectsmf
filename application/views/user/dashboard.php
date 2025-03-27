<?php
if ($_SESSION['AX_username'] == 'admin') {
?>
<section class="py-0">
    <div class="row mb-2">
        <div class="col-xl-3 col-lg-3 mb-4 mb-xl-0">
            <div class="bg-violet shadow roundy p-4 d-flex align-items-center justify-content-between">
                <div class="flex-grow-1 d-flex align-items-center">
                    <div class="dot mr-3 bg-white"></div>
                    <div class="text">
                        <h6 class="mb-0">Total Download [FINAL]</h6>
                        <span class=""><?php echo $stats_marks['std_download_status_final']; ?></span>
                    </div>
                </div>
                <div class="icon text-violet bg-white"><i class="fas fa-user-edit"></i></div>
            </div>
        </div>


        <div class="col-xl-3 col-lg-3 mb-4 mb-xl-0">
            <div class="bg-green shadow roundy p-4 d-flex align-items-center justify-content-between">
                <div class="flex-grow-1 d-flex align-items-center">
                    <div class="dot mr-3 bg-white"></div>
                    <div class="text">
                        <h6 class="mb-0">Total Download [PRELIMINARY]</h6>
                        <span class=""><?php echo $stats_marks['std_download_status_pre']; ?></span>
                    </div>
                </div>
                <div class="icon text-green bg-white"><i class="fas fa-user-check"></i></div>
            </div>
        </div>

        <!--<div class="col-xl-3 col-lg-3 mb-4 mb-xl-0">
			<div class="bg-blue shadow roundy p-4 d-flex align-items-center justify-content-between">
				<div class="flex-grow-1 d-flex align-items-center">
					<div class="dot mr-3 bg-white"></div>
					<div class="text">
						<h6 class="mb-0">Total Not Reported</h6>
						<span class=""><?php echo $stats_clg->total_clg_notreport; ?></span>
					</div>
				</div>
				<div class="icon text-blue bg-white"><i class="fas fa-user-tie"></i></div>
			</div>
		</div>
		
		<div class="col-xl-3 col-lg-3 mb-4 mb-xl-0">
			<div class="bg-warning shadow roundy p-4 d-flex align-items-center justify-content-between">
				<div class="flex-grow-1 d-flex align-items-center">
					<div class="dot mr-3 bg-white"></div>
					<div class="text">
						<h6 class="mb-0">Requested For Refund</h6>
						<span class=""><?php echo $stats_clg->total_ref_req; ?></span>
					</div>
				</div>
				<div class="icon text-blue bg-white"><i class="fas fa-user-tie"></i></div>
			</div>
		</div>-->

    </div>


</section>



<?php
}
if ($_SESSION['AX_role_id'] == 9) {

?>

<style>
/* Container styling */
.button-container {
    text-align: center;
    /* Center align the buttons */
    margin: 20px auto;
    /* Add spacing around the buttons */
}

/* General button styling */
.btn-extra-sm1 {
    display: inline-block;
    padding: 12px 20px;
    /* Adjust padding for size */
    font-size: 14px;
    /* Adjust font size */
    font-weight: bold;
    /* Make text bold */
    text-decoration: none;
    /* Remove underline for links */
    color: #fff;
    /* Set text color to white */
    border-radius: 8px;
    /* Add rounded corners */
    transition: background-color 0.3s, transform 0.2s;
    /* Add hover effects */
}

/* Preliminary button styling */
.btn-secondary {
    background-color: #085d86;
    /* Change to a custom blue */
    border: none;
}

.btn-secondary:hover {
    background-color: #0056b3;
    /* Darker blue on hover */
    transform: scale(1.05);
    /* Slightly enlarge on hover */
}

/* Final button styling */
.btn-success {
    background-color: #28a745;
    /* Change to a custom green */
    border: none;
}

.btn-success:hover {
    background-color: #1e7e34;
    /* Darker green on hover */
    transform: scale(1.05);
    /* Slightly enlarge on hover */
}
</style>

<section class="py-0">
    <div class="button-container">

        <a href="<?php echo $this->config->base_url(); ?>smfAdmin/final_award_sheet?inst_code=&course_name="
            class="btn btn-secondary btn-extra-sm1">Final Award Sheet</a>
        <a href="<?php echo $this->config->base_url(); ?>smfAdmin/data_viewing_final"
            class="btn btn-success btn-extra-sm1">Data Viewing FINAL</a>

        <a href="<?php echo $this->config->base_url(); ?>smfAdmin/data_viewing_dfharma"
            class="btn btn-warning btn-extra-sm1">Data Viewing D PHARMA</a>

        <a href="<?php echo $this->config->base_url(); ?>logout" class="btn btn-danger btn-extra-sm1">Logout</a>



    </div>
</section>

<?php
}
if ($_SESSION['AX_role_id'] == 10) {

?>

<style>
/* Container styling */
.button-container {
    text-align: center;
    /* Center align the buttons */
    margin: 20px auto;
    /* Add spacing around the buttons */
}

/* General button styling */
.btn-extra-sm1 {
    display: inline-block;
    padding: 12px 20px;
    /* Adjust padding for size */
    font-size: 14px;
    /* Adjust font size */
    font-weight: bold;
    /* Make text bold */
    text-decoration: none;
    /* Remove underline for links */
    color: #fff;
    /* Set text color to white */
    border-radius: 8px;
    /* Add rounded corners */
    transition: background-color 0.3s, transform 0.2s;
    /* Add hover effects */
}

/* Preliminary button styling */
.btn-secondary {
    background-color: #085d86;
    /* Change to a custom blue */
    border: none;
}

.btn-secondary:hover {
    background-color: #0056b3;
    /* Darker blue on hover */
    transform: scale(1.05);
    /* Slightly enlarge on hover */
}

/* Final button styling */
.btn-success {
    background-color: #28a745;
    /* Change to a custom green */
    border: none;
}

.btn-success:hover {
    background-color: #1e7e34;
    /* Darker green on hover */
    transform: scale(1.05);
    /* Slightly enlarge on hover */
}
</style>

<section class="py-0">
    <div class="button-container">

        <a href="<?php echo $this->config->base_url(); ?>examMarks/marks_entry_preliminary?inst_code=&course_name=&cand_paper=&cand_paper_seg="
            class="btn btn-secondary btn-extra-sm1">Marks Entry for Preliminary</a>
        <a href="<?php echo $this->config->base_url(); ?>examMarks/marks_entry_final?inst_code=&course_name=&cand_paper=&cand_paper_seg="
            class="btn btn-success btn-extra-sm1">Marks Entry for Final</a>

        <a href="<?php echo $this->config->base_url(); ?>examMarks/institute_details"
            class="btn btn-warning btn-extra-sm1">Centre-in-charge Details</a>

        <a href="<?php echo $this->config->base_url(); ?>examMarks/exam_question_paper_preliminary"
            class="btn btn-info btn-extra-sm1" style="background-color: #1d145f;">Download QP</a>

        <a href="<?php echo $this->config->base_url(); ?>logout" class="btn btn-danger btn-extra-sm1">Logout</a>



    </div>

</section>

<?php } ?>


<?php
$this->load->view("common/footer");
?>