<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug'];


    public function Projects(){

        return $this->hasMany(Project::class); //* hasMany : la Categoria può far parte di più Projetti
    }

}
