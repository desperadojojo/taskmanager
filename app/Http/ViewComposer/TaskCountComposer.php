<?php

namespace App\Http\ViewComposer;

use Illuminate\View\View;
use App\Repositories\TasksRepository;

class TaskCountComposer{

    protected $task;

    public function __construct(TasksRepository $task){
        $this->task = $task;
    }
    
    public function compose(View $view){
        if (auth()->user()) {
            $view->with([
                'total' => $this->task->totalCount(),
                'todoCount' => $this->task->todoCount(),
                'doneCount' => $this->task->doneCount()
            ]);
        }
        
    }
    
        
}