<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/vendor/fontawesome/css/all.min.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/css/style.default.css"
        id="theme-stylesheet">
    <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="<?php echo $this->config->base_url(); ?>assets/img/favicon.png">
    <!-- date picker stylesheet-->
    <link rel="stylesheet"
        href="<?php echo $this->config->base_url(); ?>assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min.css">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <style>
        .website-title {
            font-size: 15px;
            color: #90322A;
            font-weight: bold;
            margin: -72px 29px 23px 90px;
        }

        .website-sub-title {
            font-size: 10px;
            color: #90322A;
            margin: -21px 0px 0px 91px;
        }

        .website-last-title {
            font-size: 10px;
            color: #90322A;
            margin: 2px 0px 0px 91px;
        }

        .topline {
            margin-top: 40px;
            padding: 0px;
            font-weight: 400;
            width: 100%;
            border-bottom: #FFD275 2px solid;
            float: left;
        }

        .pr-lg-5 {
            min-height: 316px;
        }

        #footer {
            clear: both;
            font-size: 10px;
            padding-right: 0px;
            border-top: solid 2px #ffd275;
        }

        .box {
            width: 100%;
            min-height: 100%;
            box-shadow: 0 1px 0px rgba(255, 255, 255, 1);
            margin-bottom: 20px;
        }

        .box .title {
            color: #fff;
            text-align: center;
            font-weight: bold;
            height: auto;
            background: #0189a8eb;
            position: relative;
            border: 1px solid #c4c4c4;
            border-top-left-radius: 2px;
            border-top-right-radius: 2px;
            box-shadow: 0 1px 0px rgba(255, 255, 255, 1);
        }

        .box .content {
            padding: 10px;
            border: solid 1px #FFD275;
            border-bottom-left-radius: 2px;
            border-bottom-right-radius: 2px;
            border-top: none;
            background-color: #fff;
            position: relative;
        }

        .btn-manual {
            border: solid 1px maroon;
            font-weight: 700;
            background: #FEFEFE;
            color: red;
            padding: 5px;
        }

        .btm-button {
            text-align: center;
        }
    </style>
    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body class="login-page">
    <div class="page-holder d-flex align-items-center">
        <div class="container">


            <div class="row align-items-center py-1">
                <div class="col-5 col-lg-4 mx-auto mb-5 mb-lg-0">

                    <div class="pr-lg-5"></div>
                </div>

                <div class="col-lg-4 px-lg-4">
                    <div class="box">

                        <div class="title">
                            <h2>STUDENT LOGIN</h2>
                        </div> <!-- /title -->
                        <div class="content">
                            <?php
                            $form = array(
                                'class'        =>    'mt-4',
                                'role'        =>    'form',
                                'id'         =>     'loginform'
                            );
                            echo form_open('auth/verifyDetails', $form);
                            ?>


                            <div class="form-group ">
                                <label class="control-label">Select Type: </label>
                                <?php
                                $marks = array(
                                    'id'    =>     'marks_type',
                                    'class' =>     'form-control marks_type'
                                );
                                echo form_dropdown('marks_type', $marks_type, null, $marks);
                                ?>
                            </div>


                            <div class="form-group">
                                <label>Registration No</label>
                                <input type="text" class="col-sm-12 col-lg-12" name="username" id="username">
                            </div>
                            <div class="form-group">
                                <label>DOB:</label>
                                <input type="text" id="cand_dob_login" name="cand_dob_login"
                                    class="form-control cand_dob_login datepicker" value="" placeholder='DD-MM-YYYY'
                                    readonly>

                            </div>

                            <div class="form-group">
                                <p id="downloadName"
                                    style="display: none; font-weight: bold; color: #155009; text-align: center;"> </p>

                            </div>

                            <div class="btm-button d-flex justify-content-between">
                                <!-- Left aligned buttons -->
                                <div>
                                    <a href="#" id="downloadBtn1" class="btn btn-info btn-extra-sm"
                                        style="display: none;">Print Marks Statement </a>

                                </div>

                                <!-- Right aligned buttons -->
                                <div>
                                    <button type="button" class="btn btn-warning"
                                        id="student_verifyDetails">Submit</button>
                                </div>
                            </div>
                            <div>
                                <p style="margin-top: 36px; font-size: 13px; color: #a5095a; font-weight:bold">Note:
                                    Fill
                                    the first ' 6 "
                                    digits of the Registration number mentioned on the admit
                                    card<br>

                                    e.g. : 123456/2023/DRT (TECH) COURSE/557</p>
                            </div>


                        </div>
                        </form>


                    </div>

                </div>

                <div class="col-5 col-lg-4 mx-auto mb-5 mb-lg-0">

                </div>

            </div>

        </div>
    </div>

    <!-- JavaScript files-->

    <script src="<?php echo $this->config->base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script
        src="<?php echo $this->config->base_url(); ?>assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js">
    </script>
    <script src="<?php echo $this->config->base_url(); ?>assets/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="<?php echo $this->config->base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="<?php echo $this->config->base_url(); ?>assets/js/front.js"></script> -->


    <script>
        $(document).ready(function() {
            $(".datepicker").datepicker({
                autoclose: true,
                //startDate: date,
                format: "dd-mm-yyyy",
            });
        });

        $('#student_verifyDetails').click(function() {
            var marks_type = $('#marks_type').val();
            var username = $('#username').val();
            var cand_dob_login = $('#cand_dob_login').val();
            $('#downloadBtn1 , #downloadName').hide();

            // Send AJAX request to validate ID and get download URLs for both PDFs
            $.ajax({
                url: 'examMarks/student_verifyDetails',
                method: 'POST',
                data: {
                    marks_type: marks_type,
                    username: username,
                    cand_dob_login: cand_dob_login
                },
                success: function(response) {
                    if (typeof response === 'string') {
                        response = JSON.parse(response);
                    }
                    console.log(response);
                    if (response.valid == true) {
                        if (response.download_url_1 !== null) {
                            $('#downloadBtn1').attr('href', response.download_url)
                                .show();
                            $('#downloadName').html("Name: " + response.name).show();
                        }

                    } else {
                        $('#downloadBtn1 , #downloadName').hide();

                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!"
                        });

                    }
                }
            });
        });

        $('#downloadBtn1').click(function() {
            $('#marks_type').val('');
            $('#username').val('');
            $('#cand_dob_login').val('');
            $('#downloadBtn1 , #downloadName').hide();
        });
    </script>

</body>

</html>