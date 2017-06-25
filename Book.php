<?php

namespace Book;

use Product\Product;

require_once 'Product.php';

/**
 * Class Book
 *
 * @property string $author
 * @property array $data The array contains information about book
 * (for example, amount of pages, year of publications...)
 */
class Book extends Product
{
    protected $author;
    protected $bookData;

    /**
     * Book constructor.
     *
     * @param string $title
     * @param float $purchasePrice
     * @param string $purchaseCurrency
     * @param string $author
     * @param array $bookData
     */
    public function __construct($title, $purchasePrice, $purchaseCurrency, $author, $bookData = null)
    {
        $this->bookData = $bookData;
        $this->author = $author;
        $this->price = $this->getPrice($purchasePrice, $purchaseCurrency);
        parent::__construct($title, $this->price, $purchasePrice, $purchaseCurrency);
    }

    /**
     * Presents book's data as a JSON.
     *
     * @param array $bookData The array with information about book.
     *
     * @return string JSON
     */
    public function getJsonBookData($bookData)
    {
        // Change null to empty string.
        array_walk($bookData, function (&$item) {
            $item=strval($item);
        });
        return json_encode($bookData);
    }

    /**
     * The function for calculation price from purchase price.
     *
     * @param float $purchasePrice
     * @param string $purchaseCurrency
     *
     * @return string JSON
     *
     */
    public function getPrice($purchasePrice, $purchaseCurrency)
    {
        $percent  = $purchasePrice/100*25;
        if ($purchaseCurrency == 'USD') {
            $price = ($purchasePrice + $percent ) * 60;
        } else {
            $price = ($purchasePrice + $percent);
        }
        return round($price, 2);
    }
}


