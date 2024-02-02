<?php
require_once("./controllers/UserController.php");
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
					            <h4 class="mb-sm-0">Connection History</h4>

					            <div class="page-title-right">
					                <ol class="breadcrumb m-0">
					                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
					                    <li class="breadcrumb-item active">Users</li>
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
                                                <!-- <div>
                                                    <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add</button>
                                                    <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                                </div> -->
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
                                            <!-- <div class="col-sm">
                                                <div class="d-flex justify-content-sm-end">
                                                    <div class="search-box ms-2">
                                                        <input type="text" class="form-control search" placeholder="Search...">
                                                        <i class="ri-search-line search-icon"></i>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>

                                        <div class="table-responsive table-card mt-3 mb-1">
                                            <table class="table align-middle table-nowrap">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col" style="width: 50px;">
                                                            <div class="form-check">
                                                                <!-- <input class="form-check-input" type="checkbox" id="checkAll" value="option"> -->
                                                            </div>
                                                        </th>
                                                        <th class="sort" data-sort="customer_name">First Name</th>
                                                        <th class="sort" data-sort="customer_name">Last Name</th>
                                                        <th class="sort" data-sort="customer_name">Connection Date</th>
                                                        <th class="sort" data-sort="customer_name">Logout date</th>
                                                         <th class="sort" data-sort="date">Onsite Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="form-check-all">
                                                    <?php while($row = $users->fetch(PDO::FETCH_ASSOC)) { ?>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <!-- <input class="form-check-input" type="checkbox" name="chk_child" value="option1"> -->
                                                            </div>
                                                        </th>
                                                        <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#VZ2101</a></td>
                                                        <td class="firstname"><?php echo $row['firstname']; ?></td>
                                                        <td class="lastname"><?php echo $row['lastname']; ?></td>
                                                        <td class="lastname"><?php echo $row['designation']; ?></td>
                                                        <td class="date"><?php echo $row['email']; ?></td>
                                                        <td class="phone"><?php echo $row['phone']; ?></td>
                                                    </tr>

                                                    <!-- Modal edit user -->
                                                    <div class="modal fade" id="eidtModal_<?php echo $row['id']; ?>" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-light p-3">
                                                                    <h5 class="modal-title" id="eidtModal_<?php echo $row['id']; ?>">Edit user</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                                </div>
                                                                <?php $role = new Profil($cn); $roles = $role->getAll(); ?>
                                                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="tablelist-form" autocomplete="off">
                                                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                                    <input type="hidden" name="old_password" value="<?php echo $row['password']; ?>">
                                                                    <div class="modal-body">
                                                                        <div class="card-body">
                                                                            <div class="live-preview">
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="mb-3">
                                                                                            <label for="firstNameinput" class="form-label">First Name <span style="color: red;">*</span></label>
                                                                                            <input type="text" class="form-control" name="firstname" placeholder="Enter your firstname" id="firstNameinput" value="<?php echo $row['firstname']; ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <!--end col-->
                                                                                    <div class="col-md-6">
                                                                                        <div class="mb-3">
                                                                                            <label for="lastname" class="form-label">Last Name<span style="color: red;">*</span></label>
                                                                                            <input type="text" class="form-control" name="lastname" placeholder="Enter your lastname" id="lastname" value="<?php echo $row['lastname']; ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <!--end col-->
                                                                                    <div class="col-md-6">
                                                                                        <div class="mb-3">
                                                                                            <label for="designation" class="form-label">Connection Date</label>
                                                                                            <input type="text" class="form-control" name="designation" placeholder="Enter company name" id="compnayNameinput" value="<?php echo $row['designation']; ?>">
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- <div class="col-md-6">
                                                                                        <div class="mb-3">
                                                                                            <label for="ForminputState" class="form-label">Profil <span style="color: red;">*</span></label>
                                                                                            <select id="ForminputState" class="js-example-basic-single form-control" name="role_id">
                                                                                                <?php while ($role = $roles->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                                                    <option value="<?php echo $role['id']; ?>" <?php echo($row['role_id'] == $role['id'] ? 'selected' : null); ?>><?php echo $role['name']; ?></option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div> -->
                                                                                    <!--end col-->
                                                                                    <div class="col-md-6">
                                                                                        <div class="mb-3">
                                                                                            <label for="phone" class="form-label">Phone Number</label>
                                                                                            <input type="tel" class="form-control" name="phone" placeholder="+(245) 451 45123" value="<?php echo $row['phone']; ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <!--end col-->
                                                                                    <div class="col-md-6">
                                                                                        <div class="mb-3">
                                                                                            <label for="email" class="form-label">Email Address <span style="color: red;">*</span></label>
                                                                                            <input type="email" class="form-control" placeholder="example@gamil.com" name="email" value="<?php echo $row['email']; ?>" disabled>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!--end col-->
                                                                                    <div class="col-md-12">
                                                                                        <div class="mb-3">
                                                                                            <label for="adress" class="form-label">Address</label>
                                                                                            <input type="text" class="form-control" placeholder="Address 1" name="adress" value="<?php echo $row['adress']; ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <!--end col-->
                                                                                    <div class="col-md-6">
                                                                                        <div class="mb-3">
                                                                                            <label for="city" class="form-label">City</label>
                                                                                            <input type="text" class="form-control" placeholder="Enter your city" name="city" value="<?php echo $row['city']; ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <!--end col-->
                                                                                    <div class="col-md-6">
                                                                                        <div class="mb-3">
                                                                                            <label for="province" class="form-label">Province</label>
                                                                                            <input type="text" class="form-control" placeholder="Enter your province" id="province" name="province" value="<?php echo $row['province']; ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <!--end col-->
                                                                                    <div class="col-md-6">
                                                                                        <div class="mb-3">
                                                                                            <label for="editCountry" class="form-label">Country</label>
                                                                                            <select id="editCountry" class="js-example-basic-single form-control" name="country">
                                                                                                <?php foreach ($countries as $key => $value) { ?>
                                                                                                    <option value="<?php echo $key; ?>" <?php echo ($row['country'] == $key ? "selected" : null); ?>><?php echo $value; ?></option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!--end col-->
                                                                                    <div class="col-md-6">
                                                                                        <div class="mb-3">
                                                                                            <label for="postal_code" class="form-label">Postal code</label>
                                                                                            <input type="text" class="form-control" placeholder="Enter your postal_code" name="postal_code" value="<?php echo $row['postal_code']; ?>">
                                                                                        </div>
                                                                                    </div>

                                                                                    <!--end col-->
                                                                                    <div class="col-md-6">
                                                                                        <div class="mb-3">
                                                                                            <label for="password" class="form-label">Password <span style="color: red;">*</span></label>
                                                                                            <input type="password" class="form-control" placeholder="Enter your password" name="password" value="<?php echo $row['password']; ?>">
                                                                                        </div>
                                                                                    </div>

                                                                                    <!--end col-->
                                                                                    <div class="col-md-6">
                                                                                        <div class="mb-3">
                                                                                            <label for="confirm_password" class="form-label">Confirm Password <span style="color: red;">*</span></label>
                                                                                            <input type="password" class="form-control" placeholder="Enter your confirm password" name="confirm_password" value="<?php echo $row['password']; ?>">
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
                                                                            <button type="submit" class="btn btn-success" name="edit_user" id="edit-btn">Save</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal -->
                                                    <div class="modal fade zoomIn" id="blockModal_<?php echo $row['id']; ?>" tabindex="-1" aria-hidden="true">
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
                                                                            <?php echo ($row['actif'] ? 'Are you sure you want to block this user account ?' : 'Are you sure you want to unlock this user account ?'); ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                                            <input type="hidden" name="block" value="<?php echo ($row['actif'] ? '0' : '1'); ?>">
                                                                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit" name="btnblock" class="btn w-sm btn-danger">
                                                                                <?php echo ($row['actif'] ? 'Yes, Blocked It!' : 'Yes, Unlocked It!'); ?></button>
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
                                            <?php if($users->rowCount() == 0) { ?>
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
                            </div>
                            <!-- end col -->
                        </div>
                    </div>

                    <!-- Modal add user -->
                    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-light p-3">
                                    <h5 class="modal-title" id="exampleModalLabel">Add user</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                </div>
                                <?php $role = new Profil($cn); $roles = $role->getAll(); ?>
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="tablelist-form" autocomplete="off">
                                    <div class="modal-body">
                                        <div class="card-body">
                                            <div class="live-preview">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="firstNameinput" class="form-label">First Name <span style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" name="firstname" placeholder="Enter your firstname" id="firstNameinput">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="lastname" class="form-label">Last Name <span style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" name="lastname" placeholder="Enter your lastname" id="lastname">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="designation" class="form-label">Designation</label>
                                                            <input type="text" class="form-control" name="designation" placeholder="Enter company name" id="compnayNameinput">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="ForminputState" class="form-label">Profil <span style="color: red;">*</span></label>
                                                            <select id="ForminputState" class="js-example-basic-single form-control" name="role_id">
                                                                <?php while ($role = $roles->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                    <option value="<?php echo $role['id']; ?>"><?php echo $role['name']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="phone" class="form-label">Phone Number</label>
                                                            <input type="tel" class="form-control" name="phone" placeholder="+(245) 451 45123">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email Address <span style="color: red;">*</span></label>
                                                            <input type="email" class="form-control" placeholder="example@gamil.com" name="email">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="adress" class="form-label">Address</label>
                                                            <input type="text" class="form-control" placeholder="Address 1" name="adress">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="city" class="form-label">City</label>
                                                            <input type="text" class="form-control" placeholder="Enter your city" name="city">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="province" class="form-label">Province</label>
                                                            <input type="text" class="form-control" placeholder="Enter your province" id="province" name="province">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="addCounrty" class="form-label">Country</label>
                                                            <select id="addCounrty" class="js-example-basic-single form-control" name="country">
                                                                <?php foreach ($countries as $key => $value) { ?>
                                                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="postal_code" class="form-label">Postal code</label>
                                                            <input type="text" class="form-control" placeholder="Enter your postal_code" name="postal_code">
                                                        </div>
                                                    </div>

                                                    <!--end col-->
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="password" class="form-label">Password <span style="color: red;">*</span></label>
                                                            <input type="password" class="form-control" placeholder="Enter your password" name="password">
                                                        </div>
                                                    </div>

                                                    <!--end col-->
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="confirm_password" class="form-label">Confirm Password <span style="color: red;">*</span></label>
                                                            <input type="password" class="form-control" placeholder="Enter your confirm password" name="confirm_password">
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
                                            <button type="submit" class="btn btn-success" name="add_user" id="add-btn">Add Customer</button>
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

    <!-- listjs init -->
    <script src="assets/js/pages/listjs.init.js"></script>

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