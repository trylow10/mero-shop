<?php


namespace App\Awe;


class ShopProduct
{
    private $id;
    private $title;
    private $mainName;
    private $firstName;
    protected $price;

    public function __construct(
        string $id,
        string $title,
        string $firstName,
        string $mainName,
        float $price
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->firstName = $firstName;
        $this->mainName = $mainName;
        $this->price = $price;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getMainName()
    {
        return $this->mainName;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getPrice()
    {
        return ($this->price);
    }

    public function getFullName()
    {
        return $this->firstName . " " . $this->mainName;
    }
}
