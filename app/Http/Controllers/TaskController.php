<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class TaskController extends Controller
{
    public function index() {

        if(request('q') != null)
        {
            $tasks['data']= Task::where('name', 'LIKE', '%' . request('q') . '%') ->get();

            return response()->json($tasks);
        }
        else {
            $tasks = Task::orderBy('created_at', 'DESC')->paginate(5);
            return response()->json($tasks);
        }

    }

    public function store(Request $request) {
            $task=new Task();
            $task->name=$request->name;
            $task->save();

            return response()->json(['task' => $task]);
    }

    public function edit($id) 
    {
        $task=Task::find($id);
        
        return response()->json(['task' => $task]);
    }

    public function update(Request $request,$id) 
    {
        $task=Task::find($id);
        
        $task->name=$request->name;
        $task->save();

        return response()->json(['task' => $task]);
    }

    public function destroy($id) 
    {
        $task=Task::find($id);
        $task->delete();

        return response()->json(['task delete it']);
    }
}
