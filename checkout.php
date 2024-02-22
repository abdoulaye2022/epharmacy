<?php
require_once("./controllers/OrderController.php");
$amout = 0;
if(isset($_SESSION['cart_id'])) {
    $items = $cartProduct->getAll($_SESSION['cart_id']);
    $totals = $cartProduct->getTotalAmount($_SESSION['cart_id']);
    $total = $totals->fetch(PDO::FETCH_ASSOC);
    $amout = $total['total'];
}
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
					            <h4 class="mb-sm-0">Checkout</h4>

					            <div class="page-title-right">
					                <ol class="breadcrumb m-0">
					                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
					                    <li class="breadcrumb-item active">Checkout</li>
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

                                        <div class="row mb-3">
                        <div class="col-xl-8">
                            <div class="row align-items-center gy-3 mb-3">
                                <div class="col-sm">
                                    <div>
                                        <h5 class="fs-14 mb-0">Your Cart (<?php echo $items->rowCount(); ?> items)</h5>
                                    </div>
                                </div>
                                <div class="col-sm-auto">
                                    <a href="new_order.php" class="link-primary text-decoration-underline">Continue Shopping</a>
                                </div>
                            </div>

                            <?php while ($row = $items->fetch(PDO::FETCH_ASSOC)) { ?>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <input type="hidden" name="cart_id" value="<?php echo $row['cart_id']; ?>">
                            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                            <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                            <div class="card product">
                                <div class="card-body">
                                    <div class="row gy-3">
                                        <div class="col-sm-auto">
                                            <div class="avatar-lg bg-light rounded p-1">
                                                <img src="assets/images/products/<?php echo ($row['image'] != '' ? $row['image'] : "no_image.jpg"); ?>" alt="" class="img-fluid d-block">
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <h5 class="fs-14 text-truncate"><a href="ecommerce-product-detail.html" class="text-dark"><?php echo $row['name']; ?></a></h5>
                                            <ul class="list-inline text-muted">
                                                <li class="list-inline-item"><?php echo $row['description']; ?></li>
                                            </ul>

                                            <div class="input-step light">
                                                <button type="button" class="minus shadow">–</button>
                                                <input type="text" name="quantity" class="product-quantity" value="<?php echo $row['quantity'] ?>" min="0" max="100">
                                                <button type="button" class="plus shadow">+</button>
                                            </div>
                                        </div>
                                        <div class="col-sm-auto">
                                            <div class="text-lg-end">
                                                <p class="text-muted mb-1">Item Price:</p>
                                                <h5 class="fs-14">$<span id="ticket_price" class="product-price"><?php echo $row['price']; ?></span></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- card body -->
                                <div class="card-footer">
                                    <div class="row align-items-center gy-3">
                                        <div class="col-sm">
                                            <div class="d-flex flex-wrap my-n1">
                                                <div>
                                                    <button class="btn btn-danger" type="submit" name="btn_remove_to_cart"><i class="bx bxs-trash "></i> Remove</button>
                                                </div>
                                                &nbsp;
                                                &nbsp;
                                                <div>
                                                    <button class="btn btn-success" type="submit" name="btn_update_to_cart"><i class="bx bxs-trash "></i> Update</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-auto">
                                            <div class="d-flex align-items-center gap-2 text-muted">
                                                <div>Total :</div>
                                                <h5 class="fs-14 mb-0">$<span class="product-line-price"><?php echo ($row['quantity'] * $row['price']); ?></span></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card footer -->
                            </div>
                            </form>
                            <?php } ?>


                            <div class="text-end mb-4">
                                <a href="apps-ecommerce-checkout.html" class="btn btn-success btn-label right ms-auto"><i class="ri-arrow-right-line label-icon align-bottom fs-16 ms-2"></i> Checkout</a>
                            </div>
                        </div>
                        <!-- end col -->

                        <div class="col-xl-4">
                            <div class="card">
                                    <div class="card-header border-bottom-dashed">
                                        <h5 class="card-title mb-0">Order Summary</h5>
                                    </div>
                                    <div class="card-body pt-2">
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td>Sub Total :</td>
                                                        <td class="text-end" id="cart-subtotal">$ <?php echo $helper->formatPrice($amout); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Estimated Tax (15%) : </td>
                                                        <?php $tax = ((float)$amout * 0.15); ?>
                                                        <td class="text-end" id="cart-tax">$  <?php echo $helper->formatPrice($tax); ?></td>
                                                    </tr>
                                                    <tr class="table-active">
                                                        <th>Total (USD) :</th>
                                                        <td class="text-end">
                                                            <span class="fw-semibold" id="cart-total">
                                                                $<?php echo $helper->formatPrice($amout + $tax); ?>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table-responsive -->
                                    </div>
                                </div>

                            <div class="sticky-side-div">
                                <div class="card card-height-100 ">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Payement form</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mx-auto" style="max-width: 350px">
                                        <div class="text-bg-info bg-gradient p-4 rounded-3 mb-3">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <i class="bx bx-chip h1 text-warning"></i>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <i class="bx bxl-visa display-2 mt-n3"></i>
                                                </div>
                                            </div>
                                            <div class="card-number fs-20" id="card-num-elem">
                                                XXXX XXXX XXXX XXXX
                                            </div>
                    
                                            <div class="row mt-4">
                                                <div class="col-4">
                                                    <div>
                                                        <div class="text-white-50">Card Holder</div>
                                                        <div id="card-holder-elem" class="fw-medium fs-14">Full Name</div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="expiry">
                                                        <div class="text-white-50">Expires</div>
                                                        <div class="fw-medium fs-14">
                                                            <span id="expiry-month-elem">00</span>
                                                            /
                                                            <span id="expiry-year-elem">0000</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div>
                                                        <div class="text-white-50">CVC</div>
                                                        <div id="cvc-elem" class="fw-medium fs-14">---</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card div elem -->
                                    </div>
                    
                    
                                    <form id="custom-card-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="off">
                                        <input type="hidden" name="total" value="<?php echo $amout; ?>">
                                        <div class="mb-3">
                                            <label for="card-num-input" class="form-label">Card Number</label>
                                            <input id="card-num-input" name="card_number" class="form-control" maxlength="19" placeholder="0000 0000 0000 0000" />
                                        </div>
                    
                                        <div class="mb-3">
                                            <label for="card-holder-input" class="form-label">Card Holder</label>
                                            <input type="text" class="form-control" name="card_holder" id="card-holder-input" placeholder="Enter holder name" />
                                        </div>
                    
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div>
                                                    <label for="expiry-month-input" class="form-label">Expiry Month</label>
                                                    <select class="form-select" id="expiry-month-input" name="expiry_month">
                                                        <option></option>
                                                        <option value="01">01</option>
                                                        <option value="02">02</option>
                                                        <option value="03">03</option>
                                                        <option value="04">04</option>
                                                        <option value="05">05</option>
                                                        <option value="06">06</option>
                                                        <option value="07">07</option>
                                                        <option value="08">08</option>
                                                        <option value="09">09</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- end col -->
                    
                                            <div class="col-lg-4">
                                                <div>
                                                    <label for="expiry-year-input" class="form-label">Expiry Year</label>
                                                    <select class="form-select" id="expiry-year-input" name="expiry_year">
                                                        <option></option>
                                                        <option value="2020">2020</option>
                                                        <option value="2021">2021</option>
                                                        <option value="2022">2022</option>
                                                        <option value="2023">2023</option>
                                                        <option value="2024">2024</option>
                                                        <option value="2025">2025</option>
                                                        <option value="2026">2026</option>
                                                        <option value="2027">2027</option>
                                                        <option value="2028">2028</option>
                                                        <option value="2029">2029</option>
                                                        <option value="2030">2030</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- end col -->
                    
                                            <div class="col-lg-4">
                                                <div class="cvc">
                                                    <label for="cvc-input" class="form-label">CVC</label>
                                                    <input type="text" id="cvc-input" class="form-control" maxlength="3" name="cvc" />
                                                </div>
                                            </div>
                                            <!-- end col -->
                                        </div>
                                        <!-- end row -->
                    
                                        <button class="btn btn-danger w-100 mt-3" type="submit" name="pay_now">Pay Now</button>
                                    </form>
                                    <!-- end card form elem -->
                                </div>
                            </div>

                            </div>
                            <!-- end stickey -->

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

    <!-- ecommerce cart js -->
    <script src="assets/js/pages/ecommerce-cart.init.js"></script>

    <!--jquery cdn-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>