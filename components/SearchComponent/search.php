<?php

require "./index.php";
require "../AvaluationComponent/index.php";

//get the q parameter from URL
$q=$_GET["q"];

$db = new PDO('sqlite:../../Database/database.db');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$stmt = $db->prepare('SELECT * FROM Restaurant');

$stmt->execute();

$items = $stmt->fetchAll();

//TODO: Search Algorithm

class Restaurant {
    private $item;
    private $points;

    public function __construct($item) {
        $this->item = $item;
        $this->points = 0;
    }

    public function addPoints($pts) {
        $this->points += $pts;
    }

    public function getPoints() {
        return $this->points;
    }

    public function getItem() {
        return $this->item;
    }
}

$hints = array();

for ($j = 0; $j < count($items); $j++) {
    $obj = new Restaurant($items[$j]);

    $stmt2 = $db->prepare('SELECT * FROM Menu_Item WHERE restaurantID = ' . $items[$j]["restaurantID"]);
    $stmt2->execute();

    $dishes = $stmt2->fetchAll();

    if (substr_compare($items[$j]["name"], $q, 0, strlen($q), true) == 0) {
        $obj->addPoints(15);
    }
    if (substr_compare($items[$j]["foodType"], $q, 0, strlen($q), true) == 0) {
        $obj->addPoints(3);
    }
    foreach ($dishes as $dish) {
        if (substr_compare($dish["nameMenuItem"], $q, 0, strlen($q), true) == 0) {
            $obj->addPoints(1);
        }
    }
    if ($obj->getPoints() > 0) {
        array_push($hints, $obj);
    }
}

function cmp($a, $b) {
    return strcmp($a->getPoints(), $b->getPoints());
}

usort($hints, "cmp");

$response = '';

if (count($hints) != 0) {
    for ($i = 0; $i < min(count($hints), 15); $i++) {
        $response .= getRestaurantSearchCard($hints[$i]->getItem());
    }
} else {
    $response = 'Sem resultados';
}
//output the response
echo $response;
//echo getSearchStars(3.5);
// echo json_encode($items[0])
?>