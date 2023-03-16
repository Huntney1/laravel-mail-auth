<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Project extends Model
{

     //* Definisco i campi assegnati del Model Project
     protected $fillable = [
        'title',
        'description',
        'slug',
        'category_id',
        'excerpt',
        'author',
        'cover_image',
        'published',

    ];

    use HasFactory;

    public static function generateSlug($title){
        return Str::slug($title, '-');
    }

    /**
     * Get the category project.
     ** Ottieni il progetto di categoria.
     *
     */
    public function category(){
        return $this->belongsTo(Category::class); //* belongsTo = appartiene A...
    }

    /**
      * Get the project technology.
     ** Ottieni il progetto di technology.
     *
     * @return void
     */
    public function technologies(){
        return $this->belongsToMany(Technology::class); //* belongsTo = appartiene A...
    }
}
