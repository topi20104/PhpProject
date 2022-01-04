<?php
	include 'db.php';
	include 'everything.php';
	$accountid = $_SESSION['accountid'];

	//click on a button
	if(isset($_POST['action'])) {
		if ($login) {
			$postid = $_POST['postid'];
			$action = $_POST['action'];
			switch ($action) {
				case 'like':
					$sql = "INSERT INTO ratinginfo (accountid, postid, ratingstatus)
					VALUES ($accountid, $postid, 'like')
					ON DUPLICATE KEY UPDATE ratingstatus = 'like'";
					break;
				
				case 'dislike':
					$sql = "INSERT INTO ratinginfo (accountid, postid, ratingstatus)
					VALUES ($accountid, $postid, 'dislike')
					ON DUPLICATE KEY UPDATE ratingstatus = 'dislike'";
					break;
				case 'unlike':
					$sql = "DELETE FROM ratinginfo WHERE accountid = $accountid AND postid = $postid";
					break;
				
				case 'undislike':
					$sql = "DELETE FROM ratinginfo WHERE accountid = $accountid AND postid = $postid";
					break;
				default:
					exit($conn->query($sql));
					break;
			}

			//apply changes to db
			mysqli_query($conn, $sql);
			echo getRating($postid);
			exit(0);
		} else {
			exit('notloggedin');
		}
	}

	// if(isset($_POST['addComment'])){
	// 	$postid = $_POST['postid'];
	// 	$comment = $_POST['comment'];
	// 	//$comment = $conn ->real_escape_string($_POST['comment']);
	// 	$sql = "INSERT INTO comments (postid, accountid, comment) VALUES ('$postid', '$accountid', '$comment')";
	// 	mysqli_query($conn, $sql);
	// 	exit(0);
	// }

	//get likes
	function getLikes($id) {
		global $conn;
		$sql = "SELECT COUNT(*) FROM ratinginfo
		WHERE postid = $id AND ratingstatus='like'";
		$rs = mysqli_query($conn, $sql);
		$result = mysqli_fetch_array($rs);
		return $result[0];
	}

	//get dislikes
	function getDislikes($id) {
		global $conn;
		$sql = "SELECT COUNT(*) FROM ratinginfo
		WHERE postid = $id AND ratingstatus='dislike'";
		$rs = mysqli_query($conn, $sql);
		$result = mysqli_fetch_array($rs);
		return $result[0];
	}

	//get both likes and dislikes
	function getRating($id) {
		$rating = ['likes' => getLikes($id), 'dislikes' => getDislikes($id)];
		return json_encode($rating);
	}

	//check if liked
	function userLiked($post_id){
		global $conn;
		global $accountid;
		$sql = "SELECT * FROM ratinginfo WHERE accountid = $accountid AND postid = $post_id AND ratingstatus = 'like'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			return true;
		}else{
			return false;
		}
	}

	//check if disliked
	function userDisliked($post_id){
		global $conn;
		global $accountid;
		$sql = "SELECT * FROM ratinginfo WHERE accountid = $accountid AND postid = $post_id AND ratingstatus = 'dislike'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			return true;
		}else{
			return false;
		}
	}

	/*$sql = "SELECT * FROM posts LIMIT 4";
	$result = mysqli_query($conn, $sql);
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);*/

?>