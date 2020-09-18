<!DOCTYPE html>
<!--<html>
<head>
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
            <h2>Login</h2><br>
        <?php if (validation_errors())
        {?>
        <div class="alert alert-danger">
            <?php echo validation_errors(); ?>
        </div>
        <?php
        } ?>
        <?php echo $this->session->flashdata('pemberitahuan'); ?>
        <form method="post" action="<?php echo base_url()?>login">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" class="form-control" name="username" placeholder="Masukan Username">
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" class="form-control" name="password" placeholder="Masukan Password">
        </div>
        <div class="form-group">
            <input type="submit"  class="btn btn-primary" name="tombol_login" value="Login">
        </div>
        </form>
    </div>
</body>
</html>-->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login SIAP-BSP</title>
    <link href="<?php echo base_url()?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">               
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h1 text-gray-900 mb-4">SIAP BSP</h1>
                                    </div>
                                    <hr>
                                    <?php if (validation_errors()){ ?>
                                    <div class="alert alert-danger">
                                    <?php echo validation_errors(); ?>
                                    </div>
                                    <?php
                                        } 
                                    ?>
                                    <?php echo $this->session->flashdata('pemberitahuan'); ?>
                                    <form class="user" method="post" action="<?php echo base_url()?>login">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Enter Your Username...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Enter Your Password...">
                                        </div>                    
                                        <div class="form-group">
                                        <input type="submit" value="Login" name="tombol_login" class="btn btn-primary btn-user btn-block">
                                        </div>
                                        <hr>                    
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url()?>/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url()?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url()?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?php echo base_url()?>/assets/js/sb-admin-2.min.js"></script>
</body>
</html>
