<div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="../admin/admin-home.php">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <?php
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true) {
              echo '<li class="nav-item">
              <a class="nav-link" href="../admin/admin-categories.php">
                <span data-feather="layers"></span>
                Categories
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../admin/admin-brand.php">
                <span data-feather="layers"></span>
                Brands
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../admin/admin-product.php">
                  <span data-feather="shopping-cart"></span>
                  Products
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../admin/admin-order.php">
                  <span data-feather="file"></span>
                  Orders
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../admin/admin-customer.php">
                  <span data-feather="users"></span>
                  Customers
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../admin/admin-contact.php">
                  <span data-feather="bar-chart-2"></span>
                  Contact Us
                </a>
              </li>
              
              
              
              
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Saved reports</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="../admin/addcat.php">
                  <span data-feather="file-text"></span>
                  Add Categories
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../admin/addbrand.php">
                  <span data-feather="file-text"></span>
                  Add Brand
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../admin/addproduct.php">
                  <span data-feather="file-text"></span>
                  Add Products
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Social engagement
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Year-end sale
                </a>
              </li>';}else{
                  echo '<li class="nav-item">
                  <a class="nav-link" href="../admin/login-admin.php">
                  <span data-feather="users"></span>
                    login to see additional admin options
                  </a>
                </li>';}
   ?>
            </ul>
          </div>
        </nav>

        </div>
    </div>