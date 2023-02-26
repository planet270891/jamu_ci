
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Home - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo site_url("assets/css/bootstrap.min.css");?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo site_url("assets/css/blog-home.css");?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Start Bootstrap</a>
            </div>
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Please Sign In
                    </div>
                    <div class="panel-body">
                        <?php if($this->session->flashdata('message')): ?>
                            <div class="alert alert-danger alert-dismissable">
                               <button type="button" class="close" data-dismiss="alert" 
                                  aria-hidden="true">
                                  &times;
                               </button>
                               Failed ! , <?php echo $this->session->flashdata('message'); ?>
                            </div>
                        <?php EndIf; ?>
                        <p></p>
                        <?php echo form_open("auth/valid",["class"=>""]); ?>
                            <form role="form">
                               <div class="form-group">
                                  <label for="name">Username or Email</label>
                                  <input type="text" class="form-control" id="username" name="username" required/>
                               </div>
                               <div class="form-group">
                                  <label for="name">Password</label>
                                  <input type="password" class="form-control" id="password" name="password" required/>
                               </div>
                               <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </form>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; My Application <?php echo date("Y");?></p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="<?php echo site_url("assets/js/jquery.js");?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo site_url("assets/js/bootstrap.min.js");?>"></script>

</body>

</html>
