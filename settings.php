<?php
require_once("./controllers/ProfilController.php");
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
                    <div class="position-relative mx-n4 mt-n4">
                            <img src="assets/images/profile-bg.jpg" class="profile-wid-img" alt="">
                            <div class="overlay-content">
                                <div class="text-end p-3">
                                    <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                                       
                                        <label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light">
                                            
                                        </label>
                                    </div>
                                </div>
                            </div>
                    </div>

                    
                        <div class="col-xxl-3">
                        <div class="card mt-n5" style="margin-bottom: 70px;">
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                            <img src="assets/images/profil/<?php echo $auth->getAuthImage(); ?>" class="rounded-circle avatar-xl img-thumbnail user-profile-image  shadow" alt="user-profile-image">
                                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                <input id="profile-img-file-input" type="file" name="profil_img" class="profile-img-file-input">
                                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-light text-body shadow">
                                                        <i class="ri-camera-fill"></i>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <h5 class="fs-16 mb-1"><?php echo $auth->getAuthFullname(); ?></h5>
                                        <p class="text-muted mb-0"><?php echo $auth->getAuthProfil(); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <!-- <div class="row"> -->
                            <div class="card mt-xxl-n5">
                                <div class="card-header">
                                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#companyDetails" role="tab">
                                                <i class="fas fa-home"></i> Company Details
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                                <i class="far fa-user"></i> Change Password
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body p-4">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="companyDetails" role="tabpanel">
                                            <div class="row">
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
                                                <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
                                                <div class="row">
                                                <div class="mb-3">
                                                    <label for="firstnameInput" class="form-label">Company Name</label>
                                                    <input type="text" class="form-control" id="firstnameInput" placeholder="Firstname" value="<?php echo $_SESSION['firstname']; ?>" name="firstname">
                                                </div>

                                                <!-- <div class="mb-3">
                                                    <label for="lastnameInput" class="form-label">Last Name</label>
                                                    <input type="text" class="form-control" id="lastnameInput" placeholder="Lastname" value="<?php echo $_SESSION['lastname']; ?>" name="lastname">
                                                </div> -->

                                                <div class="mb-3">
                                                    <label for="phonenumberInput" class="form-label">Phone Number</label>
                                                    <input type="text" class="form-control" id="phonenumberInput" placeholder="Phone" value="<?php echo $_SESSION['phone']; ?>" name="phone">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="emailInput" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="emailInput" placeholder="Email" value="<?php echo $_SESSION['email']; ?>" disabled>
                                                </div>

                                                <!-- <div class="mb-3">
                                                    <label for="JoiningdatInput" class="form-label">Designation</label>
                                                    <input type="text" class="form-control" id="JoiningdatInput" placeholder="Designation" value="<?php echo $_SESSION['designation']; ?>" name="designation" />
                                                </div> -->

                                                <div class="mb-3">
                                                    <label for="designationInput" class="form-label">Address</label>
                                                    <input type="text" class="form-control" id="designationInput" placeholder="Enter address" value="<?php echo $_SESSION['adress']; ?>" name="adress">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="websiteInput1" class="form-label">City</label>
                                                    <input type="text" class="form-control" id="websiteInput1" placeholder="City" value="<?php echo $_SESSION['city']; ?>" name="city"/>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="cityInput" class="form-label">Province</label>
                                                    <input type="text" class="form-control" id="cityInput" placeholder="Province" value="<?php echo $_SESSION['province']; ?>" name="province" />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="countryInput" class="form-label">Country</label>
                                                    <select class="form-control" id="countryInput" name="country">
                                                        <option>country</option>
                                                        <?php foreach ($countries as $key => $value) { ?>
                                                            <option value="<?php echo $key; ?>" <?php $_SESSION['country'] == $key ? "selected" : null ?>><?php echo $value; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="zipcodeInput" class="form-label">Zip Code</label>
                                                    <input type="text" class="form-control" minlength="5" maxlength="6" id="zipcodeInput" placeholder="Zipcode" value="<?php echo $_SESSION['postal_code']; ?>" name="postal_code">
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="languageSelect" class="form-label">Language Preference</label>
                                                <select class="form-select" id="languageSelect" name="language">
                                                <option value="english">English</option>
                                                <option value="french">French</option>
                                            </select>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="darkModeToggle">
                                                    <label class="form-check-label" for="darkModeToggle">Dark Mode</label>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-check form-switch mt-2">
                                                    <input class="form-check-input" type="checkbox" id="notificationsToggle">
                                                    <label class="form-check-label" for="notificationsToggle">Notifications</label>
                                                </div>
                                            </div>


                                       




                                                <div class="col-lg-12">
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <button type="submit" class="btn btn-primary">Updates</button>
                                                        <button type="button" class="btn btn-soft-success">Cancel</button>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </div>
                                        <!--end tab-pane-->
                                        <div class="tab-pane" id="changePassword" role="tabpanel">
                                            <div class="row g-2">
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label for="oldpasswordInput" class="form-label">Old Password*</label>
                                                        <input type="password" name="old_password" class="form-control" id="oldpasswordInput" placeholder="Enter current password">
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label for="newpasswordInput" class="form-label">New Password*</label>
                                                        <input type="password" name="new_password" class="form-control" id="newpasswordInput" placeholder="Enter new password">
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label for="confirmpasswordInput" class="form-label">Confirm Password*</label>
                                                        <input type="password" name="confirm_new_password" class="form-control" id="confirmpasswordInput" placeholder="Confirm password">
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <a href="javascript:void(0);" class="link-primary text-decoration-underline">Forgot Password ?</a>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-12">
                                                    <div class="text-end">
                                                        <button type="submit" class="btn btn-success">Change Password</button>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                            <!-- <div class="mt-4 mb-3 border-bottom pb-2">
                                                <div class="float-end">
                                                    <a href="javascript:void(0);" class="link-primary">All Logout</a>
                                                </div>
                                                <h5 class="card-title">Login History</h5>
                                            </div>
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="flex-shrink-0 avatar-sm">
                                                    <div class="avatar-title bg-light text-primary rounded-3 fs-18 shadow">
                                                        <i class="ri-smartphone-line"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6>iPhone 12 Pro</h6>
                                                    <p class="text-muted mb-0">Los Angeles, United States - March 16 at 2:47PM</p>
                                                </div>
                                                <div>
                                                    <a href="javascript:void(0);">Logout</a>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        <!--end col-->
                        <!-- </div> -->
                    <!--end row-->

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