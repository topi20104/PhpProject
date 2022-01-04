<?php include 'everything.php'?>

<?php $pagetitle = "Sign up";
include 'toplinks.php';?>

<?php include 'header.php'?>
<main>
<div id="wrap">
    <div id="loginContainer" class="container clear-top">
        <div id="sign" class="row">
            
                <div class="col-md-12">
                    <div class="box">
                    <h1>Sign-up</h1>
                        <input id="username" type="text" name="" placeholder="Username">
                        <input id="email" type="email" name="" placeholder="E-mail">
                        <input id="password1" type="password" name="" placeholder="Password">
                        <input id="password2" type="password" name="" placeholder="Re-type Password">
                        <input id="signupbtn" type="submit" name="" value="Sign-up">
                    <br>
                    <p>Already have an account? <a href="login.php">Log in</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
<?php include 'footer.php'?>
<?php include 'botlinks.php'?>

