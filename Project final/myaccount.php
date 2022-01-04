<?php include 'everything.php'?>

<?php $pagetitle = 'My account';
	include 'toplinks.php';
?>

<?php include 'header.php'?>
<div class="container-fluid">

  <main>
    <div class="row">
      <div class="col-md-12 titleCol">
        <h1 class="myaccountTitle">My account</h1>
      </div>
    </div>
    <div class="row accountBody">
      <div class="col-md-1 emptyCol"></div>
      <div class="col-md-4 accountBox1"><img class="profilePic" src="accountImg.png" alt="Profile picture icon."></div>
      <div class="col-md-1 emptyCol"></div>
      <div class="col-md-5 accountBox2">
      	
			<p><h2 class='smallTitles'>Username: <?php 
			echo $_SESSION['username'];
			?></h2></p>
			<p><h2 class='smallTitles'>Joined on: <?php 
			echo $_SESSION['createdon'];
			?></h2></p>
			<?php
				if($_SESSION['role'] == "admin") {
					echo "
						<p><h2 class='smallTitles'>Role: Admin</h2></p>";
				}
			?>
			<button class="delAccbtn1" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Delete Account</button>
			<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		  		<div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title">Are you sure you want to delete your account?</h5>
				        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="cancelbtn1" data-bs-dismiss="modal">Close</button>
				        <button type="button" class="delAccbtn" data-bs-dismiss="modal">Delete Account</button>
				      </div>
				    </div>
			  	</div>
			</div>
		
      </div>
      <div class="col-md-1 emptyCol"></div>
    </div>
  </main>

</div>
<?php include 'footer.php'?>
<?php include 'botlinks.php'?>
	
