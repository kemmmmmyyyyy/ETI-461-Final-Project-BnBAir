<?php
session_start();
include 'db.php';

$displayText = isset($_SESSION['user_name']) ? "Welcome " . htmlspecialchars($_SESSION['user_name']) . "!" : "BnB Air your home";

if (isset($_SESSION['user_name'])) {
    unset($_SESSION['user_name']);
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BnB Air</title>
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>
<body>

    <!-- Navbar -->
    <div class="h-screen">
        <div class="w-screen grid grid-cols-3 h-20 border-b-[1px] items-center fixed top-0 bg-white">
            <div class="pl-15">
                <a href="index.php">
                    <img src="static/airbnb-logo.png" class="h-16 w-auto" alt="Airbnb Clone Logo">
                </a>
            </div>

            <div class="px-8">
                <div class="flex items-center justify-evenly rounded-full shadow-md h-12 w-96 border">
                    <button class="border-r-2 border-gray-100 px-4 text-sm font-medium">Anywhere</button>
                    <button class="border-r-2 border-gray-100 px-4 text-sm font-medium">Any week</button>
                    <button class="border-gray-100 px-4 gray-text">Add guests</button>
                    <i class="fa-solid fa-magnifying-glass bg-red-500 text-white rounded-full p-2"></i>
                </div>
            </div>

            <div class="flex justify-end items-center pr-15 gap-8">
                <p class="text-sm font-medium"><?php echo $displayText; ?></p>
                <span class="material-symbols-outlined">language</span>
                <div class="flex gap-2">
                    <!-- Sign In Button -->
                    <div class="flex justify-center items-center py-1.25 px-3 rounded-full shadow-md h-10 w-10 border cursor-pointer" onclick="window.location.href='signin.php';">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <!-- Register Button -->
                    <div class="flex justify-center items-center py-1.25 px-3 bg-black text-white rounded-full shadow-md h-10 w-10 border cursor-pointer" onclick="window.location.href='register.html';">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category bar -->

        <div class="h-24 w-screen flex items-center space-x-5 fixed top-20 bg-white">
            <div class="flex items-center space-x-10 justify-center">
           
                <div class="category pl-15">
                    <img src="static/type1.jpeg" class="hotel-img"/>
                    <p class="category-text">Amazing pools</p>
                </div>
                <div class="category">
                    <img src="static/type2.jpeg" class="hotel-img"/>
                    <p class="category-text">Play</p>
                </div>
                <div class="category">
                    <img src="static/type3.jpeg" class="hotel-img"/>
                    <p class="category-text">Historical Homes</p>
                </div>
                <div class="category">
                    <img src="static/type4.jpeg" class="hotel-img"/>
                    <p class="category-text">Countryside</p>
                </div>
                <div class="category">
                    <img src="static/type5.jpeg" class="hotel-img"/>
                    <p class="category-text">Surfing</p>
                </div>
                <div class="category">
                    <img src="static/type6.jpeg" class="hotel-img"/>
                    <p class="category-text">Farms</p>
                </div>
                <div class="category">
                    <img src="static/type7.jpeg" class="hotel-img"/>
                    <p class="category-text">Amazing views</p>
                </div>
                <div class="category">
                    <img src="static/type8.jpeg" class="hotel-img"/>
                    <p class="category-text">Rooms</p>
                </div>
                <div class="category">
                    <img src="static/type9.jpeg" class="hotel-img"/>
                    <p class="category-text">Lakefront</p>
                </div>
                <div class="category">
                    <img src="static/type10.jpeg" class="hotel-img"/>
                    <p class="category-text">Beachfront</p>
                </div>
                <div class="category">
                    <img src="static/type11.jpeg" class="hotel-img"/>
                    <p class="category-text">OMG!</p>
                </div>
                <div class="category">
                    <img src="static/type12.jpeg" class="hotel-img"/>
                    <p class="category-text">Golfing</p>
                </div>
            </div>
            <span class="material-symbols-outlined pl-4">arrow_circle_right</span>
            <div class="flex justify-around items-center rounded-xl shadow-md h-12 w-24 border">
                <span class="material-symbols-outlined pl-2">sync_alt</span>   
                <p class="text-xs font-medium pr-2">Filters</p>
            </div>

        </div>

    
        <!-- Price bar -->
        <section class="flex justify-center w-screen mt-48">
            <div class="flex items-center justify-between rounded-xl p-4 border w-[600px] h-16">
                <div class="w-[460px] flex justify-start">
                    <p class="border-r-2 border-gray-100 pr-4 text-base font-medium">Display total price</p>
                    <p class="border-gray-100 text-base text-gray-400 pl-4">Includes all fees, before taxes</p>
                </div>
                <span class="material-symbols-outlined">toggle_on</span>
            </div>
        </section>



<!-- Hotels -->
<div class="mt-14 mx-10 w-screen">
<div class="grid grid-cols-4 gap-y-4">
    <?php
    include 'db.php';

    $query = "SELECT p.propertyID, p.photo, p.price, pa.propertyCity, pa.propertyState 
              FROM Property p 
              JOIN PropertyAddress pa ON p.propertyID = pa.propertyAddressID";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $rating = mt_rand(30, 50) / 10.0;  // Generates a random rating between 3.0 and 5.0

        echo '<a href="hotel_detail.php?id=' . $row['propertyID'] . '" class="hotel-listing-link">';
        echo '<div class="flex flex-col h-96 w-72">';

        echo '<img src="' . htmlspecialchars($row['photo']) . '" class="rounded-xl w-72 h-64">';
        echo '<div class="flex justify-between mt-2">';
        echo '<p class="text-sm font-medium">' . htmlspecialchars($row['propertyCity']) . ', ' . htmlspecialchars($row['propertyState']) . '</p>';
        echo '<div class="flex items-center">';

        // Display stars based on the random rating
        for ($i = 0; $i < floor($rating); $i++) {
            echo '<i class="fa-solid fa-star" style="color: gold;"></i>';
        }
        if ($rating - floor($rating) >= 0.5) {
            echo '<i class="fa-solid fa-star-half-stroke" style="color: gold;"></i>';
        }

        echo '<p class="text-sm font-light">' . $rating . '</p>';
        echo '</div>';
        echo '</div>';
        echo '<p class="gray-text">22-27 Jul</p>';
        echo '<p class="text-sm font-medium mt-2">$' . htmlspecialchars($row['price']) . ' per night</p>';

        echo '</div>';
        echo '</a>';
    }

    $conn->close();
    ?>
</div>

</div>

        <div id="authModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" onclick="closeModal(event)">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white" onclick="event.stopPropagation()">
                <div class="mt-3 text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                        <i class="fa-solid fa-user fa-inverse fa-lg"></i>
                    </div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Sign In or Register</h3>
                    <div class="mt-2 px-7 py-3">
                        <button onclick="window.location.href='signin.php'" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Sign In</button>
                        <button onclick="window.location.href='register.html'" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Register</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Footer -->
        <footer class="h-12 fixed bottom-0 w-screen bg-white flex justify-between items-center px-10">
                <div class="flex space-x-2 text-sm font-base">
                    <p>© 2024 BnB Air, Inc.</p>
                    <p>·</p>
                    <p>Privacy</p>
                    <p>·</p>
                    <p>Terms</p>
                    <p>·</p>
                    <p>Sitemap</p>
                    <p>·</p>
                    <p>Company details</p>
                </div>
                <div class="flex space-x-4 text-sm font-medium">
                    <span class="material-symbols-outlined">language</span>
                    <p>English(US)</p>
                    <p>$ USD</p>
                    <p>Support & resources</p>
                </div>
        </footer>
    </div>
</body>
</html>