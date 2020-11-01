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

        foreach ($tags_selected as $tag_id) {
            ItemTag::insert([
                'user_id' => $user_id,
                'item_id' => $item->id,
                'tag_id' => $tag_id
            ]);
        }

    }

    public function getItemDetail(int $item_id, int $user_id) :?Item
    {
        $result = Item::select(
            'items.*',
            'tags.id AS tag_id',
            'tags.name AS tag_name' //TODO: タグが複数ある時、1つしかタグが取得されないバグがある。別途タグを取得するように変更する
        )
        ->where('items.user_id', $user_id)
        ->where('items.id', $item_id)
        ->leftJoin('item_tags', 'items.id', '=', 'item_tags.item_id')
        ->join('tags', 'items.user_id', '=', 'tags.user_id')
        ->first();

        return $result;
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
}
