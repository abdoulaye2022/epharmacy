<?php
require_once("./controllers/CompanyController.php");
$comp = $companies->fetch(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Company</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

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

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
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
                                    <div class="text-center">
                                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                            <img src="assets/images/profil/default.jpg" class="rounded-circle avatar-xl img-thumbnail user-profile-image  shadow" alt="user-profile-image">
                                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                <input id="profile-img-file-input" type="file" name="image" class="profile-img-file-input">
                                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-light text-body shadow">
                                                        <i class="ri-camera-fill"></i>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="mb-3">
                                        <label for="firstnameInput" class="form-label">Company Name <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" id="firstnameInput" placeholder="name" value="<?php echo ($comp['name'] != "" ? $comp['name'] : null); ?>" name="name">
                                    </div>

                                    <div class="mb-3">
                                        <label for="phonenumberInput" class="form-label">Phone Number <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" id="phonenumberInput" placeholder="Phone" value="<?php echo ($comp['phone'] != "" ? $comp['phone'] : null); ?>" name="phone">
                                    </div>

                                    <div class="mb-3">
                                        <label for="emailInput" class="form-label">Email <span style="color: red;">*</span></label>
                                        <input type="email" class="form-control" id="emailInput" placeholder="Email" value="<?php echo ($comp['email'] != "" ? $comp['email'] : null); ?>" name="email">
                                    </div>

                                    <div class="mb-3">
                                        <label for="designationInput" class="form-label">Address <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" id="designationInput" placeholder="Enter address" value="<?php echo ($comp['adress'] != "" ? $comp['adress'] : null); ?>" name="adress">
                                    </div>

                                    <div class="mb-3">
                                        <label for="websiteInput1" class="form-label">City <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" id="websiteInput1" placeholder="City" value="<?php echo ($comp['city'] != "" ? $comp['city'] : null); ?>" name="city"/>
                                    </div>

                                    <div class="mb-3">
                                        <label for="cityInput" class="form-label">Province <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" id="cityInput" placeholder="Province" value="<?php echo ($comp['province'] != "" ? $comp['province'] : null); ?>" name="province" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="countryInput" class="form-label">Country <span style="color: red;">*</span></label>
                                        <select class="form-control" id="countryInput" name="country">
                                            <option>country</option>
                                            <?php foreach ($countries as $key => $value) { ?>
                                                <option value="<?php echo $key; ?>" <?php $comp['country'] != "" ? ($comp['country'] == $key ? "selected" : null) : null ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="zipcodeInput" class="form-label">Zip Code <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" minlength="5" maxlength="6" id="zipcodeInput" placeholder="Zipcode" value="<?php echo $comp['postal_code']; ?>" name="postal_code">
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" name="btn_add" class="btn btn-info">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- container-fluid -->
                </form>
            </div><!-- End Page-content -->

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

    <!-- profile-setting init js -->
    <script src="assets/js/pages/profile-setting.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>