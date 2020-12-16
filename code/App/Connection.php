<?php

namespace App;

class Connection
{
    public $path;

    public function __construct($path)
    {
        $this->path=$path;
        return $this;
    }

    public static function setConnection($path)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $path);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        return $ch;
    }

    public function getConnection()
    {
        return curl_exec($this::setConnection($this->path));
    }

    public function closeConnection()
    {
        return curl_close($this::setConnection($this->path));
    }
}