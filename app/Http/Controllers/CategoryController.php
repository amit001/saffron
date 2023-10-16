<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use App\Repositories\ProjectRepository;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    public $category;
    /**
     * @var ProjectRepository
     */
    public $project;
    /**
     * constructor for ProjectController
     * 
     * @param ProjectRepository $project
     *
     * @return void
     */
    public function __construct(CategoryRepository $category, ProjectRepository $project)
    {
        $this->category = $category;
        $this->project = $project;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Display a project listing page with all categories.
     * 
     */
    public function projectsByCategory()
    {
        $categories = $this->category->findAll();
        return view('admin.categories.projects', compact('categories'));
    }

    public function projectsByCategoryId()
    {
        $category_id = request()->get('category');
        $category = $this->category->find($category_id);
        $projects = $category->projects;
        $projects = $this->project->collectionModifier($projects);

        $count = $projects->count();

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $projects
        );

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
