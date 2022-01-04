<!--You can modify the loop code here to customise the look of the posts-->

<?php
if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
// Set the number of posts per page
$no_of_records_per_page = 5;
$offset = ($pageno-1) * $no_of_records_per_page;

// Connect to the database
include "db.php";
include "likes.php";


$total_pages_sql = "SELECT COUNT(*) FROM posts";
$result = mysqli_query($conn,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

function createCommentRow($data, $postID) {
    global $conn;

    $response = '
            <div class="somecomms">
                <h5 class="commenter">'.$data['username'].'</h5>
                    <p class="Comment">'.$data['message'].'</p>
                    <p class="timestamp">'.$data['createdOn'].'</p>
            <div style="clear:both;"></div>
            ';

    $response .= '
                        
            </div>
        ';

    return $response;
}

if (isset($_POST['moreComments'])) {
    $postID = $_POST['postid'];
    $response = "";
    $sql = $conn->query("SELECT accounts.username, comments.message, DATE_FORMAT(comments.createdon, '%d %M %Y') AS createdOn FROM comments INNER JOIN accounts ON comments.UserID = accounts.accountid WHERE comments.postid = '$postID' ORDER BY comments.ComntID DESC");
    while($data = $sql->fetch_assoc())
        $response .= createCommentRow($data, $postID);

    exit($response);
}

if (isset($_POST['lessComments'])) {
    $postID = $_POST['postid'];
    exit(0);
}

//Gets the parameter "sort" from the URL and assigns it to a variable
if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
} else {
    $sort = 'newest';
}

if (isset($_GET['category']) and $_GET['category'] !== 'none') {
    $category = "= '" . $_GET['category'] . "'";
} else if (isset($_GET['category']) === 'none') {
    $category = "IS NOT NULL";
}else {
    $category = "IS NOT NULL";
}

//If statements to call the right function based on the parameter gotten from the URL   START
include 'gettheposts.php';
//END
//IN MYPAGINATION SUBSTITUTE START-END WITH INLCUDE GETTHEPOSTS
//Get the username from the creator of a post
function postAuthor ($postID) {
    global $conn;
    $postAuthor = "SELECT accounts.username FROM accounts INNER JOIN posts ON accounts.accountid = posts.accountid WHERE posts.postid = $postID GROUP BY posts.accountid;";
    $result = mysqli_query($conn,$postAuthor);
    $res = mysqli_fetch_assoc($result);
    return $res['username'];
}

$res_data = mysqli_query($conn,$sql);
create_posts($res_data);
function create_posts($data) {
    global $conn;
    /*    Loop to create cards where the posts go to */

    while($post = mysqli_fetch_array($data)){?>

        <div class="post text-center mx-auto">
            <div class="row"></div>
<!--            Responsive post scaling depending on the width-->
            <div class="col-10 col-sm-9 col-md-8 col-lg-6 col-xl-6 col-xxl-6 p-3 mx-auto align-middle mainDiv">
                <div class="card secondDiv">
<!--                    Things that get added before the post text-->
                    <div class="beforepost">
<!--                        Title and topic-->
                        <div class ="card-title fw-bold">Title: <?php echo $post['title']; ?></div>
                        <div class ="card-title fw-bold">Topic: <?php echo $post['topic']; ?></div>
                    </div>
                    <div class="row row-cols-2 justify-content-between">
                        <div class="col-md-4"><?php echo postAuthor($post['postid']); ?></div>
                        <div class="col-md-4"><?php echo date ("d.m.Y", strtotime($post['createdon'])) ?></div>
                    </div>
<!--                    The post text itself-->
                    <div class="card-text-center pt-3 pb-3 someotherDiv">
                        <?php echo $post['post']; ?>
                    </div>
<!--                    Things that get added after the post text-->
                    <div class="afterpost">
                        <div class="mt-3 mb-5">
<!--                        Thumbs up -button -->
                            <i <?php if (userLiked($post['postid'])): ?>
                                class="fa fa-thumbs-up like-btn fa-3x"
                            <?php else: ?>
                                class="fa fa-thumbs-o-up like-btn fa-3x"
                            <?php endif ?>
                                    data-id="<?php echo $post['postid'] ?>"> </i>
                            <span class="likes"><?php echo getLikes($post['postid']); ?></span>

<!--                        Spacer for like buttons-->
                            <span class="px-3 spacing"></span>

<!--                        Thumbs down -button -->
                            <i <?php if (userDisliked($post['postid'])): ?>
                                class="fa fa-thumbs-down dislike-btn fa-3x"
                            <?php else: ?>
                                class="fa fa-thumbs-o-down dislike-btn fa-3x"
                            <?php endif ?>
                                    data-id="<?php echo $post['postid'] ?>"> </i>
                            <span class="dislikes"><?php echo getDislikes($post['postid']); ?></span>
                            
                            
                              <a class="dropdown reportbutton" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="flag-regular.svg" width = "42" height="42">
                              </a>

                              <ul class="dropdown-menu someparentnode" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="reportpost(this)" data-id="<?php echo $post['postid'] ?>">Sexual content</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="reportpost(this)" data-id="<?php echo $post['postid'] ?>">Violent or repulsive content</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="reportpost(this)" data-id="<?php echo $post['postid'] ?>">Hateful or abusive content</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="reportpost(this)" data-id="<?php echo $post['postid'] ?>">Harmful or dangerous acts</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="reportpost(this)" data-id="<?php echo $post['postid'] ?>">Child abuse</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="reportpost(this)" data-id="<?php echo $post['postid'] ?>">Promotes terrorism</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="reportpost(this)" data-id="<?php echo $post['postid'] ?>">Spam or misleading</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="reportpost(this)" data-id="<?php echo $post['postid'] ?>">Infringes my rights</a></li>
                              </ul>

                              <?php
                                if ($_SESSION['role'] == 'admin') {
                                    $postidunique1 = $post['postid'];
                                    $sqlunique1 = $conn->query("SELECT COUNT(reportid) AS reportcount FROM reports WHERE postid = '$postidunique1';");
                                    $resultunique1 = $sqlunique1->fetch_assoc();
                                    $reportcount = $resultunique1['reportcount']; ?>
                                    <p class="somereports">Nr. of reports: <?php echo $reportcount?></p>
                                    
                                    
                                <?php };
                                    ?>

                            
                        </div>

<!--                    Comment part -->
                        <div class="row p-3 justify-content-md-center onemoreDiv">
                            <?php
                            $postID = $post['postid'];
                            $sql = $conn->query("SELECT ComntID FROM comments where postid=$postID;");
                            $nrcomms = $sql->num_rows;
                            ?>
                            <textarea class="form-control commentText" type="text" rows=2 cols=10 id="comment" placeholder="Your comment..." data-id="<?php echo $post['postid'] ?>"></textarea>
                            <!-- <span class="d-grid d-sm-block mt-3 mx-auto"> -->
                            <button class="btn btn-sm commentBtn" data-id="<?php echo $post['postid'] ?>">Submit comment</button>
                            <!-- </span> -->
                            <p class="commentP"><?php echo $nrcomms; ?> Comments</p>
                        </div>
                        <div class="row pb-3 commentsRow" id="<?php echo $post['postid'] ?>">
                            <!-- Comment section -->
                            <button style='display: show;' href='javascript:void(0)' class='moreComms' data-id='<?php echo $postID ?>'>Show Comments</button>
                            <button style='display: none;' href='javascript:void(0)' class='lessComms' data-id='<?php echo $postID ?>'>Close Comments</button>

                        </div>
                        <!-- place for include thedelbutton.php -->

                        <!-- START OF NOT NEEDED IN MYPOSTS.PHP -->
                        <?php include 'thedelbutton.php'; ?>
                        
                        <!-- END -->
                    </div>
                </div>
            </div>
        </div>
    <?php }} ?>

<script type="text/javascript">
    function reportpost(caller) {
        var postid = $(caller).data('id');
        var calleritem = $(caller).text();
        $.ajax({
            url: 'everything.php',
            method: 'POST',
            data: {
                reportposty: 1,
                postid: postid,
                reason: calleritem
            }, success: function(response){
                if (response === 'reported') {
                    alert('Your report has been submitted!');
                } else if (response === 'notloggedin') {
                    alert('Please log in to report a post!');
                    location = 'http://20.54.76.35/~team9/login.php';
                } else {
                    console.log(response);
                }
            }
        });
    }
</script>