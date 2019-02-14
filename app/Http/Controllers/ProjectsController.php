<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Project;
use App\Repositories\ProjectsRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ProjectsController extends Controller
{
    protected $repo;

    public function __construct(ProjectsRepository $repo){
        $this->repo = $repo;
        $this->middleware('auth');
    }

    // create  增
    public function create()
    {
        //  show create form view
    }

    public function store(CreateProjectRequest $request)
    {
        $this->repo->create($request);
        return back();

    }

    // delete 删
    public function destroy(Project $project)
    {
        //Project::query()->findOrFail($id)->delete;
        $project->delete();
        return back();
    }

    //update 改
    public function edit()
    {
        //  show edit form view
    }

    public function update(UpdateProjectRequest $request, $id){
        $this->repo->update($request, $id);
        return back();
    }

    // show 查
    public function show(Project $project)
    {
        // return Carbon::createFromDate(1976,1,29)->age;
        // return Carbon::now()->subMinutes(8)->diffForHumans();

//        $project = $this->repo->find($id);
        $todos = $this->repo->todos($project);
        $dones = $this->repo->dones($project);
        $projects = request()->user()->projects()->pluck('name','id'); // pluck方法第一个参数为值，第二个参数为键
        //dd($projects);
        // $todoCount = $project->tasks()->where('completion',0)->count();
        // dd($todoCount);
        
        return view('projects.show',compact('project','todos','dones','projects'));
    }

    public function index()
    {
        $projects = $this->repo->listall();
//        $projects = request()->user()->projects()->get();

        return view('welcome',compact('projects'));
    }



}
