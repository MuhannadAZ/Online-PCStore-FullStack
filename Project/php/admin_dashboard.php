<?php
session_start();

if (!isset($_SESSION["admin_username"])) {
    header("Location: adminLogin.php");
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
    <!-- Add Item -->
    <div class="contact left_cross_right">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage text_align_left">
                        <h2>Add Item</h2>
                        <hr>
                    </div>
                </div>
                <div class="col-md-12">
                    <form id="request" class="main_form" action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 ">
                                <input class="contactus" placeholder="Name:" type="text" name="Name" required>
                            </div>
                            <div class="col-md-12 ">
                                <input class="contactus" placeholder="Price:" type="number" name="Price" required>
                            </div>
                            <div class="col-md-12">
                                <textarea class="textarea" placeholder="Description:" name="Description" required></textarea>
                            </div>
                            <div class="col-md-12 ">
                                <input class="contactus" placeholder="CategoryID:" type="text" name="CategoryID" list="categories" oninput="this.value = this.value.replace(/[^0-9]/g, '')" pattern="\d*" required>

                                <datalist id="categories">
                                    <option value="1">Motherboard</option>
                                    <option value="2">CPU</option>
                                    <option value="3">GPU</option>
                                    <option value="4">RAM</option>
                                    <option value="5">Storage</option>
                                    <option value="6">Power Supply</option>
                                    <option value="7">ReadyPC</option>
                                </datalist>
                            </div>
                            <div class="col-md-12">
                                <input type="file" name="file" required>
                            </div>
                            <div class="col-md-12">
                                <button class="send_btn" name="Add">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    // File upload directory 

    if (isset($_POST["Add"])) {
        $targetDir = "../ProductImg/";
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
        if (!empty($_FILES["file"]["name"])) {
            $fileName = basename($_FILES["file"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            $Name = mysqli_real_escape_string($conn, $_POST['Name']);
            $Price = (float)mysqli_real_escape_string($conn, $_POST['Price']);
            $Description = mysqli_real_escape_string($conn, $_POST['Description']);
            $CategoryID = (int)mysqli_real_escape_string($conn, $_POST['CategoryID']);

            // Allow certain file formats 
            $allowTypes = array('jpg', 'png', 'jpeg');
            if (in_array($fileType, $allowTypes)) {
                // Upload file to server 
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                    // Insert image file name into database 
                    $sql = "INSERT INTO Item (name, logo, description, price, categoryID) 
                    VALUES ('$Name', '../ProductImg/$fileName', '$Description', '$Price', '$CategoryID')";
                    $insert = $conn->query($sql);
                    if ($insert) {
                        $statusMsg = "The Item has been Added successfully.";
                    } else {
                        $statusMsg = "File upload failed, please try again.";
                    }
                } else {
                    $statusMsg = "Sorry, there was an error uploading your file.";
                }
            } else {
                $statusMsg = 'Sorry, only JPG, JPEG, & PNG files are allowed to upload.';
            }
        } else {
            $statusMsg = 'Please select a file to upload.';
        }
        $conn->close();
        echo "<script>alert('" . $statusMsg . "')</script>";
    }
    ?>
    <!-- End Add Item -->
    <!-- Delete/Edit Item -->
    <div class="contact left_cross_right">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage text_align_left">
                        <h2>Delete/Edit Item</h2>
                        <hr>
                    </div>
                </div>
                <?php
                include 'EditItem.php';
                ?>
            </div>
        </div>
    </div>
    <!-- End Delete/Edit Item -->
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
    <!-- end footer -->
    <!-- Javascript files-->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.0.0.min.js"></script>
    <script src="../js/custom.js"></script>
</body>

</html>