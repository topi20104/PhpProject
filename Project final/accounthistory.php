<?php include 'everything.php'?>

<?php $pagetitle = 'Account history';
include 'toplinks.php';
?>

<?php include 'header.php'?>
<?php include 'everything.php'?>
<?php include 'db.php' ?>  
<div id="accountHistoryPage" class="container-fluid">
        <div class="row">
            <div class="col-lg-2"></div>
                    <div class="col-lg-8"> <!-- content -->
                        <h1 id="AccountHistory" class="title">Account history</h1>
                    </div>
            <div class="col-lg-2"></div>
        </div> <!-- end of first row -->
            <div class="row">
                <div class="col-lg-2"></div>
                    <div id="historyContent" class="col-lg-8"> <!-- content -->

                        <!-- Posts, accounts, comments, ratinginfo, reports -->
                        <p id="AccHis">Comments under this in timeline</p>
                        <?php 
                        #Comments --------------------------------------------------------------------------
                        $userid = $_SESSION['accountid'];

                        $comnt = "SELECT
                        postid, message, createdon
                        from
                            comments
                        where
                        userID = $userid
                        order by createdon asc";

                        $sql = $conn->query($comnt);

                        if ($sql->num_rows > 0) {
                            // output data of each row
                            while($row = $sql->fetch_assoc()) {
                              echo "You commented on post: " . $row["postid"]. " - Comment: " . $row["message"]. ". Comment was created on: " . $row["createdon"]. "<br><br>";
                            }
                          } else {
                            echo "You have not commented on anything yet.";
                          }
                        ?>
                        <p id="AccHis">Added jokes</p>
                        <?php
                        #User added joke ----------------------------------------------------------------------------

                        $jokeadded = "SELECT
                        title, post, topic, createdon
                        from
                          posts 
                        where
                        accountid=$userid
                        order by createdon asc";
                        $sql = $conn->query($jokeadded);

                        if ($sql->num_rows > 0) {
                          // output data of each row
                          while($row = $sql->fetch_assoc()) {
                            echo "You added a joke with a title: " . $row["title"]. "  with a content of : " . $row["post"]. ". Topic of the post was: " . $row["topic"]. ". Post was created on: " . $row["createdon"]. "<br><br>";
                          }
                        } else {
                          echo "You haven't added a joke yet.";
                        }
                        ?>
                        <p id="AccHis">Reports user has given out</p>
                        <?php
                        #reports ----------------------------------------------------------------------------
                        $userid = $_SESSION['accountid'];
                        $reports = "SELECT
                        postid, reason, createdon
                        from
                            reports
                        where
                        accountid=$userid
                        order by createdon asc";

                        $sql = $conn->query($reports);

                        if ($sql->num_rows > 0) {
                            // output data of each row
                            while($row = $sql->fetch_assoc()) {
                              echo "you reported : " . $row["reason"]. " on the post: " . $row["postid"]. ". Report was created on: " . $row["createdon"]. "<br><br>";
                            }
                          } else {
                            echo "You have not reported anything yet.";
                          }
                        ?>
                    </div>
                <div class="col-lg-2"></div>
            </div> <!-- end of second row -->      
</div>
<?php include 'botlinks.php'?>
<?php include 'footer.php'?>
	