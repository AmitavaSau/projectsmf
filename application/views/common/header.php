<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $page_title . " | " . $this->config->item('application_name'); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="<?php echo $this->config->base_url(); ?>assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/vendor/fontawesome/css/all.min.css">
    <!-- Datatable CSS-->
    <link rel="stylesheet"
        href="<?php echo $this->config->base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.css">
    <!-- SweetAlert stylesheet-->
    <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/vendor/sweetalert/sweetalert.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/css/style.default.css">
    <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="<?php echo $this->config->base_url(); ?>assets/img/favicon.png">
    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>


    <!-- top navigation -->
    <!-- navbar-->
    <header class="header">
        <nav class="navbar navbar-expand-lg fixed-top px-4 py-0 bg-blue-500 shadow">
            <ul class="list-unstyled horizontal-nav mb-0">
                <li id="dashboard" class="nav-item ml-auto">
                    <a href="<?php echo $this->config->base_url(); ?>dashboard"
                        class="nav-link btn btn-warning btn-extra-sm">
                        Home
                    </a>
                </li>

                <?php
                if ($_SESSION['AX_username'] != 'admin') {
                ?>

                <?php
                    if ($_SESSION['AX_role_id'] == 9) {
                    ?>

                <li id="report" class="nav-item dropdown ml-auto">
                    <a href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        class="nav-link dropdown-toggle">
                        <i class="fas fa-graduation-cap ml-0 text-white"></i>
                    </a>

                    <div aria-labelledby="report" class="dropdown-menu left">
                        <a href="<?php echo $this->config->base_url(); ?>smfAdmin/final_award_sheet_report"
                            class="dropdown-item">Final Award Sheet Report</a>


                    </div>

                </li>

                <?php
                    } else if ($_SESSION['AX_role_id'] == 10) {
                    ?>

                <li id="report" class="nav-item dropdown ml-auto">
                    <a href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        class="nav-link dropdown-toggle">
                        <i class="fas fa-graduation-cap ml-0 text-white"></i>
                    </a>

                    <div aria-labelledby="report" class="dropdown-menu left">
                        <a href="<?php echo $this->config->base_url(); ?>examMarks/marks_entry_preliminary?inst_code=&course_name=&cand_paper=&cand_paper_seg="
                            class="dropdown-item">Marks Entry for Preliminary</a>
                        <a href="<?php echo $this->config->base_url(); ?>examMarks/marks_entry_final?inst_code=&course_name=&cand_paper=&cand_paper_seg="
                            class="dropdown-item">Marks Entry for Final</a>
                    </div>

                </li>

                <?php
                    }
                } else if ($_SESSION['AX_username'] == 'admin') {
                    ?>

                <li id="report" class="nav-item dropdown ml-auto">
                    <a href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        class="nav-link dropdown-toggle">
                        <i class="fas fa-graduation-cap ml-0 text-white"></i>
                    </a>

                    <div aria-labelledby="report" class="dropdown-menu left">
                        <a href="<?php echo $this->config->base_url(); ?>admin/download_statement_preliminary"
                            class="dropdown-item">Marks Statement Preliminary</a>
                        <a href="<?php echo $this->config->base_url(); ?>admin/download_statement_final"
                            class="dropdown-item">Marks Statement Final</a>

                        <a href="<?php echo $this->config->base_url(); ?>admin/download_student_marks_preliminary"
                            class="dropdown-item">Student Marks Preliminary</a>
                        <a href="<?php echo $this->config->base_url(); ?>admin/download_student_marks_final"
                            class="dropdown-item">Student Marks Final</a>
                    </div>

                </li>

                <li id="report" class="nav-item dropdown ml-auto">
                    <a href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        class="nav-link dropdown-toggle">
                        <i class="fas fa-file-alt ml-0 text-white"></i>
                    </a>

                    <div aria-labelledby="report" class="dropdown-menu left">
                        <a href="<?php echo $this->config->base_url(); ?>examMarks/examSchedule_preliminary"
                            class="dropdown-item">Exam Schedule for Preliminary</a>
                        <!-- <a href="<?php echo $this->config->base_url(); ?>examMarks/examSchedule_final"
                            class="dropdown-item">Exam Schedule for Final</a> -->
                    </div>

                </li>

                <!-- <li id="report" class="nav-item dropdown ml-auto">
                    <a href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        class="nav-link dropdown-toggle">
                        <i class="fas fa-cogs ml-0 text-white"></i>
                    </a>

                    <div aria-labelledby="report" class="dropdown-menu left">
                        <a href="<?php echo $this->config->base_url(); ?>admin/change_college_password"
                            class="dropdown-item">Change College Password</a>

                    </div>
                </li> -->

                <?php
                }
                ?>

                <li id="logout" class="nav-item ml-auto">
                    <a href="<?php echo $this->config->base_url(); ?>logout"
                        class="nav-link btn btn-danger btn-extra-sm">
                        Logout
                    </a>
                </li>

            </ul>

            <h1 class="navbar-brand font-weight-bold text-uppercase ">
                <span><?php echo $_SESSION['config_texts']['app_name']; ?></span>
            </h1>

            <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">
                <li class="nav-item dropdown ml-auto">
                    <a id="userInfo" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" class="nav-link dropdown-toggle">
                        <img src="<?php echo getFileLocation('user-profile') . '/' . $_SESSION['AX_user_photo']; ?>"
                            alt="<?php echo $_SESSION['AX_username']; ?>" style="max-width: 2.5rem;"
                            class="img-fluid rounded-circle shadow">
                    </a>

                    <div aria-labelledby="userInfo" class="dropdown-menu">
                        <a href="#" class="dropdown-item">
                            <strong
                                class="d-block text-uppercase headings-font-family"><?php echo $_SESSION['AX_user_firstname']; ?>
                                <?php echo $_SESSION['AX_user_midname']; ?>
                                <?php echo $_SESSION['AX_user_lastname']; ?></strong>
                        </a>
                        <div class="dropdown-divider"></div>
                        <!-- <a href="<?php echo $this->config->base_url(); ?>change-password" class="dropdown-item">Change Password</a>
					<a href="<?php echo $this->config->base_url() . 'activity-log/' . $_SESSION['AX_username']; ?>" class="dropdown-item">Activity log</a>
					 -->
                        <div class="dropdown-divider"></div>
                        <a href="<?php echo $this->config->base_url(); ?>logout" class="dropdown-item">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>





    <!-- page content -->
    <div class="d-flex align-items-stretch m-t-60">

        <div class="page-holder w-100 d-flex flex-wrap">
            <div class="container-fluid px-xl-5">
                <h1 class="page-header text-white py-1"><?php echo $page_title; ?></h1>