<?php

namespace App\Repositories;

use App\DB\DB;
use App\ShopItem;
use App\User;
use PDO;

include  $_SERVER['DOCUMENT_ROOT'] . '/App/ShopItem.php';

class ShopRepository
{
    private $db;
    private $table = 'shopitems';

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function all(){
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        $itemsData = $stmt->fetchAll();
        $itemsCollection = $this->mapItems($itemsData) ;
        return $itemsCollection;
    }

    public function create(array $itemsInfo)
    {
        $sql = "INSERT INTO {$this->table} (title, likes, price, image)
                VALUES (:title, :likes, :price, :image)";

        $data = [
            ':title' => $itemsInfo['title'],
            ':likes' => $itemsInfo['likes'],
            ':price' => $itemsInfo['price'],
            ':image' => $itemsInfo['image']
        ];

        $this->db->query($sql, $data);

        $createdItemId = $this->db->getLastInsertedId();

        return $createdItemId;
    }

    private function mapItems(array $items)
    {
        $itemsCollection = [];
        foreach ($items as $item) {
            $itemsCollection[] = new ShopItem($item);
        }

        return $itemsCollection;
    }

}

