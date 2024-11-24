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
    if ($itemID !== null) {
        // Fetch item details based on the item ID
        $itemDetails = getItemDetailsFromDatabase($itemID);

        // Display the item details
        if ($itemDetails) {
    ?>
            <!-- Add Item -->
            <div class="contact left_cross_right">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="titlepage text_align_left">
                                <h2>Edit Item</h2>
                                <hr>
                            </div>
                        </div>
                        <section id="product-info">
                            <div class="item-image-main2" style="animation: fadeIn 0.5s ease-in-out;">
                                <a href="<?php echo $itemDetails['logo'] ?>"><img src="<?php echo $itemDetails['logo'] ?>" alt="<?php echo $itemDetails['name'] ?>"></a>
                            </div>
                        </section>
                        <div class="col-md-12">
                            <form id="request" class="main_form" action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <input class="contactus" placeholder="Name:" type="text" name="Name" value="<?php echo $itemDetails['name'] ?>">
                                    </div>
                                    <div class="col-md-12 ">
                                        <input class="contactus" placeholder="Price:" type="number" name="Price" value="<?php echo $itemDetails['price'] ?>">
                                    </div>
                                    <div class="col-md-12">
                                        <textarea class="textarea" placeholder="Description:" name="Description"><?php echo $itemDetails['description']; ?></textarea>
                                    </div>
                                    <div class="col-md-12 ">
                                        <input class="contactus" placeholder="CategoryID:" type="text" name="CategoryID" list="categories" oninput="this.value = this.value.replace(/[^0-9]/g, '')" pattern="\d*" value="<?php echo $itemDetails['categoryID'] ?>">

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
                                        <input type="file" name="file">
                                    </div>
                                    <div class="col-md-12">
                                        <button class="send_btn" name="Edit" onclick="return confirm('Are you sure you want to edit this item?')">Edit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>

        <?php
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
<?php

// Check if the form is submitted
if (isset($_POST["Edit"])) {
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
                // Update item data 
                $sql = "UPDATE Item
                SET name='$Name', logo='../ProductImg/$fileName', description='$Description', price='$Price', categoryID='$CategoryID' WHERE ID=$itemDetails[ID]";
                $insert = $conn->query($sql);
                if ($insert) {
                    $statusMsg = "The Item has been Edited successfully.";
                } else {
                    $statusMsg = "Item update failed, please try again.";
                }
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, & PNG files are allowed to upload.';
        }
    } else {
        if (empty($_FILES["file"]["name"])) {
            $Name = mysqli_real_escape_string($conn, $_POST['Name']);
            $Price = (float)mysqli_real_escape_string($conn, $_POST['Price']);
            $Description = mysqli_real_escape_string($conn, $_POST['Description']);
            $CategoryID = (int)mysqli_real_escape_string($conn, $_POST['CategoryID']);

            $sql = "UPDATE Item
                    SET name='$Name', logo='$itemDetails[logo]', description='$Description', price='$Price', categoryID='$CategoryID' WHERE ID=$itemDetails[ID]";
            $insert = $conn->query($sql);
            if ($insert) {
                $statusMsg = "The Item has been Edited successfully.";
            } else {
                $statusMsg = "Item update failed, please try again.";
            }
        }
    }
    $conn->close();
    echo "<script>alert('" . $statusMsg . "')</script>";
    echo "<script>window.location.href = 'update.php?id=" . $itemID . "';</script>";
}



function getItemDetailsFromDatabase($itemID)
{
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

    $sql = "SELECT ID, name, logo, description, price, categoryID FROM Item WHERE ID = '$itemID'";
    $result = $conn->query($sql);

    $itemDetails = null;

    if ($result->num_rows > 0) {
        $itemDetails = $result->fetch_assoc();
    }

    $conn->close();

    return $itemDetails;
}

?>