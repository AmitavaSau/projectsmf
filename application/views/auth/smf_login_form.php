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
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/vendor/fontawesome/css/all.min.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/css/style.default.css"
        id="theme-stylesheet">
    <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="<?php echo $this->config->base_url(); ?>assets/img/favicon.png">

    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body class="login-page">
    <div class="page-holder d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center py-3">
                <div class="col-lg-12 mx-auto mb-5 mb-lg-0">
                    <h1 class="org-name text-primary">College</h1>
                    <h3 class="appl-name"></h3>
                </div>
            </div>
            <div class="row align-items-center py-2">
                <div class="col-5 col-lg-7 mx-auto mb-5 mb-lg-0">
                    <div class="pr-lg-5"><img src="<?php echo $this->config->base_url(); ?>assets/img/illustration.svg"
                            alt="" class="img-fluid"></div>
                </div>
                <div class="col-lg-5 px-lg-4">
                    <h2 class="mb-4">Welcome back!</h2>
                    <p class="text-muted">Authenticate yourself before you proceed.</p>
                    <?php
                    $form = array(
                        'class'        =>    'mt-4',
                        'role'        =>    'form',
                        'id'         =>     'loginform'
                    );
                    echo form_open('smf-login', $form);
                    ?>
                    <div class="form-group mb-4">
                        <input type="text" name="username" placeholder="Username"
                            class="form-control border-0 shadow form-control-lg">
                    </div>
                    <div class="form-group mb-4">
                        <input type="password" name="password" placeholder="Password"
                            class="form-control border-0 shadow form-control-lg text-violet">
                    </div>
                    <button type="submit" class="btn btn-primary shadow px-5 mr-3">Log in</button>
                    <!--<a href="<?php echo $this->config->base_url(); ?>forgot-password">Forgot password?</a>-->
                    </form>
                </div>
            </div>
            <p class="mt-5 mb-0 text-gray-400 text-center">Design by <a href="#"
                    class="external text-gray-400">MAKAUT</a></p>
        </div>
    </div>
    <!-- JavaScript files-->
    <script src="<?php echo $this->config->base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo $this->config->base_url(); ?>assets/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="<?php echo $this->config->base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo $this->config->base_url(); ?>assets/js/front.js"></script>
</body>

</html>