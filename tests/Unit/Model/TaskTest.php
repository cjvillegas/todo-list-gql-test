<?php

namespace Tests\Unit\Model;

use App\Enums\Status;
use App\Models\Task;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        (new UserSeeder())->run();
    }

    /**
     * Test creating a task
     *
     * @return void
     */
    public function testCreateTask()
    {
        # prepare
        $data = [
            'title' => 'Task 1',
            'status' => Status::ACTIVE->value,
            'created_by_id' => User::first()->id
        ];

        # execute
        Task::create($data);

        # assert
        $this->assertDatabaseHas('tasks', $data);
    }

    /**
     * Test updating a task
     *
     * @return void
     */
    public function testUpdateTask()
    {
        # prepare
        $task = Task::create([
            'title' => 'Task 1',
            'status' => Status::ACTIVE->value,
            'created_by_id' => User::first()->id
        ]);

        # execute
        $task->update(['status' => Status::DONE->value]);

        # assert
        $this->assertDatabaseHas('tasks', [
            'title' => 'Task 1',
            'status' => Status::DONE->value
        ]);
    }

    /**
     * Test reading a task
     *
     * @return void
     */
    public function testReadTask()
    {
        # prepare
        $task = Task::create([
            'title' => 'Task 1',
            'status' => Status::ACTIVE->value,
            'created_by_id' => User::first()->id
        ]);

        # execute
        $foundTask = Task::find($task->id);

        # assert
        $this->assertEquals($task->title, $foundTask->title);
        $this->assertEquals($task->status, $foundTask->status);
    }

    /**
     * Test deleting a task
     *
     * @return void
     */
    public function testDeleteTask()
    {
        # prepare
        $task = Task::create([
            'title' => 'Task 1',
            'status' => Status::ACTIVE->value,
            'created_by_id' => User::first()->id
        ]);

        # execute
        $task->delete();

        # assert
        $this->assertSoftDeleted('tasks', [
            'title' => 'Task 1',
            'status' => Status::ACTIVE->value
        ]);
    }
}
