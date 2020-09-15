<?php

class Calculate {

    function __construct($x1,$y1,$x2,$y2)
    {
        $this->x1 = $x1;
        $this->y1 = $y1;
        $this->x2 = $x2;
        $this->y2 = $y2;
    }

    private function XIsAlp() {
        if (!preg_match("/^[a-zA-Z]+$/",$this->x1) || !preg_match("/^[a-zA-Z]+$/",$this->x2)) {
            return false;
        } else {
            return true;
        }
    }

    private function YIsNum() {
        if (!is_numeric($this->y1) || !is_numeric($this->y2)) {
            return false;
        } else {
            return true;
        }
    }

    private function AlpToNum($letter) {
        $letter = strtolower($letter);
        $data = array(
            'a'=>1,
            'b'=>2,
            'c'=>3,
            'd'=>4,
            'e'=>5,
            'f'=>6,
            'g'=>7,
            'h'=>8,
            'i'=>9,
            'j'=>10,
            'k'=>11,
            'l'=>12,
            'm'=>13
        );
        if (array_key_exists($letter,$data)) {
            return $data["$letter"];
        } else {
            return false;
        }
    }

    private function LenLimit() {
        if (strlen($this->x1) ==1 &&strlen($this->y1) ==1 &&strlen($this->x2) ==1 &&strlen($this->y2) ==1 ){
            return true;
        } else {
            return false;
        }
    }

    private function AlertMessage($message) {
        echo "<script language='javascript' type='text/javascript'>";
        echo "window.location.href='index.php';";
        echo "alert('".$message."')";
        echo "</script>";
        exit;
    }

    private function XResult() {
        if ($this->x1 > $this->x2) {
            return $this->AlpToNum($this->x1) - $this->AlpToNum($this->x2);
        } else {
            return $this->AlpToNum($this->x2) - $this->AlpToNum($this->x1);
        }
    }

    private function YResult() {
        if ($this->y1 > $this->y2) {
            return $this->y1 - $this->y2;
        } else {
            return $this->y2 - $this->y1;
        }
    }

    function InputCheck() {
        if (!$this->YIsNum()) {
            $this->AlertMessage("Please check your Y input, which should be ONE number");
        } elseif(!$this->XIsAlp()) {
            $this->AlertMessage("Please check your X input, which should be ONE letter");
        } elseif (!$this->LenLimit()) {
            $this->AlertMessage("Please input only one letter or number in the input field");
        } elseif(!$this->AlpToNum($this->x1)||!$this->AlpToNum($this->x2)) {
            $this->AlertMessage("Please input the value that related to the map");
        }
    }


    function Total() {
        return $this->XResult() + $this->YResult();
    }
}