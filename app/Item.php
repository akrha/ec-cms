<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\ItemTag;

class Item extends Model
{
    protected $table = 'items';

    public function getItemsByUserId(int $user_id) :?Collection
    {
        $result = Item::select('items.*')
        ->where('items.user_id', $user_id)
        ->get();

        return $result;
    }

    public function registerItem(
        int $user_id,
        string $name,
        string $description,
        int $price,
        ?array $tags_selected,
        ?string $item_image1
    ) :void {
        $item = new Item;
        $item->user_id = $user_id;
        $item->item_name = $name;
        $item->description = $description;
        $item->price = $price;
        $item->photo_url = $item_image1;

        $item->save();

        if (!is_null($tags_selected)) {
            foreach ($tags_selected as $tag_id) {
                ItemTag::insert([
                    'user_id' => $user_id,
                    'item_id' => $item->id,
                    'tag_id' => $tag_id
                ]);
            }
        }
    }

    public function getItemDetail(int $item_id, int $user_id) :?Item
    {
        $item = Item::select('items.*')
        ->where('items.user_id', $user_id)
        ->where('items.id', $item_id)
        ->first();

        return $item;
    }

    public function updateItem(
        int $user_id,
        int $item_id,
        string $name,
        string $description,
        int $price
    ) :int {
        return Item::where([
            'user_id' => $user_id,
            'id' => $item_id
        ])
        ->update([
            'item_name' => $name,
            'description' => $description,
            'price' => $price
        ]);
    }

    public function destroyItem(
        int $user_id,
        int $item_id
    ) :int {
        return Item::where([
            'user_id' => $user_id,
            'id' => $item_id
        ])
        ->delete();
    }

    public function getItemTags($item_id) :?Collection
    {
        $item_tags = ItemTag::select(
            'tags.id',
            'tags.name'
        )
        ->leftJoin('tags', 'tags.id', '=', 'item_tags.tag_id')
        ->where('item_tags.item_id', '=', $item_id)
        ->get();

        return $item_tags;
    }
}
