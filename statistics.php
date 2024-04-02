<?php
require_once("./controllers/StatisticController.php");
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
					            <h4 class="mb-sm-0">Statistics</h4>

					            <div class="page-title-right">
					                <ol class="breadcrumb m-0">
					                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
					                    <li class="breadcrumb-item active">Statistics</li>
					                </ol>
					            </div>

					        </div>
					    </div>
					</div>
					<!-- end page title -->


<!-- CUSTOMERS PAGE -->
<?php if (isset($_GET['type']) && $_GET['type'] == 'customers') { ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Form to search orders by customer and status -->
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?type=customers">
                        <div class="row g-4 mb-3">
                            <div class="col-md-6">
                                <select class="form-control" name="customer_id">
                                    <option value="">Please select a customer</option>
                                    <?php while ($customer = $customers->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <option value="<?php echo $customer['id']; ?>"><?php echo $customer['firstname'] . ' ' . $customer['lastname']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select class="form-control" name="status">
                                    <option value="">Select an order status</option>
                                    <option value="in_progress">In progress</option>
                                    <option value="done">Done</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" name="search_customer_orders" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>

<!-- Table to display orders -->
<?php if(isset($orders) && $orders > 0) { ?>
    <div class="table-responsive table-card mt-3 mb-1">
        <table class="table align-middle table-nowrap">
            <thead class="table-light">
                <tr>
                    <th>Customer Name</th>
                    <th>Order Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <?php
                    // Fetch customer's first name and last name
                    $customer_id = $order['customer_id'];
                    $stmt = $user->getUserById($customer_id);
                    $customer = $stmt->fetch(PDO::FETCH_ASSOC);
                    $customer_name = $customer['firstname'] . ' ' . $customer['lastname'];
                    ?>
                    <tr>
                        <td><?= $customer_name ?></td>
                        <td><?= $order['order_date'] ?></td>
                        <td>
                            <?php if ($order['status'] == 'in_progress'): ?>
                                <span class="badge badge-soft-danger text-uppercase">In Progress</span>
                            <?php elseif ($order['status'] == 'done'): ?>
                                <span class="badge badge-soft-success text-uppercase">Done</span>
                            <?php endif; ?>
                        </td>
                                            </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php } else { ?>
    <!-- No results found -->
    <div class="noresult" style="display: inline-block; width: 100%;">
        <div class="text-center">
            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
            <h5 class="mt-2">No Results Found</h5>
            <p class="text-muted mb-0">There are no orders matching the selected criteria.</p>
        </div>
    </div>
<?php } ?>
                </div>
            </div><!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->

<!-- ORDERS PAGE -->
<?php } elseif (isset($_GET['type']) && $_GET['type'] == 'orders') { ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div id="orderList">
                        <div class="row g-4 mb-3">
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?type=orders">
                                <!-- Input fields for start and end dates -->
                                <div class="row g-3 mb-0 align-items-center">
                                    <p class="fs-16 mb-1">Specify the date range for reviewing orders :</p>
                                    <div class="col-sm-auto">
                                        <div class="input-group">
                                            <input type="text" name="start_date" class="form-control border-0 dash-filter-picker shadow" data-provider="flatpickr" data-range-date="true" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
                                            <div class="input-group-text bg-primary border-primary text-white">
                                                <i class="ri-calendar-2-line"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Search button -->
                                <button type="submit" name="search_orders" class="btn btn-primary">
                                    Search
                                </button>
                            </form>
                        </div>
                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap">
                                <thead class="table-light">
                                    <tr>
                                        <th class="sort" data-sort="firstname">Total Amount</th>
                                        <th class="sort" data-sort="lastname">Date</th>
                                        <th class="sort" data-sort="status">Status</th>
                                    </tr>
                                </thead>
                                <?php if($orders->rowCount() == 0) { ?>
                                    <tbody>
                                        <tr>
                                            <td colspan="3">
                                                <div class="noresult" style="display: inline-block; width: 100%;">
                                                    <div class="text-center">
                                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                                        </lord-icon>
                                                        <h5 class="mt-2">Sorry! No Result Found</h5>
                                                        <p class="text-muted mb-0">We've searched more than 150+ Orders... We did not find the order you are looking for.</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <div class="pagination-wrap hstack gap-2">
                            <a class="page-item pagination-prev disabled" href="#">
                                Previous
                            </a>
                            <ul class="pagination listjs-pagination mb-0"></ul>
                            <a class="page-item pagination-next" href="#">
                                Next
                            </a>
                        </div>
                    </div>
                </div>
            </div><!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->

<?php } else { ?>
    <p>Invalid page type or missing parameter.</p>
<?php } ?>

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

    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <!--jquery cdn-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>