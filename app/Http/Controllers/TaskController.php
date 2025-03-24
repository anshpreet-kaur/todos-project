<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TaskRequest;
use App\Models\Category;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Protect routes
    }

    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->get();
        return view('tasks.index', compact('tasks'));
    }
//     public function create()
// {
//     $tasks = Task::where('user_id', Auth::id())->get();
//     return view('tasks.create', compact('tasks'));
// }
public function create()
{
    $categories = Category::where('user_id', Auth::id())->get();
    $tasks = Task::where('user_id', Auth::id())->get();
    return view('tasks.create', compact('categories', 'tasks'));
}

public function store(TaskRequest $request)
{
    Task::create([
        'user_id' => Auth::id(),
        'title' => $request->title,
        'category_id' => $request->category_id,
        'parent_id' => $request->parent_id,
        'description' => $request->description,
        'status' => $request->status,
        'deadline' => $request->deadline,
        'type' => $request->type,
    ]);

    return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
}
public function edit(Task $task)
{
    if ($task->user_id !== Auth::id()) {
        abort(403); // Prevent unauthorized access
    }

    // Fetch all categories for the dropdown
    $categories = Category::where('user_id', Auth::id())->get();

    // Fetch all tasks except the current one to prevent self-referencing
    $tasks = Task::where('user_id', Auth::id())
        ->where('id', '!=', $task->id) // Exclude current task
        ->get();

    return view('tasks.edit', compact('task', 'categories', 'tasks'));
}



public function update(TaskRequest $request, Task $task)
{
    if ($task->user_id !== Auth::id()) {
        abort(403);
    }

    $task->update($request->all());

    return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
}

    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
