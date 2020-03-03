<?php

    class Vehicle {

        private $id;
        private $name;
        private $body;
        private $color;
        private $transmission;
        private $image;
        private $price;
        private $isReserved;

        public function __construct($id, $name, $body, $color, $transmission, $image, $price, $isReserved) {
            $this->id = $id;
            $this->name = $name;
            $this->body = $body;
            $this->color = $color;
            $this->transmission = $transmission;
            $this->image = $image;
            $this->price = $price;
            $this->isReserved = $isReserved;
        }
        
        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getName() {
            return $this->name;
        }

        public function setName($name) {
            $this->name = $name;
        }

        public function getBody() {
            return $this->body;
        }

        public function setBody($body) {
            $this->body = $body;
        }

        public function getColor() {
            return $this->color;
        }

        public function setColor($color) {
            $this->color = $color;
        }

        public function getTransmission() {
            return $this->transmission;
        }

        public function setTransmission($transmission) {
            $this->transmission = $transmission;
        }

        public function getImage() {
            return $this->image;
        }

        public function setImage($image) {
            $this->image = $image;
        }

        public function getPrice() {
            return $this->price;
        }

        public function setPrice($price) {
            $this->price = $price;
        }

        public function isReserved() {
            return $this->isReserved;
        }

        public function setReserved($isReserved) {
            $this->isReserved = $isReserved;
        }
    }

?>