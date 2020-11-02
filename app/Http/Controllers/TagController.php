<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tag;
use App\Http\Requests\CreateTagRequest;


class TagController extends Controller
{
    public function __construct(Tag $tag)
    {
        $this->middleware('auth');
        $this->tag = $tag;
    }

    /**
     * タグ一覧
     */
    public function index()
    {
        $user_id = Auth::id();
        $tags = $this->tag->getTagsByUserId($user_id);

        return view('tag.list', [
            'tags' => $tags
        ]);
    }

    /**
     * 新規タグフォーム
     */
    public function createForm()
    {
        return view('tag.create');
    }

    /**
     * 新規タグ登録実行
     */
    public function create(CreateTagRequest $request)
    {
        $user_id = Auth::id();

        $this->tag->registerTag(
            $user_id,
            $request->name
        );
        try {
            return redirect()->route('tags.index');
        } catch (\Throwable $th) {
            abort('500', '登録失敗！');
        }
    }

    /**
     * タグ編集フォーム
     */
    public function updateForm(int $tag_id)
    {
        $user_id = Auth::id();

        $tag = $this->tag->getTagDetail($tag_id, $user_id);

        if (is_null($tag)) {
            abort('404', 'Tag Not found');
        }

        return view('tag.update', [
            'tag' => $tag
        ]);
    }

    /**
     * タグ編集実行
     */
    public function update(CreateTagRequest $request)
    {
        $user_id = Auth::id();

        if ($this->tag->updateTag(
            $user_id,
            $request->id,
            $request->name
        )) {
            return redirect()->route('tags.index'); // TODO detailにリダイレクトする
        } else {
            abort('404', 'Tag Not found');
        }
    }

    /**
     * タグ削除実行
     */
    public function destroy(int $tag_id)
    {
        $user_id = Auth::id();

        if ($this->tag->destroyTag(
            $user_id,
            $tag_id
        )) {
            return redirect()->route('tags.index');
        } else {
            abort(404);
        };
    }
}
