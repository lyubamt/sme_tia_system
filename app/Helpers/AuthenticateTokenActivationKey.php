<?php

namespace App\Helpers;
use App\Models\Item;
use App\Models\TokenActivationKey;
use Auth;

class AuthenticateTokenActivationKey{

    static function getAuthSaleItems(){

        $items = Item::with("user")->where("user_id",auth()->user()->id)->where("is_sale",1)->where("status",1)->where("is_deleted",0)->get();

        return $items;

    }

    static function getAuthPurchaseItems(){

        $items = Item::with("user")->where("user_id",auth()->user()->id)->where("is_purchase",1)->where("status",1)->where("is_deleted",0)->get();

        return $items;

    }
}
