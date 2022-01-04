<?php include 'everything.php'?>

<?php $pagetitle = 'Log in'; 
    include 'toplinks.php';
?>

<?php include 'header.php'?>
<main>
<div id="wrap">
    <div id="loginContainer" class="container clear-top">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <h1>Login</h1>
                        <input id="usernamel" type="text" name="" placeholder="Username">
                        <input id="passwordl" type="password" name="" placeholder="Password">
                        <input id="loginbtnl" type="submit" name="" value="Login">
                    <br>
                    <p>Don't have an account? <a href="signup.php">Sign up</a></p>
                    <p>Forgot your password? <a href="restorepass.php">Restore password</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</main>

<?php include 'footer.php'?>
<?php include 'botlinks.php'?>
