<?php
require_once("./controllers/OrderController.php");
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Warehouse List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Sweet Alert css-->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php include("partials/header-app.php"); ?>

        <?php include("partials/sidebar-app.php"); ?>

        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- removeNotificationModal -->
        <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-2 text-center">
                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                            <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                <h4>Are you sure ?</h4>
                                <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                        </div>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                	<!-- start page title -->
					<div class="row">
					    <div class="col-12">
					        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
					            <h4 class="mb-sm-0">New Order</h4>

					            <div class="page-title-right">
					                <ol class="breadcrumb m-0">
					                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
					                    <li class="breadcrumb-item active">New Order</li>
					                </ol>
					            </div>

					        </div>
					    </div>
					</div>
					<!-- end page title -->

                    <div class="row">
                        <div class="col-md-12">
                            <?php if($error != "") { ?>
                                <div class="col-lg-12">
                                    <div class="alert alert-danger alert-borderless shadow mb-xl-0" role="alert">
                                        <?php echo $error; ?>
                                    </div>
                                    <br>
                                </div>
                            <?php } else if($success != "") { ?>
                                <div class="col-lg-12" style="color: green;">
                                    <div class="alert alert-success alert-borderless shadow" role="alert">
                                        <?php echo $success; ?>
                                    </div>
                                     <br>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <?php 
                    if($carts->rowCount()) { 
                        $cart = $carts->fetch(PDO::FETCH_ASSOC);
                    ?>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-2">
                            <input type="text" placeholder="Search..." class="form-control" aria-label="Recipient's username with two button addons" value="<?php echo (isset($_POST['search']) ? $_POST['search'] : null); ?>" name="search">
                        </div>
                        <div class="col-md-2">
                            <select class="form-select mb-3 form-control" name="sort" aria-label="Default select example">
                                <option value="">No sort</option>
                                <option value="date">Date</option>
                                <option value="date">Price</option>
                                <option value="date">Name</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" type="submit" name="btn_search" style="width: 100%;"><i class="ri-search-line search-icon"></i> Search</button>
                        </div>
                    </div>
                    </form>

                    <div class="row">
                        <?php while ($product = $products->fetch(PDO::FETCH_ASSOC)) { ?>
                            <div class="col-md-3">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                <div class="card" style="text-align: center;">
                                    <img src="assets/images/products/<?php echo ($product['image'] != '' ? $product['image'] : "no_image.jpg"); ?>" class="img-fluid" alt="Responsive image" style="height: 150px;">
                                    <h3><?php echo $product['name']; ?></h3>
                                    <p><span class="badge text-bg-primary" style="font-size: 12px;"><?php echo $product['price']; ?> $</span></p>
                                    <div class="input-step" style="display: flex; justify-content: center;">
                                        <button type="button" class="minus shadow">–</button>
                                        <input type="text" name="quantity" class="product-quantity" value="0" min="0" max="100">
                                        <button type="button" class="plus shadow">+</button>
                                    </div>
                                    <input type="hidden" name="cart_id" value="<?php echo $cart['id']; ?>">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                    <?php if($cartProduct->productExist($cart['id'], $product['id'])) { ?>
                                        <button class="btn btn-danger" type="submit" name="btn_remove_to_cart">Remove</button>
                                    <?php } else { ?>
                                        <button class="btn btn-primary" type="submit" name="btn_add_to_cart">Add</button>
                                    <?php } ?>
                                </div>
                                </form>
                            </div>
                        <?php } ?>
                    </div>

                    <?php } else { ?>

                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <br />
                            <br />
                            <br />
                            <br />
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <button class="btn btn-primary" type="submit" name="btn_new_order" style="width: 100%;">Create new order and get my cart ready</button>
                            </form>
                        </div>
                    </div>

                    <?php } ?>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © Velzon.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Themesbrand
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- prismjs plugin -->
    <script src="assets/libs/prismjs/prism.js"></script>
    <script src="assets/libs/list.js/list.min.js"></script>
    <script src="assets/libs/list.pagination.js/list.pagination.min.js"></script>

    <!-- listjs init -->
    <script src="assets/js/pages/listjs.init.js"></script>

    <!-- Sweet Alerts js -->
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <!-- input step init -->
    <script src="assets/js/pages/form-input-spin.init.js"></script>

    <!--jquery cdn-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>