# ToDoアプリ概要

## 開発環境

* 言語: PHP 7.4.9（MAMP）
* フレームワーク： Laravel 8.16.1
* 開発・テスト用DB： MySQL（phpMyAdmin）

## アプリ機能

* 選択済みフォルダーのタスク一覧表示（indexページ）
* フォルダー作成機能
* タスク作成機能
* タスク編集機能

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
