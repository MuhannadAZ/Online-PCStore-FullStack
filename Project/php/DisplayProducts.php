<?php

function displayParts()
{
    $parts = getAllPartsFromDatabase();

    $regularProducts = [];
    $readyPCs = [];

    // split Ready-PC from the result
    foreach ($parts as $part) {
        if ($part['categoryID'] == 7) {
            $readyPCs[] = $part;
        } else {
            $regularProducts[] = $part;
        }
    }

    // Display Regular Products
    echo '<div class="services">';
    echo '<div class="container">';
    echo '<div class="row">';
    echo '<div class="col-md-12">';
    echo '<div class="titlepage text_align_center">';
    echo '<h2>Products</h2>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '<div class="results" id="results">';
    foreach ($regularProducts as $regularProduct) {
        echo '<a href="item.php?id=' . $regularProduct['ID'] . '">';
        echo '<div class="part" style="animation: fadeIn 0.5s ease-in-out;">';
        // Display the overall rating as filled stars
        $averageRating = getAverageRating($regularProduct['ID']);
        echo '<div class="rating">';
        echo generateStarIcons($averageRating);
        echo '</div>';
        echo '<h3>' . $regularProduct['name'] . '</h3>';
        echo '<img src="' . $regularProduct['logo'] . '" alt="' . $regularProduct['name'] . '">';
        echo '<div class="image-overlay">' . $regularProduct['price'] . ' SAR</div>';
        echo '</div>';
        echo '</a>';
    }
    echo '</div>';
    echo '</div>';
    echo '</div>';

    // Display Ready-PCs
    echo '<div class="our_mics">';
    echo '<div class="container">';
    echo '<div class="row">';
    echo '<div class="col-md-10 offset-md-1">';
    echo '<div class="titlepage text_align_center">';
    echo '<h2>Ready-PCs</h2>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '<div class="results" id="ready-pcs">';
    foreach ($readyPCs as $readyPC) {
        echo '<a href="item.php?id=' . $readyPC['ID'] . '">';
        echo '<div class="part" style="animation: fadeIn 0.5s ease-in-out;">';
        // Display the overall rating as filled stars
        $averageRating = getAverageRating($readyPC['ID']);
        echo '<div class="rating">';
        echo generateStarIcons($averageRating);
        echo '</div>';
        echo '<h3>' . $readyPC['name'] . '</h3>';
        echo '<img src="' . $readyPC['logo'] . '" alt="' . $readyPC['name'] . '">';
        echo '<div class="image-overlay">' . $readyPC['price'] . ' SAR</div>';
        echo '</div>';
        echo '</a>';
    }
    echo '</div>';
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

    $output .= "<span class='ratingText'>($rating/5)</span>";
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

displayParts();
