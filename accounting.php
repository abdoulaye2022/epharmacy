<?php
require_once("./controllers/ProductController.php");
#require_once("./controllers/ProductsController.php");
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
					            <h4 class="mb-sm-0">Accounting</h4>

					            <div class="page-title-right">
					                <ol class="breadcrumb m-0">
					                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
					                    <li class="breadcrumb-item active">Accounting</li>
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
                                    <div>
                                        <div class="row g-4 mb-3">
                                            <!-- <div class="col-sm-auto">
                                                <div>
                                                    <button type="button" class="btn btn-primary add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add</button>
                                                </div>
                                            </div> -->
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

                                        <div class="table-responsive table-card mt-3 mb-1">
                                            <table class="table align-middle table-nowrap">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="sort" data-sort="description">Invoice Number</th>
                                                        <th class="sort" data-sort="name">Client Name</th>                                                      
                                                        <th class="sort" data-sort="quantity">Invoice Date</th>
                                                        <th class="sort" data-sort="quantity">Invoice Amount</th>
                                                        <!-- <th class="sort" data-sort="quantity">Minimun Quantity</th>
                                                        <th class="sort" data-sort="quantity">Suplier</th>
                                                        <th class="sort" data-sort="quantity">Warehouse</th> -->
                                                        <th class="sort" data-sort="quantity">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="form-check-all">
                                                    <?php while($row = $products->fetch(PDO::FETCH_ASSOC)) { ?>
                                                    <tr>
                                                        <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#VZ2101</a></td>
                                                        <td class="name"><?php echo $row['name']; ?></td>
                                                        <!-- <td class="description"><?php echo $row['description']; ?></td> -->
                                                        <td class="quantity"><?php echo $row['code_product']; ?></td>                                                     
                                                        <td class="quantity"><?php echo $row['min_quantity']; ?></td>
                                                        <td class="quantity"><?php echo $row['price']; ?> $</td>
                                                        <!-- <td class="quantity"><?php echo $row['supplier_name']; ?></td>
                                                        <td class="quantity"><?php echo $row['warehouse_name']; ?></td> -->
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <div class="edit">
                                                                    <button class="btn btn-sm btn-warning edit-item-btn" data-bs-toggle="modal" data-bs-target="#viewModal_<?php echo $row['id']; ?>">Print</button>
                                                                </div>
                                                                <!-- <div class="edit">
                                                                    <button class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal" data-bs-target="#edittModal_<?php echo $row['id']; ?>">Edit</button>
                                                                </div>
                                                                <div class="remove">
                                                                    <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteModal_<?php echo $row['id']; ?>"><i class="bx bxs-trash"></i> Delete</button>
                                                                </div> -->
                                                            </div>
                                                        </td>
                                                    </tr>

                                                     <!-- Modal view user -->
                                                    <div class="modal fade" id="viewModal_<?php echo $row['id']; ?>" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-light p-3">
                                                                    <h5 class="modal-title">View product</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                                </div>
                                                                <div style="display: flex; align-items: center;flex-direction: column;">
                                                                    <img src="assets/images/products/<?php echo ($row['image'] != '' ? $row['image'] : "no_image.jpg"); ?>" class="figure-img img-fluid rounded" alt="..." style="height: 250px; width: 80%;">
                                                                    <h3>Name : <?php echo $row['name']; ?></h3>
                                                                    <p>Description : <?php echo $row['description']; ?></p>
                                                                    <p>Code product : <?php echo $row['code_product']; ?></p>
                                                                    <p>Code product : <?php echo $row['price']; ?> $</p>
                                                                    <p>Minimun quantity : <?php echo $row['min_quantity']; ?></p>
                                                                    <p>Supplier : <?php echo $row['supplier_name']; ?></p>
                                                                    <p>Warehouse : <?php echo $row['warehouse_name']; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal edit user -->
                                                    <div class="modal fade" id="edittModal_<?php echo $row['id']; ?>" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-light p-3">
                                                                    <h5 class="modal-title">Edit product</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                                </div>
                                                                <?php $role = new Profil($cn); $roles = $role->getAll(); ?>
                                                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="tablelist-form" autocomplete="off" enctype="multipart/form-data">
                                                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                                    <?php
                                                                    $supplier = new Supplier($cn);
                                                                    $warehouse = new Warehouse($cn);
                                                                    $suppliers = $supplier->getAll();
                                                                    $warehouses = $warehouse->getAll();
                                                                    ?>
                                                                    <div class="modal-body">
                                                                        <div class="card-body">
                                                                            <div class="live-preview">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="mb-3">
                                                                                            <label for="name" class="form-label">Name <span style="color: red;">*</span></label>
                                                                                            <input type="text" class="form-control" name="name" placeholder="Enter the product name" id="nameinput" value="<?php echo $row['name']; ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <div class="mb-3">
                                                                                            <label for="code_product" class="form-label">Code product <span style="color: red;">*</span></label>
                                                                                            <input type="text" class="form-control" name="code_product" placeholder="Enter code product" id="quantityinput" value="<?php echo $row['code_product']; ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <div class="mb-3">
                                                                                            <label for="price" class="form-label">Price <span style="color: red;">*</span></label>
                                                                                            <input type="text" class="form-control" name="price" placeholder="Enter price" id="price" value="<?php echo $row['price']; ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <div class="mb-3">
                                                                                            <label for="min_quantity" class="form-label">Minimun Quantity <span style="color: red;">*</span></label>
                                                                                            <input type="text" class="form-control" name="min_quantity" placeholder="Enter minimun quantity" id="mini_quantity" value="<?php echo $row['min_quantity']; ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <!--end col-->
                                                                                    <div class="col-md-12">
                                                                                        <div class="mb-3">
                                                                                            <label for="description" class="form-label">Description</label>
                                                                                            <textarea type="text" class="form-control" name="description" placeholder="Enter description" id="description"><?php echo $row['description']; ?></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <div class="mb-3">
                                                                                            <label for="supplier_id" class="form-label">Supplier <span style="color: red;">*</span></label>
                                                                                            <select class="js-example-basic-single form-control" name="supplier_id">
                                                                                                <option value="">select supplier</option>
                                                                                                <?php while($supplier = $suppliers->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                                                    <option value="<?php echo $supplier['id']; ?>" <?php echo ($row['supplier_id'] == $supplier['id'] ? "selected" : null); ?>><?php echo $supplier['name']; ?></option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <div class="mb-3">
                                                                                            <label for="warehouse_id" class="form-label">Warehouse <span style="color: red;">*</span></label>
                                                                                            <select class="js-example-basic-single form-control" name="warehouse_id">
                                                                                                <option value="">select warehouse</option>
                                                                                                <?php while($warehouse = $warehouses->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                                                    <option value="<?php echo $warehouse['id']; ?>" <?php echo ($row['warehouse_id'] == $warehouse['id'] ? "selected" : null); ?>><?php echo $warehouse['name']; ?></option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <div class="mb-3">
                                                                                            <label for="product_img" class="form-label">Images</label>
                                                                                            <?php if($row['image'] != "") { ?>
                                                                                            <input type="text" class="form-control" value="<?php echo $row['image']; ?>" readonly>
                                                                                            <?php } ?>
                                                                                            <input type="file" name="product_img" class="form-control">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            <div class="d-none code-view">
                                                                                <pre class="language-markup" style="height: 375px;"></pre>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <div class="hstack gap-2 justify-content-end">
                                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-success" name="edit_product" id="add-edi">Save</button>
                                                                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal -->
                                                    <div class="modal fade zoomIn" id="deleteModal_<?php echo $row['id']; ?>" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mt-2 text-center">
                                                                        <lord-icon src="https://cdn.lordicon.com/vihyezfv.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                                                                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                                            <h4>Are you Sure ?</h4>
                                                                            <p class="text-muted mx-4 mb-0">
                                                                            Are you sure you want to block
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit" name="btnblock" class="btn w-sm btn-danger">Yes, Delete It!</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end modal -->
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                            <?php if($products->rowCount() == 0) { ?>
                                            <div class="noresult" style="display: inline-block; width: 100%;">
                                                <div class="text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                                    </lord-icon>
                                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                                    <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any
                                                        orders for you search.</p>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>

                                       <!--  <div class="d-flex justify-content-end">
                                            <div class="pagination-wrap hstack gap-2">
                                                <a class="page-item pagination-prev disabled" href="#">
                                                    Previous
                                                </a>
                                                <ul class="pagination listjs-pagination mb-0"></ul>
                                                <a class="page-item pagination-next" href="#">
                                                    Next
                                                </a>
                                            </div>
                                        </div> -->
                                    </div>
                                </div><!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                    </div>

                    <!-- Modal add user -->
                    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-light p-3">
                                    <h5 class="modal-title" id="exampleModalLabel">Add product</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                </div>
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="tablelist-form" autocomplete="off" enctype="multipart/form-data">
                                    <?php
                                    $supplier = new Supplier($cn);
                                    $warehouse = new Warehouse($cn);
                                    $suppliers = $supplier->getAll();
                                    $warehouses = $warehouse->getAll();
                                    ?>
                                    <div class="modal-body">
                                        <div class="card-body">
                                            <div class="live-preview">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Name <span style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" name="name" placeholder="Enter the product name" id="nameinput">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="code_product" class="form-label">Code product <span style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" name="code_product" placeholder="Enter code product" id="quantityinput">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="code_product" class="form-label">Price <span style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" name="price" placeholder="Enter price" id="price">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="min_quantity" class="form-label">Minimun quantity <span style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" name="min_quantity" placeholder="Enter minimun quantity" id="min_quantity">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="description" class="form-label">Description</label>
                                                            <textarea type="text" class="form-control" name="description" placeholder="Enter description" id="description"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="supplier_id" class="form-label">Supplier <span style="color: red;">*</span></label>
                                                            <select class="js-example-basic-single form-control" name="supplier_id">
                                                                <option value="">select supplier</option>
                                                                <?php while($supplier = $suppliers->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                    <option value="<?php echo $supplier['id']; ?>"><?php echo $supplier['name']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="warehouse_id" class="form-label">Warehouse <span style="color: red;">*</span></label>
                                                            <select class="js-example-basic-single form-control" name="warehouse_id">
                                                                <option value="">select warehouse</option>
                                                                <?php while($warehouse = $warehouses->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                    <option value="<?php echo $warehouse['id']; ?>"><?php echo $warehouse['name']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="product_img" class="form-label">Images</label>
                                                            <input type="file" name="product_img" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="d-none code-view">
                                                <pre class="language-markup" style="height: 375px;"></pre>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" name="add_product" id="add-btn">Save</button>
                                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
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

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © Velzon.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Develop by Abdoulaye, Julie and Lucas
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

    <!-- Sweet Alerts js -->
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <!--jquery cdn-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <script>
$(document).ready(function(){
    $(".search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".table tbody tr").each(function() {
            var $row = $(this);
            var rowText = $row.text().toLowerCase();
            if (rowText.includes(value)) {
                $row.show();
                $row.find('td').each(function() {
                    var cellText = $(this).text();
                    var regex = new RegExp('(' + value + ')', 'gi');
                    $(this).html(cellText.replace(regex, '<span class="highlight">$1</span>'));
                });
            } else {
                $row.hide();
            }
        });
    });
});
</script>

<style>
    .highlight {
        background-color: yellow;
        font-weight: bold;
    }
</style>

    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->

<!-- <script>
document.addEventListener("DOMContentLoaded", function() {
    const searchInputs = document.querySelectorAll('.search');

    searchInputs.forEach(searchInput => {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.trim().toLowerCase();
            const table = document.querySelector('.table'); // Assuming the table class is 'table'

            const tableRows = table.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                const columns = row.querySelectorAll('td');
                let found = false;
                columns.forEach(column => {
                    const text = column.textContent.trim().toLowerCase();
                    if (text.includes(searchTerm)) {
                        found = true;
                    }
                });
                if (found) {
                    row.style.display = ''; // Show the row if the search term is found
                } else {
                    row.style.display = 'none'; // Hide the row if the search term is not found
                }
            });
        });
    });
});
</script> -->

</body>

</html>