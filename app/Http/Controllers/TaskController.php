<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //Create index
    public function index(){
        $data['task'] = Task::orderBy('id','asc')->paginate(5); //จำกัดข้อมูลต่อหน้า
        
        return view('tasks.index', $data);
    }
    

    public function create(){
        return view('tasks.create');
    }

    // store
    public function store(Request $request){
        $request->validate([
            'work_type' => 'required',
            'work_name' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required',
            /*'created_at' => 'required',
            'updated_at' => 'required',*/
        ]);
        
        $task = new Task;
        $task->work_type = $request->work_type;
        $task->work_name = $request->work_name;
        $task->start_time = $request->start_time;
        $task->end_time = $request->end_time;
        $task->status = $request->status;
        /*$task->created_at = $request->created_at;
        $task->updated_at = $request->updated_at;*/
        $task->save();
        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }

    public function edit(Task $task){
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request , $id){
        $request->validate([
            'work_type' => 'required',
            'work_name' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required',
            /*'created_at' => 'required',*/
            /*'updated_at' => 'required',*/
        ]);
        $task = Task::find($id);
        $task->work_type = $request->work_type;
        $task->work_type = $request->work_type;
        $task->work_name = $request->work_name;
        $task->start_time = $request->start_time;
        $task->end_time = $request->end_time;
        $task->status = $request->status;
        /*$task->created_at = $request->created_at;*/
        /*$task->update_at = $request->update_at;*/
        $task->save();
        return redirect()->route('tasks.index')->with('success', 'Task Edit successfully');
    }

    public function destroy(Task $task){
        $task->delete();
        return redirect()->route('tasks.index')->with('success'.'Task Delete successfully');
    }


    public function filter(Request $request) //รับตัวแปรพวก name time data etc.
    {
        $select_date = $request->select_date;
        // $select_month = $request->select_month;
    
        $task = Task::query() // Initialize the query builder
            ->whereDate('created_at', $select_date)
            ->paginate();

        // if ($select_date) {
        //     $var->whereDate('created_at', '=', $select_date);
        // }
    
        // if ($select_month) {
        //     $var->whereYear('created_at', '=', date('Y', strtotime($select_month)))
        //           ->whereMonth('created_at', '=', date('m', strtotime($select_month)));  
        // }
        
        // $task = $var->paginate(5); // Retrieve the filtered tasks
        
        return view('tasks.index', compact('task'));
    }

    public function filter_month(Request $request) {

        $select_month = $request->select_month;

        $task = Task::query()
            ->whereYear('created_at', '=', date('Y', strtotime($select_month)))
            ->whereMonth('created_at', '=', date('m', strtotime($select_month)))
            ->paginate();

            $statusSummary = $task->groupBy('status')
                                  ->map->count();
                                //   ->paginate(5);
            
        return view('tasks.index', compact('task','statusSummary','select_month'));
    }

}
