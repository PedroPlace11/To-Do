<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TaskController extends Controller
{
    // Para desenvolvimento, garante um usuário existente no banco.
    private function getUserId()
    {
        if (Auth::check()) {
            return Auth::id();
        }

        $devUser = User::firstOrCreate(
            ['email' => 'dev@todo.test'],
            [
                'name' => 'Dev User',
                'password' => Hash::make('password'),
            ]
        );

        return $devUser->id;
    }

    public function index(Request $request)
    {
        $query = Task::query();
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        if ($request->has('priority')) {
            $query->where('priority', $request->priority);
        }
        if ($request->has('due_date')) {
            $query->whereDate('due_date', $request->due_date);
        }
        $tasks = $query->where('user_id', $this->getUserId())->orderBy('due_date')->get();
        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:alta,media,baixa',
        ]);
        $validated['user_id'] = $this->getUserId();
        $validated['status'] = 'pendente';
        $task = Task::create($validated);
        return response()->json($task, 201);
    }

    public function show(Task $task)
    {
        if ($task->user_id !== $this->getUserId()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        return response()->json($task);
    }

    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== $this->getUserId()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'sometimes|required|in:alta,media,baixa',
            'status' => 'sometimes|required|in:pendente,concluida',
        ]);
        $task->update($validated);
        return response()->json($task);
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== $this->getUserId()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $task->delete();
        return response()->json(null, 204);
    }
}
