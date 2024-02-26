<?php

namespace App\Models;

Class OnlineCart
{
    public $items = [];
    public $totalPrice = 0;
    public $totalQuantity = 0;

    public function __construct(){
        $this->items = session('cart') ? session('cart') : [];
        $this->totalPrice = $this->getPriceTotal();
        $this->totalQuantity = $this->getQuantityTotal();
    }

    public function add($product){
        if(isset($this->items[$product->id])) {
            $this->items[$product->id]->quantity += 1;
        }
        else {
            $cart_items = (object)[
                'id'=> $product->id,
                'name'=> $product->name,
                'price'=> $product->price,
                'image'=> $product->image,
                'quantity'=> 1
            ];
            $this->items[$product->id] = $cart_items; 
        }
        
        session(['cart' => $this->items]);
    }

    public function delete($id){
        if (isset($this->items[$id])){
            unset($this->items[$id]);
            session(['cart' => $this->items]);
        }
    }

    private function getQuantityTotal(){
        $total = 0;
        foreach($this->items as $item) {
            $total += $item->quantity;
        }
        return $total;
    }

    private function getPriceTotal(){
        $total = 0;
        foreach($this->items as $item) {
            $total += $item->price * $item->quantity;
        }
        return $total;
    }
}

