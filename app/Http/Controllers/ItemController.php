<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Item;

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
    }

    /**
     * 新規商品登録実行
     */
    public function create()
    {
    }

    /**
     * 商品詳細
     */
    public function detail()
    {
    }

    /**
     * 商品編集フォーム
     */
    public function updateForm()
    {
    }

    /**
     * 商品編集実行
     */
    public function update()
    {
    }

    /**
     * 商品削除実行
     */
    public function destroy()
    {
    }
}
