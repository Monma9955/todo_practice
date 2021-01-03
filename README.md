# ToDoアプリ概要

## アプリ概要

フォルダーごとにタスクを作成・表示できるWebアプリ。
PHPとLaravelの最初の開発練習として[Hypertext Candy](https://www.hypertextcandy.com/laravel-tutorial-introduction)様のチュートリアルを基に作成しました。
2020/11/30〜作成開始。

## フォルダ(タスク)一覧イメージ画像

<img width="1053" alt="ToDo_App" src="https://user-images.githubusercontent.com/55307855/103459266-652bef80-4d51-11eb-9aa7-87dce515a83b.png">

## 開発環境

* 言語: PHP 7.4.9（MAMP）
* フレームワーク： Laravel 8.16.1
* その他使用技術： HTML(bladeテンプレート), CSS(bootstrap), Javascript
* 開発・テスト用DB： MySQL（phpMyAdmin）
* エディター：Visual Studio Code

## アプリ機能

### 実装済みの機能

* 選択済みフォルダーのタスク一覧表示（indexページ）
* フォルダー作成機能
* タスク作成機能（バリデーションテスト済み）
* タスク編集機能（バリデーションテスト済み）
* ユーザー登録・ログイン・ログアウト機能
* パスワード再設定機能
* ミドルウェアを使用した認可処理
* オリジナル403, 404, 500エラーページ表示

## 工夫した点

元のチュートリアルでは環境構築方法として Homestead と Laravel Valetを提案していますが、今回はPHPとLaravelの実践練習が目的だったので、なるべく環境構築を手早く済ませられるMAMPで用意しました。
上記の理由からデータベースはPostgreSQLではなくMAMPに用意されているMySQLを使用しており、Laravelもチュートリアルの5.7ではなく8.16のため、8.16に合った適切な実装方法を調べながら進めました。

## DB設計

### usersテーブル

|Column|Type|Options|
|------|----|-------|
|name|string(255)|null: false|
|email|string(255)|null: false|
|email_verified_at|timestamp||
|password|string(255)|null: false|
|remember_token|string(100)||

#### リレーション

* has_many :folders

### foldersテーブル

|Column|Type|Options|
|------|----|-------|
|user_id|bigint|null: false, foreign_key: true|
|title|string(20)|null: false|

#### リレーション

* has_many :tasks

### tasksテーブル

|Column|Type|Options|
|------|----|-------|
|folder_id|integer|null: false, foreign_key: true|
|title|string(100)|null: false|
|due_date|date|null: false|
|status|integer|null: false, default: 1|
