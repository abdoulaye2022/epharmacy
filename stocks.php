<?php
require_once("./controllers/StockController.php");
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Notre template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Sweet Alert css-->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
					            <h4 class="mb-sm-0">Stocks list</h4>

					            <div class="page-title-right">
					                <ol class="breadcrumb m-0">
					                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
					                    <li class="breadcrumb-item active">Stocks</li>
					                </ol>
					            </div>

					        </div>
					    </div>
					</div>
					<!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">

                                <div class="card-body">
                                    <div id="customerList">
                                        <div class="row g-4 mb-3">
                                            <div class="col-sm-auto">
                                                <div>
                                                    <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add</button>
                                                    <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <?php if($error != "") { ?>
                                                    <div class="col-lg-12">
                                                        <div class="alert alert-danger alert-borderless shadow mb-xl-0" role="alert">
                                                            <?php echo $error; ?>
                                                        </div>
                                                    </div>
                                                <?php } else if($success != "") { ?>
                                                    <div class="col-lg-12" style="color: green;">
                                                        <div class="alert alert-success alert-borderless shadow" role="alert">
                                                            <?php echo $success; ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="col-sm">
                                                <div class="d-flex justify-content-sm-end">
                                                    <div class="search-box ms-2">
                                                        <input type="text" class="form-control search" placeholder="Search...">
                                                        <i class="ri-search-line search-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <table class="table align-middle table-nowrap">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Expiration date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="form-check-all">
                                                        <?php while($row = $stocks->fetch(PDO::FETCH_ASSOC)) { ?>
                                                            <tr>
                                                                <td><?php echo $row['name']; ?></td>
                                                                <td><?php echo $row['expire_date']; ?></td>
                                                                <td> 
                                                                    <div class="d-flex gap-2">
                                                                        <!-- Buttons Group -->
                                                                        <button type="button" class="btn btn-success waves-effect waves-light btn-sm"><i class=" bx bx-edit-alt " data-bs-toggle="modal" data-bs-target="#eidtModal_<?php echo $row['id']; ?>"></i></button>
                                                                        <button type="button" class="btn btn-danger btn-icon waves-effect waves-light btn-sm" data-bs-toggle="modal" data-bs-target="#eidtModal_<?php echo $row['id']; ?>"><i class="bx bx-trash"></i></button>
                                                                        <?php if(isset($_GET['stock_id']) && $_GET['stock_id'] == $row['id']) { ?>
                                                                        <a href="stocks.php?stock_id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm waves-effect waves-light"><i class="bx bx-right-arrow" style="font-size: 15px;"></i></a>
                                                                        <?php } else { ?>
                                                                        <a href="stocks.php?stock_id=<?php echo $row['id']; ?>" class="btn btn-default btn-sm waves-effect waves-light"><i class="bx bx-minus" style="font-size: 15px;"></i></a>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <!-- Modal update stock -->
                                                            <div class="modal fade" id="eidtModal_<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-light p-3">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Add stock</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                                        </div>
                                                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="tablelist-form">
                                                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                                            <div class="modal-body">
                                                                                <div class="card-body">
                                                                                    <div class="live-preview">
                                                                                        <div class="row">
                                                                                            <div class="col-md-12">
                                                                                                <div class="mb-3">
                                                                                                    <label for="name" class="form-label">Name <span style="color: red;">*</span></label>
                                                                                                    <input type="text" class="form-control" name="name" placeholder="Enter stock name" id="name" value="<?php echo $row['name']; ?>">
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-12">
                                                                                                <div class="mb-3">
                                                                                                    <label for="expiration_date" class="form-label">Expiration date <span style="color: red;">*</span></label>
                                                                                                    <input type="date" class="form-control" name="expiration_date" placeholder="Enter stock expiration date" id="expiration_date" value="<?php echo $row['expire_date']; ?>">
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>
                                                                                        <!--end row-->
                                                                                    </div>
                                                                                    <div class="d-none code-view">
                                                                                        <pre class="language-markup" style="height: 375px;">
                                                                                    </pre>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <div class="hstack gap-2 justify-content-end">
                                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-success" name="update_btn" id="add-btn">Save</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-6">
                                                <table class="table align-middle table-nowrap">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Quantity</th>
                                                            <th>
                                                                <?php if(isset($_GET['stock_id'])) { ?>
                                                                <button type="button" class="btn btn-primary btn-sm waves-effect" data-bs-toggle="modal" data-bs-target="#addproduct" style="padding: 0px 20px;"><i class="bx bx-plus "></i></button>
                                                                <?php } ?>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="form-check-all">
                                                        <?php
                                                        if(isset($_GET['stock_id'])) 
                                                        {
                                                            $stock_id = $helper->validateInteger($_GET['stock_id']);
                                                            $stockProducts = $stockProduct->getAll($stock_id);
                                                            while($row = $stockProducts->fetch(PDO::FETCH_ASSOC)) 
                                                            {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $row['product_name']; ?></td>
                                                                    <td><?php echo $row['quantity']; ?></td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-success btn-sm waves-effect" data-bs-toggle="modal" data-bs-target="#updateProduct_<?php echo $row['product_id']; ?>" style="padding: 0px 20px;"><i class=" bx bx-edit-alt"></i></button>
                                                                        <button type="button" class="btn btn-danger btn-sm waves-effect" data-bs-toggle="modal" data-bs-target="#removeProduct_<?php echo $row['product_id']; ?>" style="padding: 0px 20px;"><i class="bx bx-minus"></i></button>
                                                                    </td>
                                                                </tr>

                                                                <!-- Modal update from stock product -->
                                                                <div class="modal fade" id="updateProduct_<?php echo $row['product_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header bg-light p-3">
                                                                                <h5 class="modal-title" id="updateProduct_<?php echo $row['product_id']; ?>">Update product</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                                            </div>
                                                                            <?php $products = $product->getAllProductNotInOfStock($_GET['stock_id']); ?>
                                                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] ."?stock_id=" . $_GET['stock_id']); ?>" method="POST" class="tablelist-form">
                                                                                <input type="hidden" name="stock_id" value="<?php echo $_GET['stock_id']; ?>">
                                                                                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                                                                <div class="modal-body">
                                                                                    <div class="card-body">
                                                                                        <div class="live-preview">
                                                                                            <div class="row">
                                                                                                <div class="col-md-12">
                                                                                                    <div class="mb-3">
                                                                                                        <label for="product_id" class="form-label">Name <span style="color: red;">*</span></label>
                                                                                                        <select id="product_id" class="js-example-basic-single form-control" name="product_id"><option value="<?php echo $row['product_id']; ?>" disabled selected><?php echo $row['product_name']; ?></option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="col-md-12">
                                                                                                    <div class="mb-3">
                                                                                                        <label for="quantity" class="form-label">Quantity <span style="color: red;">*</span></label>
                                                                                                        <input type="number" class="form-control" name="quantity" placeholder="Enter your firstname" id="firstNameinput" value="<?php echo $row['quantity']; ?>">
                                                                                                    </div>
                                                                                                </div>

                                                                                            </div>
                                                                                            <!--end row-->
                                                                                        </div>
                                                                                        <div class="d-none code-view">
                                                                                            <pre class="language-markup" style="height: 375px;">
                                                                                        </pre>
                                                                                        </div>
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <div class="hstack gap-2 justify-content-end">
                                                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                                        <button type="submit" class="btn btn-success" name="update_product" id="add-btn">Save</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Modal remove product -->
                                                                <div class="modal fade" id="removeProduct_<?php echo $row['product_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header bg-light p-3">
                                                                                <h5 class="modal-title" id="removeProduct_<?php echo $row['product_id']; ?>">Alert</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                                            </div>
                                                                            <?php //$role = new Profil($cn); $roles = $role->getAll(); ?>
                                                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] ."?stock_id=" . $_GET['stock_id']); ?>" method="POST" class="tablelist-form">
                                                                                <input type="hidden" name="stock_id" value="<?php echo $_GET['stock_id']; ?>">
                                                                                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                                                                <div class="modal-body">
                                                                                    <div class="card-body">
                                                                                        <div class="live-preview">
                                                                                            <div class="row">
                                                                                                <div class="col-md-12">
                                                                                                    <p>Do you confirm the removal of the product <strong><?php echo $row['product_name']; ?></strong> from the stock?</p>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!--end row-->
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <div class="hstack gap-2 justify-content-end">
                                                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">No</button>
                                                                                        <button type="submit" class="btn btn-success" name="remove_product_btn" id="remove_product_btn">Yes</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                                <?php if(!isset($_GET['stock_id'])) { ?>
                                                    <div class="noresult" style="display: inline-block; width: 100%;">
                                                        <div class="text-center">
                                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                                            </lord-icon>
                                                            <h5 class="mt-2">Sorry! No stock is selected</h5>
                                                        </div>
                                                    </div>
                                                <?php } else { ?>
                                                    <!-- Modal add product -->
                                                    <div class="modal fade" id="addproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-light p-3">
                                                                    <h5 class="modal-title" id="addproduct">Add product</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                                </div>
                                                                <?php $product = new Product($cn); $products = $product->getAllProductNotInOfStock($_GET['stock_id']); ?>
                                                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] ."?stock_id=" . $_GET['stock_id']); ?>" method="POST" class="tablelist-form">
                                                                    <input type="hidden" name="stock_id" value="<?php echo $_GET['stock_id']; ?>">
                                                                    <div class="modal-body">
                                                                        <div class="card-body">
                                                                            <div class="live-preview">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="mb-3">
                                                                                            <label for="product_id" class="form-label">Name <span style="color: red;">*</span></label>
                                                                                            <select id="product_id" class="js-example-basic-single form-control" name="product_id">\<option value="">select product</option>
                                                                                                <?php while ($product = $products->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                                                    <option value="<?php echo $product['id']; ?>"><?php echo $product['name']; ?></option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-12">
                                                                                        <div class="mb-3">
                                                                                            <label for="quantity" class="form-label">Quantity <span style="color: red;">*</span></label>
                                                                                            <input type="number" class="form-control" name="quantity" placeholder="Enter your firstname" id="firstNameinput">
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                <!--end row-->
                                                                            </div>
                                                                            <div class="d-none code-view">
                                                                                <pre class="language-markup" style="height: 375px;">
                                                                            </pre>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <div class="hstack gap-2 justify-content-end">
                                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-success" name="add_product" id="add-btn">Save</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                    </div>

                    <!-- Modal add stock -->
                    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-light p-3">
                                    <h5 class="modal-title" id="exampleModalLabel">Add stock</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                </div>
                                <?php $role = new Profil($cn); $roles = $role->getAll(); ?>
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="tablelist-form">
                                    <div class="modal-body">
                                        <div class="card-body">
                                            <div class="live-preview">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="firstNameinput" class="form-label">Name <span style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" name="name" placeholder="Enter your firstname" id="firstNameinput">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="firstNameinput" class="form-label">Expiration date <span style="color: red;">*</span></label>
                                                            <input type="date" class="form-control" name="expiration_date" placeholder="Enter your firstname" id="firstNameinput">
                                                        </div>
                                                    </div>

                                                </div>
                                                <!--end row-->
                                            </div>
                                            <div class="d-none code-view">
                                                <pre class="language-markup" style="height: 375px;">
                                            </pre>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" name="add_stock" id="add-btn">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <?php include("partials/footer-app.php"); ?>

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

    <!-- Sweet Alerts js -->
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="assets/js/pages/select2.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <!--jquery cdn-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
$(document).ready(function(){
    $(".search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".table tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>

</body>

</html>