<?php 
$Accountid = $_SESSION['accountid'];
if ($sort == 'oldest') {
    $sql = "SELECT * FROM posts WHERE accountid = $Accountid AND topic $category ORDER BY createdon asc LIMIT $offset, $no_of_records_per_page";
//Gets the count of likes on a single post
} else if ($sort == 'highest') {
    $sql = "SELECT posts.*, COUNT(ratinginfo.postid) as likes FROM posts LEFT JOIN ratinginfo ON posts.postid = ratinginfo.postid AND posts.accountid = '$Accountid' WHERE topic $category GROUP BY postid ORDER BY likes DESC LIMIT $offset, $no_of_records_per_page";
//Otherwise result to newest posts
} else {
    $sql = "SELECT * FROM posts WHERE accountid = $Accountid AND topic $category ORDER BY createdon desc LIMIT $offset, $no_of_records_per_page";
}
?>