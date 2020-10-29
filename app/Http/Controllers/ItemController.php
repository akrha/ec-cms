<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Item;
use App\Http\Requests\CreateItemRequest;

class ItemController extends Controller
{
    public function __construct(Item $item)
    {
        $this->middleware('auth');
        $this->item = $item;
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
        return view('item.create');
    }

    /**
     * 新規商品登録実行
     */
    public function create(CreateItemRequest $request)
    {
        $user_id = Auth::id();

        try {
            $this->item->registerItem(
                $user_id,
                $request->name,
                $request->description,
                $request->price
            );
            return redirect()->route('items.index');
        } catch (\Throwable $th) {
            abort('500', '登録失敗！');
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
