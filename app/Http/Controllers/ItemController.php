<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Item;
use App\Tag;
use App\Http\Requests\CreateItemRequest;

class ItemController extends Controller
{
    public function __construct(
        Item $item,
        Tag $tag
    ) {
        $this->middleware('auth');
        $this->item = $item;
        $this->tag = $tag;
    }

    /**
     * 商品一覧
     */
    public function index()
    {
        $user_id = Auth::id();
        $items = $this->item->getItemsByUserId($user_id);

        return view('item.list', [
            'items' => $items
        ]);
    }

    /**
     * 新規商品フォーム
     */
    public function createForm()
    {
        $user_id = Auth::id();

        return view('item.create', [
            'tags' => $this->tag->getTagsByUserId($user_id),
        ]);
    }

    /**
     * 新規商品登録実行
     */
    public function create(CreateItemRequest $request)
    {
        $user_id = Auth::id();

        $item_image1 = $request->hasFile('image1') ? $request->file('image1')->store('item_images') : null;
        if ($request->hasFile('image1')) {

            $item_image1 = $request->file('image1')->store('item_images');
            rename(storage_path('app/' . $item_image1) , public_path() . '/' . $item_image1);
        }

        try {
            $this->item->registerItem(
                $user_id,
                $request->name,
                $request->description,
                $request->price,
                $request->tags_selected,
                $item_image1
            );
            return redirect()->route('items.index');
        } catch (\Throwable $th) {
            abort('500', $th->getMessage());
        }
    }

    /**
     * 商品詳細
     */
    public function detail(int $item_id)
    {
        $user_id = Auth::id();

        $item = $this->item->getItemDetail($item_id, $user_id);

        if (is_null($item)) {
            abort('404', 'Item Not found');
        }

        return view('item.detail', [
            'item' => $item
        ]);
    }

    /**
     * 商品編集フォーム
     */
    public function updateForm(int $item_id)
    {
        $user_id = Auth::id();

        $item = $this->item->getItemDetail($item_id, $user_id);

        if (is_null($item)) {
            abort('404', 'Item Not found');
        }

        return view('item.update', [
            'item' => $item
        ]);
    }

    /**
     * 商品編集実行
     */
    public function update(CreateItemRequest $request)
    {
        $user_id = Auth::id();

        if ($this->item->updateItem(
            $user_id,
            $request->item_id,
            $request->name,
            $request->description,
            $request->price
        )) {
            return redirect()->route('items.index'); // TODO detailにリダイレクトする
        } else {
            abort('404', 'Item Not found');
        }
    }

    /**
     * 商品削除実行
     */
    public function destroy(int $item_id)
    {
        $user_id = Auth::id();

        if ($this->item->destroyItem(
            $user_id,
            $item_id
        )) {
            return redirect()->route('items.index');
        } else {
            abort(404);
        };
    }
}
