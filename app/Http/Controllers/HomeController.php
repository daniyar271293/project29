<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tasks = Task::all();
        // dd($tasks);
        return view('home', compact('tasks'));
    }

    public function store(Request $request)
    {
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => 0,
            'author_id' => auth()->user()->id 
        ]);
        return redirect()->route('home');
    }
    
    public function update($id)
    {
        $task = Task::find($id);
        $task->status = $task->status == 1 ? 0 : 1;
        $task->save ();
        return [
            'status' => $task->status
        ];
    }

    public function delete($id)
    {
        $task = Task::find($id);
        $task->delete();

        return redirect()->route('home');
    }

    public function show($id)
    {
        $task = Task::find($id);
        return view('show', ['task' => $task]);
    }
}
