<?php

namespace Tests\Feature;

use App\Http\Requests\CreateTask;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Carbon\Carbon;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // テストケースごとにデータベースをリフレッシュしてマイグレーションを再実行する
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // テストケース実行前にフォルダデータを作成する
        $this->seed('FoldersTableSeeder');
    }

    /**
     * 期限日が未入力の場合はバリデーションエラー
     * @test
     */
    public function due_date_should()
    {
        $response = $this->post('/folders/1/tasks/create', [
            'title' => 'Sample task',
            'due_date' => "", //未入力
        ]);

        $response->assertSessionHasErrors([
            'due_date' => '期限日 は必須入力です。',
        ]);
    }

    /**
     * 期限日が日付ではない場合はバリデーションエラー
     * @test
     */
    public function due_date_should_be_date()
    {
        $response = $this->post('/folders/1/tasks/create', [
            'title' => 'Sample task',
            'due_date' => 123, //不正なデータ(数値)
        ]);

        $response->assertSessionHasErrors([
            'due_date' => '期限日 には日付を入力してください。',
        ]);
    }

    /**
     * 期限日が過去日付の場合はバリデーションエラー
     * @test
     */
    public function due_date_should_note_be_past()
    {
        $response = $this->post('/folders/1/tasks/create', [
            'title' => 'Sample task',
            'due_date' => Carbon::yesterday()->format('Y/m/d'), //不正なデータ(昨日の日付)
        ]);

        $response->assertSessionHasErrors([
            'due_date' => '期限日 には今日以降の日付を入力してください。',
        ]);
    }
}
