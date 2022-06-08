<?php


namespace App\Awe;


class JsonUtility
{
    public static function makeProductArray(string $file) {
        $string = file_get_contents($file);

        $productsJson = json_decode($string, true);

        $products = [];
        foreach ($productsJson as $product) {
            switch($product['type']) {
                case "cd":
                    $cdproduct = new CdProduct($product['id'],$product['title'],  $product['firstname'],
                        $product['mainname'],$product['price'], $product['playlength']);
                    $products[] = $cdproduct;
                    break;
                case "book":
                    $bookproduct = new BookProduct($product['id'],$product['title'],  $product['firstname'],
                        $product['mainname'],$product['price'], $product['numpages']);
                    $products[]=$bookproduct;
                    break;
            }
        }
        return $products;
    }

    public static function deleteProductWithId(string $file, int $id) {
        $string = file_get_contents($file);

        $productsJson = json_decode($string, true);

        $products = [];
        foreach ($productsJson as $product) {
            if($product['id'] != $id) {
                $products[] = $product;
            }
        }
        $json = json_encode($products);
        if(file_put_contents($file, $json))
            return true;
        else
            return false;
    }

    public static function getProductWithId(string $file, int $id) {
        $string = file_get_contents($file);

        $productsJson = json_decode($string, true);

        $products = [];
        foreach ($productsJson as $product) {
            if($product['id']==$id) {
                switch ($product['type']) {
                    case "cd":
                        $cdproduct = new CdProduct($product['id'], $product['title'],  $product['firstname'],
                            $product['mainname'], $product['price'], $product['playlength']);
                        $products[] = $cdproduct;
                        break;
                    case "book":
                        $bookproduct = new BookProduct($product['id'], $product['title'],  $product['firstname'],
                            $product['mainname'], $product['price'], $product['numpages']);
                        $products[] = $bookproduct;
                        break;
                }
                break;
            }
        }
        return $products;
    }

    public static function addNewProduct(string $file, string $producttype, string $title, string $fname, string $sname, float $price, int $pages)
    {
        $string = file_get_contents($file);

        $productsJson = json_decode($string, true);

        $ids = [];
        foreach ($productsJson as $product) {
             $ids[] = $product['id'];
        }
        rsort($ids);
        $newId = $ids[0] + 1;

        $products = [];
        foreach ($productsJson as $product) {
            $products[] = $product;
        }

        $newProduct = [];
        $newProduct['id'] = $newId;
        $newProduct['type'] = $producttype;
        $newProduct['title'] = $title;
        $newProduct['firstname'] = $fname;
        $newProduct['mainname'] = $sname;
        $newProduct['price'] = $price;

        if($producttype=='cd') $newProduct['playlength'] = $pages;
        if($producttype=='book') $newProduct['numpages'] = $pages;

        $products[] = $newProduct;

        $json = json_encode($products);
        if(file_put_contents($file, $json))
            return true;
        else
            return false;
    }

    public static function updateProductWithId(string $file, int $id, string $title, string $fname, string $sname, float $price, int $pages)
    {
        $string = file_get_contents($file);
        $products= [];
        $productsJson = json_decode($string, true);

        foreach ($productsJson as $product) {
            if($product['id']==$id) {
                $product['title'] = $title;
                $product['firstname'] = $fname;
                $product['mainname'] = $sname;
                $product['price'] = $price;
                if($product['type']=='cd') $product['playlength'] = $pages;
                if($product['type']=='book') $product['numpages'] = $pages;
            }
            $products[] = $product;
        }

        $json = json_encode($products);
        if(file_put_contents($file, $json))
            return true;
        else
            return false;
    }
}
