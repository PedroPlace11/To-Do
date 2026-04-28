<?php

use App\Models\Task;
use App\Models\User;

test('user can fetch their tasks', function () {
    $user = User::factory()->create();
    $task = Task::factory()->create(['user_id' => $user->id]);
    
    $response = $this->actingAs($user)->getJson('/tasks');
    
    $response->assertOk()
        ->assertJsonFragment(['title' => $task->title]);
});

test('user cannot fetch other users tasks', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $task = Task::factory()->create(['user_id' => $user2->id]);
    
    $response = $this->actingAs($user1)->getJson('/tasks');
    
    $response->assertOk();
    $response->assertJsonMissing(['title' => $task->title]);
});

test('user can create a task', function () {
    $user = User::factory()->create();
    
    $response = $this->actingAs($user)->postJson('/tasks', [
        'title' => 'Nova Tarefa',
        'description' => 'Descrição teste',
        'priority' => 'alta',
        'due_date' => '2026-05-01'
    ]);
    
    $response->assertCreated()
        ->assertJsonFragment(['title' => 'Nova Tarefa']);
    
    $this->assertDatabaseHas('tasks', ['title' => 'Nova Tarefa', 'user_id' => $user->id]);
});

test('user can update their task', function () {
    $user = User::factory()->create();
    $task = Task::factory()->create(['user_id' => $user->id]);
    
    $response = $this->actingAs($user)->putJson("/tasks/{$task->id}", [
        'title' => 'Tarefa Atualizada',
        'status' => 'concluida'
    ]);
    
    $response->assertOk();
    $this->assertDatabaseHas('tasks', ['id' => $task->id, 'title' => 'Tarefa Atualizada', 'status' => 'concluida']);
});

test('user can delete their task', function () {
    $user = User::factory()->create();
    $task = Task::factory()->create(['user_id' => $user->id]);
    
    $response = $this->actingAs($user)->deleteJson("/tasks/{$task->id}");
    
    $response->assertNoContent();
    $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
});

test('task creation requires valid data', function () {
    $user = User::factory()->create();
    
    $response = $this->actingAs($user)->postJson('/tasks', [
        'description' => 'Descrição sem título'
    ]);
    
    $response->assertUnprocessable();
});
