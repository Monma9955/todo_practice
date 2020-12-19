# ToDoアプリ概要

## アプリ概要

フォルダーごとにタスクを作成・表示できるWebアプリ。
PHPとLaravelの最初の開発練習として[Hypertext Candy](https://www.hypertextcandy.com/laravel-tutorial-introduction)様のチュートリアルを基に作成しました。
2020/11/30〜作成開始。

## 開発環境

* 言語: PHP 7.4.9（MAMP）
* フレームワーク： Laravel 8.16.1
* 開発・テスト用DB： MySQL（phpMyAdmin）
* エディター：Visual Studio Code

## アプリ機能

### 実装済みの機能

* 選択済みフォルダーのタスク一覧表示（indexページ）
* フォルダー作成機能
* タスク作成機能（バリデーションテスト済み）
* タスク編集機能（バリデーションテスト済み）

### 未実装の機能

* 会員登録・ログイン機能
* パスワード再設定機能

## 工夫した点

元のチュートリアルでは環境構築方法として Homestead と Laravel Valetを提案していますが、今回はPHPとLaravelの実践練習が目的だったので、なるべく環境構築を手早く済ませられるMAMPで用意しました。
上記の理由からデータベースはPostgreSQLではなくMySQLを使用しており、Laravelもチュートリアルの5.7ではなく8.16のため、環境に合わせて適切な実装方法を確認しながら進めました。

## DB設計

### foldersテーブル

|Column|Type|Options|
|------|----|-------|
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
