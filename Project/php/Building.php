<?php
session_start();
$isAdminLoggedIn = isset($_SESSION['admin_username']);

// Set the icon, text, and href based on login status
$iconClass = $isAdminLoggedIn ? 'fa fa-dashboard' : 'fa fa-user';
$linkText = $isAdminLoggedIn ? 'Dashboard' : 'Login';
$linkHref = $isAdminLoggedIn ? 'admin_dashboard.php' : 'adminLogin.php';
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
      <a class="active" href="Building.php">Building</a>
      <a href="../about.html">About</a>
      <a href="<?php echo $linkHref; ?>"><?php echo $linkText; ?></a>
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
   <!-- PC Building -->
   <div class="services">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage text_align_center">
                  <h2>PC Building</h2>
                  <p>Welcome to Our PC Builder - Crafting Your Dream Machine Together!<br>let's create a machine that meets your price-performance requirements</p>
               </div>
            </div>
         </div>
         <form id="request" class="main_form" action="" method="post">
            <div class="row">
               <div class="col-md-12 ">
                  <input class="contactus" placeholder="Budget" min="4000" type="number" name="Budget" required>
               </div>
               <div class="col-md-12">
                  <button class="send_btn" name="submitB">Find Parts</button>
               </div>
            </div>
         </form>
         <div class="results" id="results">
            <?php
            if (isset($_POST['submitB'])) {
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

               // Escape user inputs to prevent SQL injection
               $Budget = (int)mysqli_real_escape_string($conn, $_POST['Budget']);
               if ($Budget && $Budget > 3000) {
                  if ($Budget >= 6000 && $Budget < 10000) {
                     $sql = 'SELECT * FROM Item WHERE ID IN (3, 6, 9, 11, 1, 13)'; // Replace the IDs with the actual IDs for this budget range
                  } elseif ($Budget >= 10000) {
                     $sql = 'SELECT * FROM Item WHERE ID IN (4, 7, 9, 11, 1, 13)'; // Replace the IDs with the actual IDs for this budget range
                  } else {
                     $sql = 'SELECT * FROM Item WHERE ID IN (5, 8, 9, 11, 2, 14)'; // Replace the IDs with the actual IDs for this budget range
                  }

                  $result = $conn->query($sql);

                  $items = [];
                  if ($result->num_rows > 0) {
                     while ($row = $result->fetch_assoc()) {
                        $items[] = $row;
                     }

                     foreach ($items as $item) {
                        echo '<a href="item.php?id=' . $item['ID'] . '">';
                        echo '<div class="part" style="animation: fadeIn 0.5s ease-in-out;">';
                        // Display the overall rating as filled stars
                        $averageRating = getAverageRating($item['ID']);
                        echo '<div class="rating">';
                        echo generateStarIcons($averageRating);
                        echo '</div>';
                        echo '<h3>' . $item['name'] . '</h3>';
                        echo '<img src="' . $item['logo'] . '" alt="' . $item['name'] . '">';
                        echo '<div class="image-overlay">' . $item['price'] . ' SAR</div>';
                        echo '</div>';
                        echo '</a>';
                     }
                  }
               } else {
                  echo "<script>inputField.classList.add('error');
                  resultsDiv.innerHTML = '';
                  setTimeout(() => {
                      inputField.classList.remove('error');
                  }, 1000);</script>";
               }


               $conn->close();
            }

            function getAverageRating($itemId)
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

               // query to get the average rating
               $sql = "SELECT AVG(rating) AS overall_rating FROM Review WHERE item_id = '$itemId'";
               $result = $conn->query($sql);

               $averageRating = 0;

               if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  // Check if the overall_rating is not null
                  if ($row['overall_rating'] !== null) {
                     $averageRating = round($row['overall_rating']);
                  }
               }

               $conn->close();

               return $averageRating;
            }

            function generateStarIcons($rating)
            {
               $output = '';
               $fullStars = floor($rating);
               $fractionalPart = $rating - $fullStars;

               // Add filled stars
               for ($i = 1; $i <= $fullStars; $i++) {
                  $output .= '<span class="fa fa-star checked"></span>'; // Filled star
               }

               // Add unfilled stars
               $unfilledStars = 5 - ceil($rating); // maximum of 5 stars
               for ($i = 1; $i <= $unfilledStars; $i++) {
                  $output .= '<span class="fa fa-star"></span>'; // Unfilled star
               }

               $output .= "<span class='ratingText'>($rating/5)</span>";
               return $output;
            }
            ?>
         </div>
      </div>
   </div>
   <div class="our_mics">
      <div class="container">
         <div class="row">
            <div class="col-md-10 offset-md-1">
               <div class="titlepage text_align_center">
                  <h2>Our Clients builds</h2>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-4 col-sm-6 margin_bottom40">
               <div id="ho_show" class="mics">
                  <figure><img class="img_responsive" src="../images/mics_img1.jpg" alt="#" /></figure>
                  <div class="mics_icon">
                     <a href="javascript:void(0)">
                        <i class="fa fa-search" aria-hidden="true"></i>
                     </a>
                  </div>
               </div>
            </div>
            <div class="col-md-4 col-sm-6 margin_bottom40">
               <div id="ho_show" class="mics">
                  <figure><img class="img_responsive" src="../images/mics_img2.jpg" alt="#" /></figure>
                  <div class="mics_icon">
                     <a href="javascript:void(0)">
                        <i class="fa fa-search" aria-hidden="true"></i>
                     </a>
                  </div>
               </div>
            </div>
            <div class="col-md-4 col-sm-6 margin_bottom40">
               <div id="ho_show" class="mics">
                  <figure><img class="img_responsive" src="../images/mics_img3.jpg" alt="#" /></figure>
                  <div class="mics_icon">
                     <a href="javascript:void(0)">
                        <i class="fa fa-search" aria-hidden="true"></i>
                     </a>
                  </div>
               </div>
            </div>
            <div class="col-md-4 col-sm-6 margin_bottom40">
               <div id="ho_show" class="mics">
                  <figure><img class="img_responsive" src="../images/mics_img4.jpg" alt="#" /></figure>
                  <div class="mics_icon">
                     <a href="javascript:void(0)">
                        <i class="fa fa-search" aria-hidden="true"></i>
                     </a>
                  </div>
               </div>
            </div>
            <div class="col-md-4 col-sm-6 margin_bottom40">
               <div id="ho_show" class="mics">
                  <figure><img class="img_responsive" src="../images/mics_img5.jpg" alt="#" /></figure>
                  <div class="mics_icon">
                     <a href="javascript:void(0)">
                        <i class="fa fa-search" aria-hidden="true"></i>
                     </a>
                  </div>
               </div>
            </div>
            <div class="col-md-4 col-sm-6 margin_bottom40">
               <div id="ho_show" class="mics">
                  <figure><img class="img_responsive" src="../images/mics_img6.jpg" alt="#" /></figure>
                  <div class="mics_icon">
                     <a href="javascript:void(0)">
                        <i class="fa fa-search" aria-hidden="true"></i>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end PC Building -->
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