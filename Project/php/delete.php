<?php
session_start();
if (!isset($_SESSION["admin_username"])) {
    header("Location: adminLogin.php");
    exit(); // Ensure that no further code is executed after the redirect
} else {
    $isAdminLoggedIn = isset($_SESSION['admin_username']);

    // Set the icon, text, and href based on login status
    $iconClass = $isAdminLoggedIn ? 'fa fa-dashboard' : 'fa fa-user';
    $linkText = $isAdminLoggedIn ? 'Dashboard' : 'Login';
    $linkHref = $isAdminLoggedIn ? 'admin_dashboard.php' : 'adminLogin.php';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>PC Wizard</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- responsive-->
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="stylesheet" href="../css/styles.css">
    <!-- awesome fontfamily -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!-- body -->

<body class="main-layout inner_page">
    <!-- loader  -->
    <div class="loader_bg">
        <div class="loader"><img src="../images/loading.gif" alt="" /></div>
    </div>
    <!-- end loader -->
    <div id="mySidepanel" class="sidepanel">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="../index.html">Home</a>
        <a href="products.php">Products</a>
        <a href="Building.php">Building</a>
        <a href="../about.html">About</a>
        <a class="active" href="<?php echo $linkHref; ?>"><?php echo $linkText; ?></a>
    </div>
    <!-- header -->
    <header>
        <!-- header inner -->
        <div class="head-top">
            <div class="container-fluid">
                <div class="row d_flex">
                    <div class="col-sm-3">
                        <div class="logo">
                            <a href="../index.html"><img src="../images/output-onlinepngtools.png" /></a>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <ul class="email text_align_right">
                            <li class="d_none">
                                <a href="<?php echo $linkHref; ?>">
                                    <i class="<?php echo $iconClass; ?>" aria-hidden="true"></i>
                                    <?php echo $linkText; ?>
                                </a>
                            </li>
                            <li> <button class="openbtn" onclick="openNav()"><img src="../images/menu_btn.png"></button></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- end header -->

    <?php
    // Retrieve the item ID from the URL
    $itemID = isset($_GET['id']) ? $_GET['id'] : null;

    // Check if the ID is valid
    if ($itemID !== null && is_numeric($itemID)) {
        $servername = "localhost";
        $username = "root";
        $password = "admin";
        $dbname = "company";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "DELETE FROM Item WHERE ID = $itemID";
        $conn->query($sql);

        if ($conn->affected_rows > 0) {
            echo "<script>alert('The Item has been deleted successfully.')</script>";
            echo "<script>window.location.href = 'admin_dashboard.php';</script>";
            exit(); // Ensure that no further code is executed after the redirect
        } else {
    ?>
            <section class="page_404">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 ">
                            <div class="col-sm-10 col-sm-offset-1  text-center">
                                <div class="four_zero_four_bg">
                                    <h1 class="text-center ">404</h1>


                                </div>

                                <div class="contant_box_404">
                                    <h3 class="h2">
                                        Look like you're lost
                                    </h3>

                                    <p>the page you are looking for not avaible!</p>

                                    <a href="../index.html" class="link_404">Go to Home</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        }

        $conn->close();
    } else {
        ?>
        <section class="page_404">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="col-sm-10 col-sm-offset-1  text-center">
                            <div class="four_zero_four_bg">
                                <h1 class="text-center ">404</h1>


                            </div>

                            <div class="contant_box_404">
                                <h3 class="h2">
                                    Look like you're lost
                                </h3>

                                <p>the page you are looking for not avaible!</p>

                                <a href="../index.html" class="link_404">Go to Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
    }

    ?>
    <!-- footer -->
    <footer>
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="Informa conta">
                            <h3>Adderess</h3>
                            <ul>
                                <li> Riyadh St, Al-Olaya
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="Informa conta">
                            <h3>Contact Us</h3>
                            <ul>
                                <li> <a href="Javascript:void(0)"> (+966) 501234567
                                    </a>
                                </li>
                                <li> <a href="Javascript:void(0)"> PcWizard@sm.imamu.edu.sa
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <ul class="social_icon text_align_center">
                            <br>
                        </ul>
                    </div>
                </div>
            </div>
    </footer>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.0.0.min.js"></script>
    <script src="../js/custom.js"></script>
</body>

</html>