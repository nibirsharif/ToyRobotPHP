<?php

$ROWS = 4;
$COLS = 4;

$array = explode(",", $argv[2]);

$x = $array[0];
$y = $array[1];
$z = $array[2];

if (!isValidPosition($x, $y)) exit("Invalid position!");

$stdin = fopen('php://stdin', 'r');
$flag = false;

while (!$flag)
{
	$input = trim(fgets($stdin));

	if ($input == 'REPORT') $flag = true;
    
    switch($input) {
        case "MOVE":
            move($z);
            break;
        case "LEFT":
            $z = changeDirection($input, $z);
            break;
        case "RIGHT":
            $z = changeDirection($input, $z);
            break;
        default:
            break;
    }
}


function move($z) {
    global $x, $y;
    switch ($z) {
        case "NORTH":
            $y++;
            break;
        case "SOUTH":
            $y--;
            break;
        case "EAST":
            $x++;
            break;
        case "WEST":
            $x--;
            break;
        default:
            break;
    }

    if (!isValidMove($x, $y)) exit("Invalid move!");
}

function changeDirection($command, $z) {
    if ($command == "LEFT") {
        switch ($z) {
            case "NORTH":
                $z = "WEST";
                break;
            case "SOUTH":
                $z = "EAST";
                break;
            case "EAST":
                $z = "NORTH";
                break;
            case "WEST":
                $z = "SOUTH";
                break;
            default:
                break;
        }
    } else if ($command == "RIGHT") {
        switch ($z) {
            case "NORTH":
                $z = "EAST";
                break;
            case "SOUTH":
                $z = "WEST";
                break;
            case "EAST":
                $z = "SOUTH";
                break;
            case "WEST":
                $z = "NORTH";
                break;
            default:
                break;
        }
    }
    return $z;
}

function isValidMove($row, $col) {
    global $ROWS, $COLS;
    if (!($row >= 0 && $row <= $ROWS)) return false;
    else if (!($col >= 0 && $col <= $COLS)) return false;
    else return true;
}

function isValidPosition($row, $col) {
    global $ROWS, $COLS;
    return !($row > $ROWS || $row < 0 || $col > $COLS || $col < 0);
}

echo $x, ",", $y, ",", $z;

?>
