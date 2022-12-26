<?php

class Airport
{

    public $id;
    public $name;
    public $code;
    public $lat;
    public $lng;

    public function __construct($id, $name, $code, $lat, $lng)
    {
        $this->id = $id;
        $this->name = $name;
        $this->code = $code;
        $this->lat = $lat;
        $this->lng = $lng;
    }
}

class Flight
{
    public $code_departure;
    public $code_arrival;
    public $stopover;
    public $price;

    public function __construct($code_departure, $code_arrival, $stopover, $price)
    {
        $this->code_departure = $code_departure;
        $this->code_arrival = $code_arrival;
        $this->stopover = $stopover;
        $this->price = $price;
    }
}

$airportArray = [];

$napoliAirport = new Airport(
    '1',
    'Aeroporto Capodichino, Napoli, NA',
    'NAP',
    40.8839923,
    14.2845457
);

$amsterdamAirport = new Airport(
    '2',
    'Aeroporto di Amsterdam-Schiphol, Badhoevedorp, VM',
    'AMS',
    52.3269789,
    4.7415052
);


array_push($airportArray, $napoliAirport, $amsterdamAirport);

$flightsArray = [];

for ($i = 0; $i <= 10; $i++) {

    $flightObj = new Flight(
        'NAP ' . rand(1, 100),
        'AMS ' . rand(1, 100),
        $n_stopover = rand(0, 2),
        rand(20, 100)
    );
    array_push($flightsArray, $flightObj);
}



$prices = [];


foreach ($flightsArray as $flightPrice) {
    array_push($prices, $flightPrice->price);
}


$arraySize = count($prices);


for ($i = 0; $i < $arraySize; $i++) {

    for ($y = $i + 1; $y < $arraySize; $y++) {
        if ($prices[$i] > $prices[$y]) {
            $loopIndex = $prices[$i];
            $prices[$i] = $prices[$y];
            $prices[$y] = $loopIndex;
        }
    }
}


$bestPrice = $prices[0];


$flightLow = array_filter(
    $flightsArray,
    function ($flight) use ($bestPrice) {
        return $flight->price == $bestPrice;
    }
);


$codeDeparture;
$codeArrival;

foreach ($flightLow as $item) {
    $codeDeparture = $item->code_departure;
    $codeArrival = $item->code_arrival;
}


$depAirpName;
$arrAirpName;

foreach ($airportArray as $element) {
    if ($codeDeparture == strpos($codeDeparture, $element->code)) {
        $depAirpName = $element->name;
    } else {
        $arrAirpName = $element->name;
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>LT-CHALLENGE-PHP</title>
</head>

<body>
    <div class="container py-5">

        <!-- flight list -->
        <section>
            <div>
                <div>
                    <h1>Departures</h1>
                </div>
            </div>
            <div>
                <div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Partenza da</th>
                                <th scope="col">Codice di partenza</th>
                                <th scope="col">Arrivo a</th>
                                <th scope="col">Codice di arrivo</th>
                                <th scope="col">Scali</th>
                                <th scope="col">Prezzo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                foreach ($flightsArray as $singleFlight) {
                                ?>
                                    <td scope="row"> <?php echo $depAirpName ?></th>
                                    <td> <?php echo $singleFlight->code_departure ?></th>
                                    <td><?php echo $arrAirpName ?></td>
                                    <td><?php echo $singleFlight->code_arrival ?></td>
                                    <td><?php echo $singleFlight->stopover ?></td>
                                    <td><?php echo $singleFlight->price ?> &euro;</td>
                            </tr>
                        <?php
                                }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        

        <!-- best price -->
        <section>
            <div>
                <div>
                    <h1>Best Price</h1>
                </div>
            </div>
            <div>
                <div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Partenza da</th>
                                <th scope="col">Codice di partenza</th>
                                <th scope="col">Arrivo a</th>
                                <th scope="col">Codice di arrivo</th>
                                <th scope="col">Scali</th>
                                <th scope="col">Prezzo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                foreach ($flightLow as $flight) {
                                ?>
                                    <td scope="row"> <?php echo $depAirpName ?></th>
                                    <td><?php echo $flight->code_departure ?></td>
                                    <td><?php echo $arrAirpName ?></td>
                                    <td><?php echo $flight->code_arrival ?></td>
                                    <td><?php echo $singleFlight->stopover ?></td>
                                    <td><?php echo $flight->price ?> &euro;</td>
                            </tr>
                        <?php
                                }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </div>
</body>

</html>
