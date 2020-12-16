<?php

namespace App;

Class ShopItem{
    public $title;
    public $price;
    public $image;
    public $likes;

    public function __construct($itemInfo)
    {
        $this->likes = $itemInfo['likes'];
        $this->price = $itemInfo['price'];
        $this->title = $itemInfo['title'];
        $this->image = $itemInfo['image'];

        return $this;
    }

   public static function parseItemsInfo(\DOMXPath $domXPath, $elements)
   {
        $infoArray = array();
        if (!is_null($elements)) {
            foreach ($elements as $element) {
                $nodes = $element->childNodes;
                foreach ($nodes as $node) {
                    $data = trim($node->nodeValue);
                }
                $infoArray [] = $data;
            }
        }
        return $infoArray;
   }

   public static function getImages($response)
    {
        preg_match_all("/https:[^s]*?image-thumbs.shafastatic.net[^s]*?_310_430/", $response, $matches);
        $images = array();
        $matches = $matches[0];
        for($i=0; $i<count($matches); $i++){
            if($i%2 != 0){
                array_push($images, $matches[$i]);
            }
        }

        return $images;

    }

    public static function filterPrices($allPrices, $oldPrices)
    {
        for($i=0; $i<count($allPrices); $i++) {
            if (intval($allPrices[$i])!=0){
                if(array_search($allPrices[$i], $oldPrices, true) == false ){
                    $prices [] = intval($allPrices[$i]);
                }
            }
        }

        return $prices;
    }

    public static function filterLikes($parsedLikes)
    {
        $likes = array();
        for($i=0; $i<count($parsedLikes); $i++) {
            $likes [] = intval($parsedLikes[$i]);
        }
        return $likes;
    }

    public function toArray( )
    {
        return $itemInfo = [
            'likes' => $this->likes,
            'image' => $this->image,
            'title' => $this->title,
            'price' => $this->price
        ];

    }
}