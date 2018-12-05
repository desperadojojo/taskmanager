<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateProjectRequest;
use App\Project;
use App\Repositories\ProjectsRepository;
use Illuminate\Http\Request;


class ProjectsController extends Controller
{
    protected $repo;

    public function __construct(ProjectsRepository $repo){
        $this->repo = $repo;
    }

    public function store(CreateProjectRequest $request)
    {
        $this->repo->create($request);
        return back();

    }

    public function destroy(Project $project){
        //Project::query()->findOrFail($id)->delete;
        $project->delete();
        return back();
    }



}
