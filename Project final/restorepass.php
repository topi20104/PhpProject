<?php include 'everything.php'?>

<?php $pagetitle = 'Restore password'; 
    include 'toplinks.php';
?>

<?php include 'header.php'?>
<main>
    <div id="wrap">
        <div id="loginContainer" class="container clear-top">
            <div class="row">
                <div class="col-md-12">
                    <div class="box1">
                        <h1>Restore password</h1>
                        <input id="emailr" type="email" name="" placeholder="Email">
                        <input id="newpass1" type="password" name="" placeholder="New password">
                        <input id="newpass2" type="password" name="" placeholder="Re-type new password">
                        <input id="restorepass" type="submit" name="" value="Restore password">
                        <br>
                        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
                        <p>Have an account? <a href="login.php">Log in</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php'?>
<?php include 'botlinks.php'?>