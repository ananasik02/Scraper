<?php

use App\Connection;
use App\ShopItem;

$connect = new Connection($path);
$response = $connect->getConnection();
$domXPath= Parser::setParse($response);

$statement="//span[contains(@class, 'b-tile-item__title')]";
$titles = ShopItem::parseItemsInfo($domXPath, $domXPath->query($statement));

$statement="//div[contains(@class, 'b-tile-item__price')]";
$allPrices = ShopItem::parseItemsInfo($domXPath, $domXPath->query($statement));
$statement="//div[contains(@class, 'b-tile-item__price-old')]";
$oldPrices=ShopItem::parseItemsInfo($domXPath, $domXPath->query($statement));
$prices = ShopItem::filterPrices($allPrices, $oldPrices);

$statement="//span[contains(@class, 'b-favorite__counter')]";
$parsedLikes=ShopItem::parseItemsInfo($domXPath, $domXPath->query($statement));
$likes = ShopItem::filterLikes($parsedLikes);

$images=ShopItem::getImages($response);

for($i=0; $i<count($likes); $i++){
    $itemInfo = [
        'likes' => $likes[$i],
        'title' => $titles[$i],
        'image' => $images[$i],
        'price' => $prices[$i]
    ];

    $shopRep->create($itemInfo);

}

$goods = $shopRep->all();

$connect->closeConnection();

require $_SERVER['DOCUMENT_ROOT'] . '/App/partials/view.php';