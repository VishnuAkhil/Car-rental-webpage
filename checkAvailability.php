<?php
// get request parameter
$id = $_GET["id"];
// echo $id;
session_start();
// retrieve xml database
$xml = simplexml_load_file("carsXML.xml") or die("Error: Cannot create Object");
foreach ($xml->children() as $cars) {
    if (($id == $cars->id) && ("True" == $cars->availability)){
        // add item to shopping cart
        $carDetails = array(
            "Mileage" => (string) $cars->mileage,
            "FuelType" => (string) $cars->fuel_type,
            "Seats" => (string) $cars->seats,
            "Description" => (string) $cars->description,
            "Brand" => (string) $cars->brand,
            "Model" => (string) $cars->model,
            "Year" => (string) $cars->model_year,
            "PricePerDay" => (int) $cars->price_per_day,
            "RentalDays" => 1
        );
        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = array($id => $carDetails);

        } else if (!isset($_SESSION["cart"][$id])) {
            $_SESSION["cart"][$id] = $carDetails;
        }
        echo $cars->availability;
        return;
    }
}
?>
