<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;
use App\Http\Resources\MemoResource;
class MemoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 1. データベースからデータを取得
        $memos = Memo::query() // クエリビルダを開始
        // ->where('user_id', auth()->id()) // 認証を再導入するならこの行を有効化
        ->latest()
            // ★★★ filterスコープを使って検索 ★★★
            ->filter($request->only('search'))
            ->get();

        return MemoResource::collection($memos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|string',
        ]);

        // 2. データベースに保存
        $memo = Memo::create($validatedData);

        return new MemoResource($memo);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Memo $memo)
    {
        $validatedData = $request->validate([
            'content' => 'required|string',
        ]);

        $memo->update($validatedData);

        return new MemoResource($memo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Memo $memo)
    {
        $memo->delete();

        // 成功したことを示すレスポンスを返す (204 No Content)
        return response()->noContent();
        //
    }
}
