<?php
class Product {
  // Properties
  public $price;
  public $title;
  public $link;
  public $image;
  public $rating;
  public $storeName;
  public $reviews; 

  function set_price($p) {
    $this->price = $p;
  }
  function set_title($t) {
      $this->title = $t;
    }
    function set_link($l) {
      $this->link = $l;
    }
    function set_image($g) {
      $this->image = $g;
    }
    function set_rating($r) {
      $this->rating = $r;
    }
    function set_storeName($s) {
      $this->storeName = $s;
    }
    function set_reviews($r) {
      $this->reviews = $r;
    }

    function get_price() {
      return $this->price;
    }
    function get_title() {
      return $this->title;
    }
    function get_link() {
      return $this->link;
    }
    function get_image() {
      return $this->image;
    }
    function get_rating() {
      return $this->rating;
    }
    function get_storeName() {
      return $this->storeName;
    }
    function get_reviews() {
      return $this->reviews;
    }
   
}

  
  function SearchByKeywords($keywords,$text,$logo){
  include_once('Search.php');

  }

  function ExtractImageAtt($imageUri){
    include_once('by_image.php');
  
    }

    function GetSynonyms($keyword){
      include_once('Find_Syn.php');
    
      }

?>