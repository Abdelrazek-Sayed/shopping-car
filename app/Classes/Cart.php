<?php

namespace App\Classes;

class Cart
{

    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id)
    {
        $storedItem = [
            'qty' => 0,
            'price' => $item->price,
            'item' => $item
        ];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->price;
    }



    public function remove($id)
    {

        if (array_key_exists($id, $this->items)) {
            $this->totalQty -= $this->items[$id]['qty'];
            $this->totalPrice -= $this->items[$id]['qty'] * $this->items[$id]['price'];
            unset($this->items[$id]);
        }
    }

    public function updateQty($id, $qty)
    {

        //reset qty and price in the cart ,
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'] * $this->items[$id]['qty'];
        // add the item with new qty
        $this->items[$id]['qty'] = $qty;

        // total price and total qty in cart
        $this->totalQty += $qty;
        $this->totalPrice += $this->items[$id]['price'] * $qty;
    }
}
