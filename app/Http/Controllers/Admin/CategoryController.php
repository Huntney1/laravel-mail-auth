<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    //! -INDEX-
    /**
     * Display a listing of the resource.
     ** Mostra l'elenco dei progetti.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //* Utilizzo del metodo paginate e del metodo with per caricare i dati correlati
        //* e ottenere un numero limitato dei record alla volta
        //! $projects = Project::with('category')->paginate(10);

        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    //! -CREATE-
    /**
     * Show the form for creating a new resource.
     ** Mostra il form e il metodo per creare un nuovo progetto.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.categories.create');
    }

     //! -STORE-
    /**
     * Store a newly created resource in storage.
     ** Salva il nuovo progetto nel Database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form_data = $request->validate();
        $slug = Category::generateSlug($request->name);
        $form_data['slug'] = $slug;

        //*Aggiungo Coppia Chiave Valore All'array $form_data
        $form_data['slug'] = $slug;

        $newCategory = new Category;
        $newCategory->fill($form_data);
        $newCategory->save();

        return redirect()->route('admin.projects.index')->with('message', 'Categoria Creata con successo.');
    }

      //! -SHOW-
    /**
     * Display the specified resource.
     ** Visualizza la risorsa specificata.
     *
     * @param  \App\Models\Category  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    //! -EDIT-
    /**
     * Show the form for editing the specified resource.
     ** Vsualizza il modulo per la modifica della risorsa specificata.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    //! -UPDATE-
    /**
     * Update the specified resource in storage.
     ** Aggiorna la risorsa specificata nell'archiviazione.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $form_data = $request->validate();
        $slug = Category::generateSlug($request->name);
        $form_data['slug'] = $slug;

        $category->update($form_data);

        return redirect()->route('admin.categories.index')->with('message', 'Categoria Modificata con successo.');
    }

    //! -DESTROY-
    /**
     * Remove the specified resource from storage.
     ** Rimuove una risorsa specifica dallo storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('message', 'Categoria Eliminata con Successo.');
    }
}
