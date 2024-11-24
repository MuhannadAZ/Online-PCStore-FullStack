<?php
session_start();
if (isset($_SESSION["admin_username"])) {
   header("Location: admin_dashboard.php");
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

   <style>
      .container2 {
         display: flex;
         justify-content: center;
         align-items: center;
         height: 100vh;
         margin-top: -10%;
         margin-bottom: -10%;
      }

      form {
         width: 80%;
         /* Adjust the width as needed */
         max-width: 800px;
         /* Add max-width for responsiveness */
         padding: 30px;
         border: 1px solid #ccc;
         border-radius: 8px;
         background-color: white;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      label {
         display: block;
         margin-bottom: 10px;
      }

      input {
         width: 100%;
         padding: 12px;
         margin-bottom: 15px;
         box-sizing: border-box;
         border: 1px solid #ccc;
         border-radius: 5px;
         color: black;
      }

      button {
         background-color: #450274;
         color: white;
         max-width: 200px;
         height: 61px;
         line-height: 61px;
         width: 100%;
         font-size: 17px;
         text-align: center;
         font-weight: 500;
         border-radius: 10px;
         transition: ease-in all 0.5s;
         margin-top: 20px;
         margin: 0 auto;
         display: block;
      }

      button:hover {
         background-color: #99145B;
         transition: ease-in all 0.5s;
      }
   </style>
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
      <a class="active" href="AdminLogin.php">Login</a>
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
   <!-- login form -->
   <div class="container2">
      <form action="login_process.php" method="post">
         <label for="username">Username:</label>
         <input type="text" name="username" required><br>

         <label for="password">Password:</label>
         <input type="password" name="password" required><br>

         <button type="submit">Login</button>
      </form>
   </div>
   <!-- end login form -->
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