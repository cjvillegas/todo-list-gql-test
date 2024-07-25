<?php

namespace Tests\Unit\Model;

use App\Enums\Status;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

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
            'status' => Status::ACTIVE->value
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
            'status' => Status::ACTIVE->value
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
        $task = Task::create(['title' => 'Task 1', 'status' => Status::ACTIVE->value]);

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
        $task = Task::create(['title' => 'Task 1', 'status' => Status::ACTIVE->value]);

        # execute
        $task->delete();

        # assert
        $this->assertSoftDeleted('tasks', [
            'title' => 'Task 1',
            'status' => Status::ACTIVE->value
        ]);
    }
}
