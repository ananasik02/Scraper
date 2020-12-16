<?php

class Parser
{
    public $html;

    public function __construct($html)
    {
        $this->html=$html;
    }
    public static function setParse($html)
    {
        $domDocument = new DOMDocument();
        @ $domDocument->loadHTML($html);
        $domXPath = new DOMXPath($domDocument);
        return $domXPath;
    }
}