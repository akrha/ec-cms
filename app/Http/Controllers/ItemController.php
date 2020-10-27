<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     */
    public function index()
    {

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
