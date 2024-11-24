<?php
// Retrieve the item ID from the URL
$itemID = isset($_GET['id']) ? $_GET['id'] : null;

// Check if the ID is valid
if ($itemID !== null) {
    // Fetch item details based on the item ID
    $itemDetails = getItemDetailsFromDatabase($itemID);

    // Display the item details
    if ($itemDetails) {
        $averageRating = getAverageRating($itemDetails['ID']);
        $reviews = getReviewsFromDatabase();
        echo '<br><br><section id="product-info">
        <div class="item-image-main" style="animation: fadeIn 0.5s ease-in-out;">
            <a href="' . $itemDetails['logo'] . '"><img src="' . $itemDetails['logo'] . '" alt="' . $itemDetails['name'] . '"></a>
        </div>

    <div class="item-info-parent">
        <!-- main info -->
        <div class="main-info">
            <h4>' . $itemDetails['name'] . '</h4>
            <div class="rating1">
            ' . generateStarIcons($averageRating) . '
            </div>
            <p>Price: <span id="price">' . $itemDetails['price'] . ' SAR</span></p>
            <div class="description">
                ' . $itemDetails['description'] . '
            </div>
        </div>
    </div>
</section>'; ?>
        <div class="services">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="titlepage text_align_center">
                            <h2>Reviews</h2>
                        </div>
                    </div>
                </div>
                <section id="testimonials">
                    <!-- testimonials-box-container -->
                    <div class="testimonial-box-container">
                        <?php $foundReview = false; // Variable to track whether a matching review is found
                        foreach ($reviews as $review) :
                            if ($itemDetails['ID'] == $review['item_id']) :
                                $foundReview = true; // Set to true if a matching review is found
                        ?>
                                <!-- testimonial-box -->
                                <div class="testimonial-box">
                                    <!-- box-top -->
                                    <div class="box-top">
                                        <!-- profile -->
                                        <div class="profile">
                                            <!-- profile-img -->
                                            <div class="profile-img">
                                                <img src="https://cdn.iconscout.com/icon/premium/png-512-thumb/saudi-man-5743211-4804032.png?f=webp&w=256" alt="Profile Image">
                                            </div>
                                            <!-- name-and-username -->
                                            <div class="name-user">
                                                <strong><?php echo $review['name']; ?></strong>
                                            </div>
                                        </div>
                                        <!-- reviews -->
                                        <div class="reviews">
                                            <?php
                                            $rating = $review['rating'];
                                            for ($i = 1; $i <= 5; $i++) {
                                                echo ($i <= $rating) ? '<span class="fa fa-star checked"></span>' : '<span class="fa fa-star"></span>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!-- client-comment -->
                                    <div class="client-comment">
                                        <p><?php echo $review['body']; ?></p>
                                    </div>
                                </div>
                            <?php endif;
                        endforeach;
                        // Check if no matching review is found
                        if (!$foundReview) :
                            ?>
                            <div class="no-review-found">
                                <p>No reviews found for this item.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>
                <div class="contact left_cross_right">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="titlepage text_align_left">
                                    <h2>Write a Review.</h2>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <form id="request" class="main_form" action="" method="post">
                                    <div class="row">
                                        <div class="rate">
                                            <input type="radio" id="star5" name="rate" value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rate" value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rate" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rate" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rate" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                        </div>
                                        <div class="col-md-12 ">
                                            <input class="contactus" placeholder="Name" type="type" name="Name" required>
                                        </div>
                                        <div class="col-md-12">
                                            <textarea class="textarea" placeholder="Comment" type="Message" name="Comment" required></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <button class="send_btn" name="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>

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

// Check if the form is submitted
if (isset($_POST['submit'])) {
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
    $name = mysqli_real_escape_string($conn, $_POST['Name']);
    $comment = mysqli_real_escape_string($conn, $_POST['Comment']);
    $rating = (int)$_POST['rate'];  // Ensure rating is an integer

    $item_id = $itemDetails['ID'];

    // Insert data into the Review table
    $sql = "INSERT INTO Review (item_id, name, body, rating) VALUES ('$item_id', '$name', '$comment', '$rating')";

    if ($conn->query($sql) === TRUE) {
        echo "";
    } else {
        echo "<script>alert('Error: " . $sql . "')</script>" . $conn->error;
    }


    $conn->close();
    echo "<script>location.replace(location.href.split('#')[0]);</script>";
}

function getReviewsFromDatabase()
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

    $sql = "SELECT item_id, name, body, rating FROM Review";
    $result = $conn->query($sql);

    $reviews = [];

    if ($result->num_rows > 0) {
        // Fetch reviews from the result
        while ($row = $result->fetch_assoc()) {
            $reviews[] = $row;
        }
    }

    $conn->close();

    return $reviews;
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

    $sql = "SELECT ID, name, logo, description, price FROM Item WHERE ID = '$itemID'";
    $result = $conn->query($sql);

    $itemDetails = null;

    if ($result->num_rows > 0) {
        $itemDetails = $result->fetch_assoc();
    }

    $conn->close();

    return $itemDetails;
}

function generateStarIcons($rating)
{
    $output = '';
    $fullStars = floor($rating);

    // Add filled stars
    for ($i = 1; $i <= $fullStars; $i++) {
        $output .= '<span class="fa fa-star checked"></span>'; // Filled star
    }

    // Add unfilled stars
    $unfilledStars = 5 - ceil($rating); // maximum of 5 stars
    for ($i = 1; $i <= $unfilledStars; $i++) {
        $output .= '<span class="fa fa-star"></span>'; // Unfilled star
    }

    return $output;
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
?>