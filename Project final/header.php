<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand p-2" href="index.php">
                <img src="Logo.svg" width="70" height="50" alt="">
            </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link" href="aboutus.php">
                About us
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img class="accountimage" src="accountImg.png"></a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <?php
                  if (!$login) {
                    echo '
                      <li><a class="dropdown-item" href="login.php">Login</a></li>
                      <li><a class="dropdown-item" href="signup.php">Sign up</a></li>

                    ';
                  }
                  else {
                    echo '
                      <li><a class="dropdown-item" href="myaccount.php">My account</a></li>
                      <li><a class="dropdown-item" href="Myjokes.php">My jokes</a></li>
                      <li><a class="dropdown-item" href="accounthistory.php">Account history</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="logoutses.php">Log out</a></li>

                    ';
                  }

                ?>

                
                
              </ul>
            </li>
            
          </ul>
          
        </div>
      </div>
    </nav>
  </header>