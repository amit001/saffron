<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function Categories()
    {
        return $this->belongsToMany(\App\Models\Category::class, 'categories_projects', 'project_id', 'category_id');
    }
}
