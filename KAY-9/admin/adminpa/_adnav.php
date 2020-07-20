<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../admin/admin-home.php">E-COMMERCE</a>
      
      <?php
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true) {
      echo '<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
      <a class="nav-link" href="#">Welcome '. $_SESSION['username'] .'</a>
      </li>
      </ul>
      <ul class="navbar-nav px-3"">
      
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="../home/demo.php">Visit Website</a>
      </li>
      
</ul>
      <ul class="navbar-nav px-3">
      
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="../admin/logout-admin.php">Logout</a>
        </li>
      </ul>';
      }else{
        echo '
        <ul class="navbar-nav px-3" style="display:flex;flex-direction:row;">
      
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="../home/demo.php">Visit Website</a>
      </li>
    
        <ul class="navbar-nav px-3">
        
          <li class="nav-item text-nowrap">
            <a class="nav-link" href="../admin/login-admin.php">Login</a>
          </li>
        </ul>';
      }
      ?>
    </nav>