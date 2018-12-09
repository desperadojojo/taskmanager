<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Project;
use App\Repositories\ProjectsRepository;
use Illuminate\Http\Request;


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
//        $project = $this->repo->find($id);
        $todos = $this->repo->todos($project);
        $dones = $this->repo->dones($project);
        return view('projects.show',compact('project','todos','dones'));
    }

    public function index()
    {
        $projects = $this->repo->listall();
//        $projects = request()->user()->projects()->get();

        return view('welcome',compact('projects'));
    }



}
