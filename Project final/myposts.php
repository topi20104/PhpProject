<div class="posts">
    <div class="row justify-content-md-center pt-3">
        <div class="col-sm-2 somecol">
            <label class="visually-hidden">Sort by</label>
            <select class="form-select onemoreselection" id="sort-by">
                <option value="newest" selected>New</option>
                <option value="oldest">Oldest</option>
                <option value="highest">Highest rated</option>
            </select>
        </div>
        <div class="col-sm-2 somecol">
            <label class="visually-hidden">Categories</label>
            <select class="form-select oneselection1" id="categories">
                <option value="none" selected>None</option>
                <option value="family">Family</option>
                <option value="children">Children</option>
                <option value="life">Life</option>
                <option value="media">Media</option>
                <option value="art">Art</option>
                <option value="history">History</option>
                <option value="darkHumor">Dark Humor</option>
                <option value="adults">Adults</option>
                <option value="forbidden">Forbidden</option>
            </select>
        </div>
    </div>

    <!--includes the loop code for displaying the posts-->
    <div class="container-xl">
    <?php include "mypagination.php"; ?> <!-- replace this with include mypagination.php in myposts.php-->
    </div>
</div>
<!--Page navigation buttons-->
<nav aria-label="Post pages">
    <ul  class="pagination justify-content-center">
<!--        Button to the first page-->
        <li class="page-item">
            <a class="page-link someli" id="firstPage" href="#">First</a></li>
        <!--        Button to one page backwards-->
        <li class="page-item<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a class="page-link someli" id="prevPage" href="#">Prev</a>
        </li>
        <!--        Button to one page forwards-->
        <li class="page-item<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a class="page-link someli" id="nextPage" href="#">Next</a>
        </li>
        <!--        Button to the last page-->
        <li class="page-item">
            <a class="page-link someli" id="lastPage" href="#">Last</a></li>
    </ul>
</nav>
<script>
//    Const for the current URL
    const query = new URLSearchParams(window.location.search);
    //Variable for the selection element
    const parameters = document.getElementById("sort-by");
    //Event listener for the selection element, when you change the value for it
    //Sets the URL parameters to the query in the form '?sort=$value'
    parameters.addEventListener("change", function() {
        query.set("sort", parameters.value);
        setParameters();

    })
</script>
<script>
    //Variable for the selection element
    const categories = document.getElementById("categories");
        //Event listener for the category selection element, when you change the value for it
        categories.addEventListener("change", function() {
            query.set("category",categories.value);
            setParameters();
    })
</script>
<script>
    //Functions to execute when event listener is activated
    //Same concept as in the sorting

    //Get the current page number from a PHP variable
    page = <?php echo $pageno; ?>;
    //Total pages variables as a failsafe if trying to go further than intended
    total_pages = <?php echo $total_pages; ?>;

    //Function to get to the first page
    const firstPage = document.getElementById("firstPage");
    firstPage.addEventListener("click", function() {
        query.set("pageno",1);
        setParameters();
    })

    //Function to get to the previous page
    const prevPage = document.getElementById("prevPage");
    prevPage.addEventListener("click", function() {
        if (page > 1) {
            query.set("pageno", page - 1);
            setParameters();
        }
    })

    //Function to get to the next page
    const nextPage = document.getElementById("nextPage");
    if (page < total_pages) {
        nextPage.addEventListener("click", function () {
            query.set("pageno", page + 1);
            setParameters();
        })
    }

    //Function to get to the last page
    const lastPage = document.getElementById("lastPage");
    lastPage.addEventListener("click", function() {
        query.set("pageno",total_pages);
        setParameters();
    })

    //Function to set the parameters to the URL // To optimise the code in the event listener functions
    function setParameters() {
        //Converts the parameters to a string value that can be used
        query.toString();
        //Sets the parameters to the URL and reloads
        window.location.search = query;
    }

</script>
<script>
//    A script to set the value to the current sorting value, otherwise won't be able to select newest
if ("<?php echo $_GET['sort'];?>" === "newest") {
    parameters.selectedIndex = 0;
}
else if ("<?php echo $_GET['sort'];?>" === "oldest") {
    parameters.selectedIndex = 1;
}
else if ("<?php echo $_GET['sort'];?>" === "highest") {
    parameters.selectedIndex = 2;
}

//Same one for the category
switch ("<?php echo $_GET['category'];?>") {
    case "none":
        categories.selectedIndex = 0;
        break;
    case "family":
        categories.selectedIndex = 1;
        break;
    case "children":
        categories.selectedIndex = 2;
        break;
    case "life":
        categories.selectedIndex = 3;
        break;
    case "media":
        categories.selectedIndex = 4;
        break;
    case "art":
        categories.selectedIndex = 5;
        break;
    case "history":
        categories.selectedIndex = 6;
        break;
    case "darkHumor":
        categories.selectedIndex = 7;
        break;
    case "adults":
        categories.selectedIndex = 8;
        break;
    case "forbidden":
        categories.selectedIndex = 9;
        break;
}
</script>