<?php

const NUM_KUMALAKS = 9;
const DRAW_GAME = NUM_KUMALAKS * NUM_KUMALAKS;
const TOTAL_KUMALAKS = DRAW_GAME * 2;
const TUZD = -1;

class TogyzBoard {
    private $finished = false;
    private $gameResult = -2;
    private $fields = [];
    private $moves = [];

    function __construct() {
        for ($i = 0; $i < 23; $i++) {
            if ($i < 18) {
                array_push($this->fields, NUM_KUMALAKS);
            } else {
                array_push($this->fields, 0);
            }
        }
    }

    function printNotation() {
        $notation = "";
        for ($i = 0; $i < count($this->moves); $i++) {
            if ($i % 2 == 0) {
                $notation = $notation . ($i / 2 + 1) . ". " . $this->moves[$i];
            } else {
                $notation = $notation . " " . $this->moves[$i] . "\n";
            }
        }

        return $notation;
    }

    function printPosition() {
        $position = str_pad($this->fields[21], 6, " ", STR_PAD_LEFT);
        for ($i = 17; $i > 8; $i--) {
            if ($this->fields[$i] == TUZD) {
                $position = $position . str_pad("X", 4, " ",STR_PAD_LEFT);
            } else {
                $position = $position . str_pad($this->fields[$i], 4, " ",STR_PAD_LEFT);
            }
        }

        $position = $position . "\n      ";

        for ($j = 0; $j < 9; $j++) {
            if ($this->fields[$j] == TUZD) {
                $position = $position . str_pad("X", 4, " ",STR_PAD_LEFT);
            } else {
                $position = $position . str_pad($this->fields[$j], 4, " ",STR_PAD_LEFT);
            }
        }

        $position = $position . str_pad($this->fields[20], 6, " ", STR_PAD_LEFT);
        return $position;
    }

    function checkPosition() {
        $color = $this->fields[22];
        $numWhite = 0;
        for ($i = 0; $i < 9; $i++) {
            if ($this->fields[$i] > 0) {
                $numWhite += $this->fields[$i];
            }
        }

        $numBlack = TOTAL_KUMALAKS - $numWhite - $this->fields[20] - $this->fields[21];

        if (($color == 0) && ($numWhite == 0)) {
            $this->fields[21] += $numBlack;
        } else if (($color == 1) && ($numBlack == 0)) {
            $this->fields[20] += $numWhite;
        }

        if ($this->fields[20] > DRAW_GAME) {
            $this->finished = true;
            $this->gameResult = 1;
        } elseif ($this->fields[21] > DRAW_GAME) {
            $this->finished = true;
            $this->gameResult = -1;
        } elseif (($this->fields[20] == DRAW_GAME) && ($this->fields[21] == DRAW_GAME)) {
            $this->finished = true;
            $this->gameResult = 0;
        }
    }

    function makeMove($move) {
        $tuzdCaptured = false;
        $color = $this->fields[22];
        $madeMove = strval($move);

        $move = $move + ($color * 9) - 1;
        $num = $this->fields[$move];

        if (($num == 0) || ($num == TUZD)) {
            echo "Incorrect move!";
            return "";
        }

        if ($num == 1)
        {
            $this->fields[$move] = 0;
            $sow = 1;
        }
        else
        {
            $this->fields[$move] = 1;
            $sow = $num - 1;
        }

        $num = $move;
        for ($i = 1; $i <= $sow; $i++) {
            $num += 1;
            if ($num > 17) {
                $num = 0;
            }

            if ($this->fields[$num] == TUZD) {
                if ($num < 9) {
                    $this->fields[21] += 1;
                } else {
                    $this->fields[20] += 1;
                }
            } else {
                $this->fields[$num] += 1;
            }
        }

        if ($this->fields[$num] % 2 == 0) {
            if (($color == 0) && ($num > 8)) {
                $this->fields[20] += $this->fields[$num];
                $this->fields[$num] = 0;
            } elseif (($color == 1) && ($num < 9)) {
                $this->fields[21] += $this->fields[$num];
                $this->fields[$num] = 0;
            }
        } elseif ($this->fields[$num] == 3) {
            if (($color == 0) && ($this->fields[18] == 0) && ($num > 8) && ($num < 17) && ($this->fields[19] != $num - 8)) {
                $this->fields[18] = $num - 8;
                $this->fields[$num] = TUZD;
                $this->fields[20] += 3;
                $tuzdCaptured = true;
            } elseif (($color == 1) && ($this->fields[19] == 0) && ($num < 8) && ($this->fields[18] != $num + 1)) {
                $this->fields[19] = $num + 1;
                $this->fields[$num] = TUZD;
                $this->fields[21] += 3;
                $tuzdCaptured = true;
            }
        }

        $this->fields[22] = ($color == 0) ? 1 : 0;

        if ($num < 9)
        {
            $num = $num + 1;
        }
        else
        {
            $num = $num - 8;
        }

        $madeMove = $madeMove . $num;
        if ($tuzdCaptured)
        {
            $madeMove = $madeMove . "x";
        }

        array_push($this->moves, $madeMove);
        $this->checkPosition();
        return $madeMove;
    }

    function isGameFinished() {
        return $this->finished;
    }

    function getScore() {
        return $this->fields[20] . " - " . $this->fields[21];
    }

    function getResult() {
        return $this->gameResult;
    }

}