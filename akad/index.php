<!DOCTYPE html>
<html class="no-js chrome" lang="en">
<script>

    $(document).ready(function(){
 
        $("#submit1").hover(
            function() {
                $(this).animate({"opacity": "0"}, "slow");
            },
    
            function() {
                $(this).animate({"opacity": "1"}, "slow");
            }
        );
    });
</script>
<style>
    .alert {
      padding: 8px 35px 8px 14px;
      margin-bottom: 20px;
      text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
      background-color: #fcf8e3;
      border: 1px solid #fbeed5;
      -webkit-border-radius: 4px;
      -moz-border-radius: 4px;
      border-radius: 4px;
      color: #c09853;
    }
    .alert h4 {
      margin: 0;
    }
    .alert .close {
      position: relative;
      top: -2px;
      right: -21px;
      line-height: 20px;
    }
    .alert-success {
      background-color: #dff0d8;
      border-color: #d6e9c6;
      color: #468847;
    }
    .alert-danger,
    .alert-error {
      background-color: #f2dede;
      border-color: #eed3d7;
      color: #b94a48;
    }
    .alert-info {
      background-color: #d9edf7;
      border-color: #bce8f1;
      color: #3a87ad;
    }
    .alert-block {
      padding-top: 14px;
      padding-bottom: 14px;
    }
    .alert-block > p,
    .alert-block > ul {
      margin-bottom: 0;
    }
    .alert-block p + p {
      margin-top: 5px;
    }
</style>
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="lh.jpg" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Academic Information System | Login</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap/css/bootstrap-grid.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap/css/bootstrap-reboot.css" rel="stylesheet" />
    <link href="assets/css/colors.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
    <body class="theme-orange" style="overflow: auto;">
    <div class="animated slideInRight auth_v2">
    <div class="auth_v2_box">
        <div class="logo-w">
            <a href="javascript:void(0)"><img alt="" src="lh.jpg" /></a>
        </div>
        <h4 class="auth-header m-0 m-b-20"> 
            Academic Information System 
        </h4>
        <?php
        error_reporting(0);
        if ($_GET['code'] == 1){
        ?>
        <div class="alert alert-danger">
            <center> Username atau Password salah </center>
        </div>
        <?php
        }
        if ($_GET['code'] == 2){
        ?>
        <div class="alert alert-success">
            <center>Anda telah keluar (Logout)</center>
        </div>
        <?php
        }
        ?>
        <form action="cek_login.php" method="post" />
            <div class="form-group">
                <label>Username </label><input class="form-control" name="username" placeholder="Enter your username" type="text" />
                <div class="pre-icon material-icons">account_circle</div>
            </div>
            <div class="form-group">
                <label>Password</label><input class="form-control" name="password" placeholder="Enter your password" type="password" />
                <div class="pre-icon material-icons">fingerprint</div>
            </div>
            <div class="form-check" align="center">
                <label class="form-check-label">

                    <input class="form-check-input" type="checkbox" name="dosen" value="1"  />
                    <span class="form-check-sign" ></span>Dosen
                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                </label>
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="mhs" value="2"  />
                    <span class="form-check-sign"></span>Mahasiswa
                </label>
            </div>
            <center>
            <div class="buttons-w">
                <button class="btn btn-purple" type="submit" >Sign In Now</button>
            </div>
        </center>
        </form>
    </div>
</div>
<div class="auth_bg"></div>
</body>
<!--   Core JS Files   -->
<script src="assets/plugins/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>
<script src="assets/plugins/jquery.backstretch/jquery.backstretch.js" type="text/javascript"></script>
<script>
        $.backstretch("assets/img/bg-login.jpg", {speed: 500}); 
    </script>
<!-- BEGIN PAGE LEVEL JS -->
<script src="assets/js/pvr_lite_login_v1.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->
<!-- PVR Lite DEMO, don't include it in your project! -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script src="assets/js/pvr_lite_demo.js" type="text/javascript"></script>
<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-66289183-8"></script>
</html>
