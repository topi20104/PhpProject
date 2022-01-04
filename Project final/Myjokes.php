<?php include 'everything.php';?>
<?php $pagetitle ='Myjokes';
include "./toplinks.php" ?>
<?php include "./header.php" ?>

<div id="mJokes" class="d-flex flex-column min-vh-50 justify-content-center align-items-center">
    <main>
        <div class="row">
            <div class="col-md-12 titleCol">
                <h1>View and add your jokes</h1>
            </div> <!-- end of title -->
        </div>
        <div class="row addAJoke"> <!--add A Joke -->
            <div class="text-center"></div>
                <!-- add a joke section -->
                    <h4 class="text-center">Feel like joking about something? ;)</h4>
                    <button class="subJoke" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Submit a joke here</button>

                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title">Submit your joke</h5>
					        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					      </div>
					      <div class="modal-body">
					    	<input class="jokeTitle" type="text" name="" placeholder="Title"><br>
					    	<select class="form-select jokeTopic" name="">
							    <option class="option" value="none" selected> none </option>
							    <option class="option" value="Family"> Family </option>
							    <option class="option" value="Children"> Children </option>
							    <option class="option" value="Life"> Life </option>
							    <option class="option" value="Media"> Media </option>
							    <option class="option" value="Art"> Art </option>
							    <option class="option" value="History"> History </option>
							    <option class="option" value="DarkHumor"> DarkHumor </option>
							    <option class="option" value="Adults"> Adults </option>
							    <option class="option" value="Forbidden"> Forbidden </option>
							</select> <br>
					    	<textarea class="jokeText" placeholder="Your joke..." rows=5></textarea><br>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="cancelbtn" data-bs-dismiss="modal">Close</button>
					        <button type="button" class="submitbtn" data-bs-dismiss="modal">Submit the joke</button>
					      </div>
					    </div>
					  </div>
					</div> <!-- end of modal fade -->

            </div> <!-- end of adding a joke -->
        </div> <!-- end of add A Joke -->
        <div class="row jokebody"> <!-- start of myJokeBody -->
            <h2 class="text-center">My jokes:</h2>
            <?php include "./myposts.php" ?> 
        </div> <!-- end of jokebody -->
    </main>
</div> <!-- end of container-fluid -->



<?php include 'footer.php'?>
<?php include 'botlinks.php'?>