<?php


namespace App\Awe;


class CdProduct extends ShopProduct
{
    private $playLength;

    public function __construct(
        string $id,
        string $title,
        string $firstName,
        string $mainName,
        float $price,
        int $playLength
    )
    {
        parent::__construct(
            $id,
            $title,
            $firstName,
            $mainName,
            $price
        );
        $this->playLength = $playLength;
    }

    public function getPlayLength()
    {
        return $this->playLength;
    }
}
