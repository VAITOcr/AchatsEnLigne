<?php

class Article {
    public $id;
    public $name;
    public $description;
    public $price;
    public $photo;
    public $featured;
    public $rating;
    public $categorie;

    public function __construct($id, $name, $description, $price, $photo,$categorie, $featured = 'N', $rating = 0) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->photo = $photo;
        $this->featured = $featured;
        $this->rating = $rating;
        $this->categorie = $categorie;
    }

    public function getID() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }
    public function getDescription() {
        return $this->description;
    }
    public function getPrice() {
        return $this->price;
    }

    public function getPhoto() {
        return $this->photo;
    }
    public function getFeatured() {
        return $this->featured;
    }
    public function getRating() {
        return $this->rating;
    }
    public function getCategorie() {
        return $this->categorie;
    }

    public function setFeatured($featured) {
        $this->featured = $featured;
    }
    public function setRating($rating) {
        $this->rating = $rating;
    }
    public function setCategorie($categorie) {
        $this->categorie = $categorie;
    }
    public function setPhoto($photo) {
        $this->photo = $photo;
    }
    public function setID($id) {
        $this->id = $id;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function setDescription($description) {
        $this->description = $description;
    }
    public function setPrice($price) {
        $this->price = $price;
    }
}


?>