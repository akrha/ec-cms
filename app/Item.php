<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Item extends Model
{
    protected $table = 'items';

    public function getItemsByUserId(int $user_id) :?Collection
    {
        $result = Item::select(
            'items.*',
            'tags.name AS tag_name'
        )
        ->where('items.user_id', $user_id)
        ->leftJoin('item_tags', 'items.id', '=', 'item_tags.item_id')
        ->join('tags', 'items.user_id', '=', 'tags.user_id')
        ->get();

        return $result;
    }

    public function registerItem(
        int $user_id,
        string $name,
        string $description,
        int $price
    ) :void {
        $item = new Item;
        $item->user_id = $user_id;
        $item->item_name = $name;
        $item->description = $description;
        $item->price = $price;

        $item->save();
    }
}
