<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Tag extends Model
{
    protected $table = 'tags';
    public $timestamps = false;

    public function getTagsByUserId(int $user_id) :?Collection
    {
        $result = Tag::select(
            'tags.*'
        )
        ->where('tags.user_id', $user_id)
        ->get();

        return $result;
    }

    public function registerTag(
        int $user_id,
        string $name
    ) :void {
        $tag = new Tag;
        $tag->user_id = $user_id;
        $tag->name = $name;

        $tag->save();
    }

    public function getTagDetail(int $tag_id, int $user_id) :?Tag
    {
        $result = Tag::select(
            'tags.*'
        )
        ->where('tags.user_id', $user_id)
        ->where('tags.id', $tag_id)
        ->first();

        return $result;
    }

    public function updateTag(
        int $user_id,
        int $tag_id,
        string $name
    ) :int {
        return Tag::where([
            'user_id' => $user_id,
            'id' => $tag_id
        ])
        ->update([
            'name' => $name
        ]);
    }

    public function destroyTag(
        int $user_id,
        int $tag_id
    ) :int {
        return Tag::where([
            'user_id' => $user_id,
            'id' => $tag_id
        ])
        ->delete();
    }
}
