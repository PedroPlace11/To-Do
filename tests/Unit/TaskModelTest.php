<?php

use App\Models\Task;
use App\Models\User;

test('task has fillable properties', function () {
    $user = User::factory()->create();
    $task = Task::create([
        'user_id' => $user->id,
        'title' => 'Test Task',
        'description' => 'Test Description',
        'due_date' => '2026-05-01',
        'priority' => 'alta',
        'status' => 'pendente'
    ]);
    
    $this->assertEquals('Test Task', $task->title);
    $this->assertEquals('alta', $task->priority);
    $this->assertEquals('pendente', $task->status);
});

test('task can be marked as completed', function () {
    $user = User::factory()->create();
    $task = Task::factory()->create(['user_id' => $user->id, 'status' => 'pendente']);
    
    $task->update(['status' => 'concluida']);
    
    $this->assertEquals('concluida', $task->fresh()->status);
});
