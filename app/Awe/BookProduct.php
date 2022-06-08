<?php


namespace App\awe;


class BookProduct extends ShopProduct
{
    private $numPages;

    public function __construct(
        string $id,
        string $title,
        string $firstName,
        string $mainName,
        float $price,
        int $numPages
    )
    {

        parent::__construct(
            $id,
            $title,
            $firstName,
            $mainName,
            $price
        );
        $this->numPages = $numPages;
    }

    public function getNumberOfPages()
    {
        return $this->numPages;
    }
}
