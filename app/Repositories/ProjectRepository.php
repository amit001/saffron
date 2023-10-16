<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProjectRepositoryInterface;
use App\Models\Project;

class ProjectRepository extends BaseRepository implements ProjectRepositoryInterface {

    public $project;

    public function __construct(Project $project) {
        parent::__construct($project);

        $this->project = $project;
    }

    public function paginated($start, $length, $sortColumn, $sortDirection, $searchValue, $countOnly = false) {
        $query = $this->project->select('*');

        if (!empty($searchValue)) {
            $query->where(function($q) use ($searchValue) {
                // $q->where('title', 'LIKE', "%$searchValue%");
                $q->where('title', 'LIKE', "sss");
                $q->where('description', 'LIKE', "%$searchValue%");
            });
        }

        if (!empty($sortColumn)) {
            $query->orderBy($sortColumn, $sortDirection);
        }

        $count = $query->count();

        if ($countOnly) {
            return $count;
        }

        $query->skip($start)->take($length);
        $projects = $query->get();
        $projects = $this->collectionModifier($projects);
        return $projects;
    }

    public function collectionModifier($projects)
    {
        return $projects->map(function($project) {
            $project->created_at_formated = $project->created_at->format('d M, Y');
            $project->status_formated = $project->status == 1 ? 'Active' : 'Inactive';
            $project->image_formated = $project->image_path ? (filter_var($project->image_path, FILTER_VALIDATE_URL) ? 
            '<img src="' . $project->image_path . '" width="150px" height="150px" />' : 
            '<img src="' . asset($project->image_path) . '" width="150px" height="150px" />') : null;
            $project->action = '<button class="btn btn-primary btn-sm" data-id="' . $project->id . '" data-toggle="modal" data-target="#edit-project" data-title="' . $project->title . '" data-description="' . $project->description . '" data-image_path="' . $project->image_path . '" data-status="' . $project->status . '">Edit</button> <button class="btn btn-danger btn-sm" data-id="' . $project->id . '">Delete</button>';
            return $project;
        });
    }

}
