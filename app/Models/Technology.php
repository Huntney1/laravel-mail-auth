<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Technology extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug'];

    public static function generateSlug($name){
        return Str::slug($name, '-');
    }

    /**
     * Get the technology projects.
     ** Ottieni la technology di projects.
     *
     * @return void
     */
    public function projects(){
        return $this->belongsToMany(Project::class);
    }

}
