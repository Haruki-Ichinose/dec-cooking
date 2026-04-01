<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Family;

class FamilyController extends Controller
{
    public function create_family(Request $request) {
        
        // バリデーション
        $messages = [
            'family_id.required' => '家族IDは必須です。',
            'family_id.integer' => '家族IDは整数である必要があります。',
            'family_id.unique' => 'この家族IDはすでに存在します。',
            'family_name.required' => '家族名は必須です。',
            'family_name.string' => '家族名は文字列である必要があります。',
            'family_name.max' => '家族名は255文字以内で入力してください。',
        ];

        $validatedData = $request->validate([
            'family_id' => 'required|integer|unique:families,id',
            'family_name' => 'required|string|max:255',
        ], $messages);


        // Familyテーブルにデータを保存
        $family = new Family;
        $family->id = $request->input('family_id');
        $family->family_name = $request->input('family_name');
        $family->save();

        // Userテーブルにfamily_idとfamily_nameを登録
        $auth = Auth::user()->id;
        $user = User::find($auth);
        $user->family_id = $request->input('family_id');
        $user->family_name = $request->input('family_name');
        $user->save();

        // そのfamily_idと一致するユーザーを取得
        $familyMembers = User::where('family_id', $request->input('family_id'))->get();

        // ビューにデータを渡して表示
        return view('home', ['users' => $familyMembers]);
    }


    public function showFamilyMembers() {
        // ログインユーザーのfamily_idを取得
        $family_id = Auth::user()->family_id;

        // そのfamily_idと一致するユーザーを取得
        $familyMembers = User::where('family_id', $family_id)->get();

        // ビューにデータを渡して表示
        return view('home', ['users' => $familyMembers]);
}

    public function participate(Request $request) {
        // Userテーブルにfamily_idを登録
        $auth = Auth::user()->id;
        $user = User::find($auth);
        $user->family_id = $request->input('family_id');
        $user->save();
        // そのfamily_idと一致するユーザーを取得
        $familyMembers = User::where('family_id', $request->input('family_id'))->get();

        // ビューにデータを渡して表示
        return view('home', ['users' => $familyMembers]);
    }
}
