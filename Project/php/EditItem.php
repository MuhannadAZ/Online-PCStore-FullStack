<?php

function displayParts()
{
    $parts = getAllPartsFromDatabase();

?>
    <style>
        .buttons {
            position: absolute;
            top: 0;
            left: 0;
            margin: 10px;
        }

        .delete-button,
        .update-button {
            border-radius: 8px;
            margin-right: 120px;
            border: none;
            text-decoration: none;
            cursor: pointer;
        }

        .update-button:hover {
            color: #fff;
            background-color: #00994f;
            transition: ease-in all 0.5s;
        }

        .delete-button:hover {
            color: #fff;
            background-color: #8a0022;
            transition: ease-in all 0.5s;
        }

        .delete-button {
            background-color: #cc0032;
            transition: ease-in all 0.5s;
            color: #fff;
            padding: 8px 30px;
        }

        .update-button {
            background-color: #00c08f;
            transition: ease-in all 0.5s;
            color: #fff;
            padding: 8px 40px;
        }

        h3 {
            margin-top: 25px;
        }
    </style>
<?php
    echo '<div class="results" id="results">';
    foreach ($parts as $regularProduct) {
        echo '<div class="part" style="animation: fadeIn 0.5s ease-in-out;">';

        // Display the overall rating as filled stars
        $averageRating = getAverageRating($regularProduct['ID']);
        echo '<div class="rating">';
        echo generateStarIcons($averageRating);
        echo '</div>';

        echo '<h3>' . $regularProduct['name'] . '</h3>';
        echo '<img src="' . $regularProduct['logo'] . '" alt="' . $regularProduct['name'] . '">';
        echo '<div class="image-overlay">' . $regularProduct['price'] . ' SAR</div>';

        echo '<div class="buttons">';
        echo '<a class="delete-button" href="delete.php?id=' . $regularProduct['ID'] . '" onclick="return confirm(\'Are you sure you want to delete this item?\')">Delete</a>';
        echo '<a class="update-button" href="update.php?id=' . $regularProduct['ID'] . '">Edit</a>';
        echo '</div>';

        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
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

    $output .= "<span class='ratingText'>($rating)</span>";
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


function getAllPartsFromDatabase()
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

    $sql = "SELECT ID, name, logo, description, price, categoryID FROM Item";
    $result = $conn->query($sql);

    $parts = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $parts[] = $row;
        }
    }

    $conn->close();

    return $parts;
}

function getCategoryName($categoryID)
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

    $sql = "SELECT name FROM category WHERE ID = '$categoryID'";
    $result = $conn->query($sql);

    $categoryName = '';

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $categoryName = $row['name'];
    }

    $conn->close();

    return $categoryName;
}

// Example usage
displayParts();
