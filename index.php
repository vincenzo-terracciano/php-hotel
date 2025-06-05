<?php

$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];

// controllo filtro parcheggio
$parking_requested = false;

if(isset($_GET["parking"]) && $_GET["parking"] == "on") {
    $parking_requested = true;
}


// controllo filtro voto
$minimum_vote = 0;

if (isset($_GET["minimum_vote"]) && is_numeric($_GET["minimum_vote"]) && $_GET["minimum_vote"] >= 0 && $_GET["minimum_vote"] <= 5) {
    $minimum_vote = (int)$_GET["minimum_vote"];
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php Hotel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">      
</head>
<body>

<div class="container">

    <h1 class="text-center">Hotels</h1>

    <h3>Filters</h3>

    <form action="">

    <div class="d-flex my-4">

        <div class="form-control">
            <input
                type="checkbox"
                name="parking"
                id="parking"
            />
            <label for="parking">Parking</label>

        </div>

        <div class="form-control">
            <input
                type="number"
                name="minimum_vote"
                id="minimum_vote"
                min="1"
                max="5"
            />
            <label for="minimum_vote">Minimum Vote</label>
        </div>

    </div>
        
        <button type="submit" class="btn btn-primary">Filter</button>
        

    </form>
    
    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Parking</th>
                <th>Vote</th>
                <th>Distance to center</th>
            </tr>
        </thead>
        <tbody>
           <?php
           
            foreach ($hotels as $hotel) {

                if ($parking_requested) {

                    if(!$hotel["parking"]) {

                        continue;

                    }
                }

                if ($hotel["vote"] < $minimum_vote) {
                    continue;
                }
    
           ?>
    
           <tr>
            <td><?php echo $hotel["name"] ?></td>
            <td><?php echo $hotel["description"] ?></td>
            <td>
                <?php 
                    echo $hotel["parking"] ? "presente" : "assente";
                ?>
            </td>
            <td><?php echo $hotel["vote"] ?></td>
            <td><?php echo $hotel["distance_to_center"] ?></td>
           </tr>
    
           <?php
           
            }
           
           ?>
        </tbody>
    </table>
</div>

</body>
</html>