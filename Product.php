<?php

namespace Product;

/**
 * Class Product
 *
 * @property-read string $shop
 * @property-read string $currency
 * @property string $title
 * @property float $price
 * @property float $purchasePrice
 * @property float $purchaseCurrency
 */
abstract class Product
{
    protected $shop = 'first_shop';
    protected $currency = 'RUB';
    protected $title;
    protected $price;
    protected $purchasePrice;
    protected $purchaseCurrency;

    /**
     * Product constructor.
     *
     * @param string $title
     * @param float $price
     * @param float $purchasePrice
     * @param string $purchaseCurrency
     */
    public function __construct($title, $price, $purchasePrice, $purchaseCurrency)
    {
        $this->title = $title;
        $this->price = $price;
        $this->purchasePrice = $purchasePrice;
        $this->purchaseCurrency = $purchaseCurrency;
    }


    /**
     * @param $name string The name of property of Product class
     *
     * @return mixed
     * @throws \Exception If the property doesn't exist
     */
    public function __get($name)
    {
        try {
            if (!property_exists('Product', $name)) {
                throw new \Exception("Call to nonexistent '$name' property");
            } else {
                return $this->$name;
            }
        } catch (\Exception $e) {
            print $e->getMessage();
        }
    }

    /**
     * @param string $name
     * @param mixed $value
     *
     * @return mixed
     * @throws \Exception If the property is readonly
     */
    public function __set($name, $value)
    {
        $readonlyProperties = ['shop', 'currency'];
        try {
            if (in_array($name, $readonlyProperties)) {
                throw new \Exception("Tried to set read-only '$name' property");
            } else {
                return $this->$name = $value;
            }
        } catch (\Exception $e) {
            print $e->getMessage();
        }
    }

    /**
     * Checks if an attribute value is null.
     *
     * @param string $property The property name.
     *
     * @return boolean If the attribute value is null.
     */
    public function __isset($property)
    {
        return isset($this->$property);
    }
}


