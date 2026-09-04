# AGENTS.md

このファイルは AI エージェント（Claude Code / Codex）がこの repository を扱うときの指針である。
`CLAUDE.md` は本ファイルへのリダイレクトなので、**指針の追記・変更は本ファイルに対して行う。**

## 位置づけ

`dec-cooking` は **FamSync**（家族のスケジュール共有・日常調整アプリ）へ作り替える途中である。
料理・レシピ・献立は**もう主題ではない**。既存コードは家族運用の基盤として流用する。

**`plan.md` が方針の正本である。** `README.md` は Laravel のデフォルトや
DEC 課題提出時のまま残っている場合があるので、実装方針は必ず `plan.md` を読む。

## 技術構成

- PHP `^8.1` / Laravel `^10.10`
- Blade + Vite + Tailwind CSS
- Auth: Laravel Breeze
- ローカル開発: Docker Compose（Laravel Sail 前提）

### ⚠️ ローカル環境の注意

**このマシンの PHP は 8.5.9 で、`composer.lock` は 8.3 以下を前提にしている。**
そのため `composer install` がローカルの PHP で通らない。
Sail / Docker 経由でコンテナ内の PHP を使うこと。

```bash
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan test
./vendor/bin/sail npm run dev
```

## 主要ディレクトリ

| パス | 内容 |
|---|---|
| `app/Http/Controllers` | 機能ごとのコントローラ |
| `app/Models` | Eloquent モデル |
| `app/Services` | ドメインサービス |
| `resources/views` | Blade テンプレート |
| `routes/web.php` | 画面ルーティング |
| `database/migrations` | テーブル定義 |
| `database/seeders` | デモ用シードデータ |
| `tests/Feature` | 機能テスト |

## Deployment Policy

**ポートフォリオのデモであり、正式公開のサービスではない。**

- レビュアーが操作できるデモ環境を用意する
- シードした demo データを使う
- 公開する場合、実ユーザーの投稿・入力は無効化するか明確に制限する
- モデレーションを保証する公開コミュニティとして位置づけない

## 規約

- `.env` はコミットしない（`.env.example` を更新する）
- `vendor/` `node_modules/` は追跡しない
- `.DS_Store` は `.gitignore` に入っていないため untracked に出る。commit しない


## commit message

`種別：日本語の説明`（コロンは**全角**）。Conventional Commits に準拠する。
種別が異なる変更は commit を分ける。
**Claude / Codex の署名 trailer（`Co-Authored-By` 等）は付けない。**
