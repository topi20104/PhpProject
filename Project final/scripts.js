$(document).ready(function(){
	//listener for signup button
	$("#signupbtn").on('click', function(){
		var username = $("#username").val();
		var email = $("#email").val();
		var password1 = $("#password1").val();
		var password2 = $("#password2").val();

		if (password1 != password2 && password1 != "" && password2 != "") {
			alert('Not the same password!');
		} else if (username != "" && email != "" && password1 != "" && password2 != "" && password1 == password2){
			$.ajax({
				url: 'signup.php',
				method: 'POST',
				dataType: 'text',
				data: {
					registration: 1,
					username: username,
					email: email,
					password: password1
				}, success: function(response){ //could be done with switch statement
					if (response === 'emailTaken'){
						alert('Account already registered on this email address!');
					} else if (response === 'userTaken') {
						alert('Username not available!');
					} else if (response === 'passTooShort'){
						alert('Password too short! (min. 8 characters)');
					} else if (response === 'success') {
						alert('User created!');
						location = './index.php';
					} else if (response === 'emailNotValid') {
						alert('Please type a valid email!');
					} else if (response === 'logedIn'){
						alert('You are already logged in!');
						location = './myaccount.php';
					} else {
						window.location = window.location;

					}
				}
			});

		} else {
			alert('Please check your inputs!');
		}
	});
	//listener for login button
	$("#loginbtnl").on('click', function(){
		var username = $("#usernamel").val();
		var password = $("#passwordl").val();

		if (username != "" && password != ""){
			$.ajax({
				url: 'login.php',
				method: 'POST',
				dataType: 'text',
				data: {
					logging: 1,
					username: username,
					password: password
				}, success: function(response){//could be done with switch statement
					if (response === 'success'){
						location = './index.php';
					} else if (response === 'invalidPass') {
						alert('Incorrect password!');
					} else if (response === 'invalidUser') {
						alert('User does not exist!');
					} else if (response === 'logedIn'){
						alert('You are already logged in!');
						location = './myaccount.php';
					} else {
						window.location = window.location;

					}
				}
			});

		} else {
			alert('Please check your inputs!');
		}
	});

	//listener for delete account button
	$(".delAccbtn").on('click', function(){
		$.ajax({
			url: 'myaccount.php',
			method: 'POST',
			data: {
				delAcc: 1
			}, success: function(response){//could be done with switch statement
				if (response === 'success'){
					alert('User deleted!');
					location = './index.php';
				} else if (response === 'notlogged'){
					alert('You are not logged in!');
					location = './login.php';
				} else {
					alert(response);
				}
			}
		});
	});

	//listener for restore account
	$('#restorepass').on('click', function(){
		var email = $("#emailr").val();
		var newpass1 = $('#newpass1').val();
		var newpass2 = $('#newpass2').val();
		if (newpass1 == newpass2 && newpass1 != "" && newpass2 != "" && email != ""){
			$.ajax({
				url: 'restorepass.php',
				method: 'POST',
				data: {
					restorepass: 1,
					email: email,
					newpass: newpass1
				}, success: function(response){//could be done with switch statement
					if (response === 'success'){
						alert('Password updated!');
						location = 'http://20.54.76.35/~team9/login.php';
					} else if (response === 'noAcc'){
						alert('Account not found! Check email address!');
					} else if (response === 'passTooShort'){
						alert('Password too short! (min. 8 characters)');
					} else if (response === 'invalidMail'){
						alert('Invalid Mail!');
					} else if (response === 'logedIn'){
						alert('You are already logged in!');
						location = './myaccount.php';
					} else {
						window.location = window.location;
					}
				}
			});
		} else if (newpass1 != newpass2 && newpass1 != "" && newpass2 != ""){
			alert('Not the same password!');
		} else {
			alert('Please check your inputs!');
		}
		
	});


	//click like
	$('.like-btn').on('click', function(){
		var postid = $(this).data('id');
		$clicked_btn = $(this);
		if ($clicked_btn.hasClass('fa-thumbs-o-up')) {
			action = 'like';
		} else if ($clicked_btn.hasClass('fa-thumbs-up')){
			action = 'unlike';
		}
		$.ajax({
			url: 'likes.php',
			type: 'post',
			data: {
				'action': action,
				'postid': postid
			},
			success: function(data){
				if (data != 'notloggedin'){
					res = JSON.parse(data);
					if (action == 'like') {
						$clicked_btn.removeClass('fa-thumbs-o-up');
						$clicked_btn.addClass('fa fa-thumbs-up');
					} else if(action == 'unlike') {
						$clicked_btn.removeClass('fa-thumbs-up');
						$clicked_btn.addClass('fa-thumbs-o-up');
					}

					$clicked_btn.siblings('span.likes').text(res.likes);
	  				$clicked_btn.siblings('span.dislikes').text(res.dislikes);

					$clicked_btn.siblings('i.fa-thumbs-down').removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down');
				} else {
					alert('Please log in to interact with posts!');
					location = './login.php';
				}
			}
		});

	});

	//click dislike
	$('.dislike-btn').on('click', function(){
		var postid = $(this).data('id');
		$clicked_btn = $(this);
		if ($clicked_btn.hasClass('fa-thumbs-o-down')) {
			action = 'dislike';
		} else if ($clicked_btn.hasClass('fa-thumbs-down')){
			action = 'undislike';
		}
		$.ajax({
			url: 'likes.php',
			type: 'post',
			data: {
				'action': action,
				'postid': postid
			},
			success: function(data){
				if (data != 'notloggedin'){
					res = JSON.parse(data);
					if (action == 'dislike') {
						$clicked_btn.removeClass('fa-thumbs-o-down');
						$clicked_btn.addClass('fa-thumbs-down');
					} else if(action == 'undislike') {
						$clicked_btn.removeClass('fa-thumbs-down');
						$clicked_btn.addClass('fa-thumbs-o-down');
					}

					$clicked_btn.siblings('span.likes').text(res.likes);
					$clicked_btn.siblings('span.dislikes').text(res.dislikes);

					$clicked_btn.siblings('i.fa-thumbs-up').removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up');
				} else {
					alert('Please log in to interact with posts!');
					location = './login.php';
				}
			}
		});

	});
	//listener for post a comment
	$('.commentBtn').on('click', function(){
		var postid = $(this).data('id');
		$comment = $(this);
		var commentText = $comment.siblings('textarea.commentText').val();
		var commsnrtext = $comment.siblings('p.commentP').text();
		var commsnrarray = commsnrtext.split(" ");
		var commsnr = commsnrarray[0];
		
		if(commentText.length > 0){
			$.ajax({
				url: 'everything.php',
				type: 'POST',
				data: {
					addComment: 1,
					postid: postid,
					comment: commentText
				},success: function(response){
					if (response === 'notloggedin') {
						alert('Please log in to interact with posts!');
						location = './login.php';
					} else {
						commsnr++
						$comment.siblings('p.commentP').text(commsnr + " Comments");
						$comment.siblings('textarea.commentText').val("");
						$comment.blur();
					}
				}

			});
		} else {
			alert('Please check your inputs!');
		}
	});

	
	$('.moreComms').on('click', function(){
		var postid = $(this).data('id');
		$commentsdiv = $('#' + postid);
		$button = $(this);
		
		$.ajax({
			url: 'pagination.php',
			method: 'POST',
			data: { 
				moreComments: 1,
				postid: postid
			}, success: function(response){
				$button.hide();
				if(!$button.siblings('div.somecomms').length){
					$commentsdiv.append(response); //check for sibling div.somecomms if not then append
				} else {
					$button.siblings('div.somecomms').show();
				}
				$button.siblings("button.lessComms").show();
				
			}
			
		});
	});

	$('.lessComms').on('click', function(){
		var postid = $(this).data('id');
		$commentsdiv = $('#' + postid);
		$button = $(this);
		
		$.ajax({
			url: 'pagination.php',
			method: 'POST',
			data: { 
				lessComments: 1,
				postid: postid
			}, success: function(response){
				$button.hide();
				$button.siblings('div.somecomms').hide();
				$button.siblings("button.moreComms").show();
				
			}
			
		});
	});

	$('.submitbtn').on('click', function(){
		var jokeTitle = $('.jokeTitle').val();
		var jokeTopic = $('.jokeTopic').val();
		var jokeText = $('.jokeText').val();

		$.ajax({
			url: 'everything.php',
			method: 'POST',
			data: {
				submitJoke: 1,
				jokeTitle: jokeTitle,
				jokeTopic: jokeTopic,
				jokeText: jokeText
			}, success: function(response){
				if (response === "jokeAdded") {
					alert('Your joke has been added successfully');
					window.location = window.location;
				} else if (response === 'notloggedin') {
					alert('Please log in to submit a joke!');
					location = './login.php';
				} else {
					alert(response);
				}
			}
		})
	});

	$('.delPostbtn1').on('click', function(){
		var postid = $(this).data('id');
		$('.delPostbtn').on('click', function(){
			$.ajax({
				url: 'everything.php',
				method: 'POST',
				data: {
					delUrPost: 1,
					postid: postid
				}, success: function(response) {
					if (response === 'urPostDeleted') {
						alert('Your post has been deleted!');
						window.location = window.location;
					} else {
						alert('Something happened. Please send this message to the developers: ' + response);
					}
				}
			});
		});
	});

	$('.delPostbtn12').on('click', function(){
		var postid = $(this).data('id');
		$('.delPostbtn2').on('click', function(){
			$.ajax({
				url: 'everything.php',
				method: 'POST',
				data: {
					delaPost: 1,
					postid: postid
				}, success: function(response) {
					if (response === 'aPostDeleted') {
						alert('The post has been deleted!');
						window.location = window.location;
					} else {
						alert('Something happened. Please send this message to the developers: ' + response);
					}
				}
			});
		});
	});

	

});