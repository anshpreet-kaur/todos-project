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

    // public function index()
    // {
    //     $tasks = Task::where('user_id', Auth::id())->get();
    //     return view('tasks.index', compact('tasks'));
    // }
    public function index(Request $request)
{
    $query = Task::with(['category', 'parent', 'children'])->where('user_id', Auth::id());

    // Filtering
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    // Sorting
    $sort = $request->get('sort', 'deadline');
    $order = $request->get('order', 'asc');
    $query->orderBy($sort, $order);

    $tasks = $query->get();
    $categories = Category::where('user_id', Auth::id())->get();

    return view('tasks.index', compact('tasks', 'categories'));
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


public function destroy($id)
{
    $task = Task::where('user_id', auth()->id())->findOrFail($id);
    $task->delete(); // ✅ Soft delete the task

    return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
}

public function restore($id)
{
    $task = Task::onlyTrashed()->where('user_id', auth()->id())->findOrFail($id);
    $task->restore(); // ✅ Restore the task

    return redirect()->route('tasks.index')->with('success', 'Task restored successfully.');
}
public function trashed()
{
    // To display deleted tasks with restore and permanent delete options
    $tasks = Task::onlyTrashed()->where('user_id', auth()->id())->get();
    return view('tasks.trashed', compact('tasks'));
}
public function forceDelete($id)
{
    $task = Task::onlyTrashed()->where('user_id', auth()->id())->findOrFail($id);
    $task->forceDelete(); // ✅ Permanently delete

    return redirect()->route('tasks.index')->with('success', 'Task permanently deleted.');
}

}
