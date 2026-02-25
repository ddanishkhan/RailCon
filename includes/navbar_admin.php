<header class="header">
  <nav class="navbar">
    <!-- Search Box-->
    <div class="search-box">
      <button class="dismiss"><i class="icon-close"></i></button>
      <form id="searchForm" action="search.php" name="search_s" method="GET">
        <input type="search" name="query" placeholder="Who are you looking for..." class="form-control">
      </form>
    </div>
    <div class="container-fluid">
      <div class="navbar-holder d-flex align-items-center justify-content-between">
        <!-- Navbar Header-->
        <div class="navbar-header">
          <a href="admin_filter.php" class="navbar-brand d-none d-sm-inline-block">
            <div class="brand-text d-none d-lg-inline-block"><span>RailCon </span><strong>Dashboard</strong></div>
            <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>Railway Concession</strong></div>
          </a>
        </div>
        <!-- Navbar Menu -->
        <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
          <li class="nav-link"><a href="export_to_csv.php"><i class="fa fa-file-text"></i><span class="d-none d-sm-inline">Download</span></a></li>
          <li class="nav-item d-flex align-items-center"><a id="search" href="#"><i class="icon-search"></i></a></li>
          <li class="nav-item"><a href="logout.php" class="nav-link logout"><span class="d-none d-sm-inline">Logout</span><i class="fa fa-sign-out"></i></a></li>
        </ul>
      </div>
    </div>
  </nav>
</header>
