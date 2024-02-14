<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <h3 style="color: white; margin-top: 10px;">E-PHARMACY</h3>
                <!-- <img src="assets/images/logo-sm.png" alt="" height="22"> -->
            </span>
            <span class="logo-lg">
                <h3 style="color: white; margin-top: 10px;">E-PHARMACY</h3>
                <!-- <img src="assets/images/logo-light.png" alt="" height="17"> -->
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <h3 style="color: white; margin-top: 10px;">E-PHARMACY</h3>
                <!-- <img src="assets/images/logo-sm.png" alt="" height="22"> -->
            </span>
            <span class="logo-lg">
                <h3 style="color: white; margin-top: 10px;">E-PHARMACY</h3>
                <!-- <img src="assets/images/logo-light.png" alt="" height="17"> -->
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="dashboard.php" aria-controls="sidebarDashboards">
                        <i class="mdi mdi-speedometer"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                </li> <!-- end Dashboard Menu -->
                <?php if($auth->isAdmin()) { ?>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarUsers" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarUsers">
                        <i class=" ri-team-line"></i> <span>Users</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarUsers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="users.php" class="nav-link"> Users list </a>
                            </li>
                            <li class="nav-item">
                                <a href="connection_history.php" class="nav-link"> Connection history </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <?php } ?>

                <?php if($auth->isAdmin() || $auth->isAgent()) { ?>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarProducts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProducts">
                        <i class="ri-product-hunt-line"></i> <span>Products</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarProducts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="products.php" class="nav-link"> Products list </a>
                            </li>
                            <li class="nav-item">
                                <a href="suppliers.php" class="nav-link"> Suppliers list </a>
                            </li>
                            <li class="nav-item">
                                <a href="warehouses.php" class="nav-link"> Warehouses list </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <?php } ?>

                <?php if($auth->isAdmin() || $auth->isAgent()) { ?>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarStock" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarStock">
                        <i class="ri-stock-line"></i> <span>Stocks</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarStock">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="apps-calendar.html" class="nav-link"> Products list </a>
                            </li>
                            <li class="nav-item">
                                <a href="apps-chat.html" class="nav-link"> Supliers list </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <?php } ?>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="widgets.html">
                        <i class=" ri-shopping-cart-line"></i> <span>Orders</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="widgets.html">
                        <i class="ri-money-dollar-circle-line "></i> <span>accounting</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span>Settings</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="widgets.html">
                        <i class="ri-settings-2-line"></i> <span>Settings</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>