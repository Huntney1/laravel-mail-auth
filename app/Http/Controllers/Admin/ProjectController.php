<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Classe da non dimenticare
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Models\Project;
use App\Models\Category;
use App\Models\Technology;
use App\Models\Lead;
use App\Mail\NewContact;



class ProjectController extends Controller
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

        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
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
        //* Recupero Elenco Categorie
        $categories = Category::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('categories', 'technologies'));
    }

    //! -STORE-
    /**
     * Store a newly created resource in storage.
     ** Salva il nuovo progetto nel Database.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->validated();
        $slug = Project::generateSlug($request->title);

        $excerpt = '';
        if ($request->content != '') {
            $excerpt = substr($request->content, 0, 147) . '...';
        }

        //*Aggiungo Coppia Chiave Valore All'array $form_data
        $form_data['slug'] = $slug;
        $form_data['excerpt'] = $excerpt;

        //* inseriamo prima del fill, se è presente l'indice dobbiamo ricavarci il path da salvare nel database una volta fatto l'upload
        $newProject = new Project;
        if ($request->has('cover_image')) {
            $path = Storage::disk('public')->put('post_images', $request->cover_image);

            $form_data['cover_image'] = $path;
        }


        $newProject->fill($form_data);
        $newProject->save();
        //* Controllo se l'array associativO Request ha l'indice Technologies
        if($request->has('technologies')){
            $newProject->technologies()->attach($request->technologies);
        }


        $new_lead = new Lead();
        $new_lead->title = $form_data['title'];
        $new_lead->description = $form_data['description'];
        $new_lead->slug = $form_data['slug'];
        /* $new_lead->author = $form_data['author']; */

        $newProject->save();

        Mail::to('info@boolpress.com')->send(new NewContact($new_lead));

        return redirect()->route('admin.projects.index')->with('message', 'Progetto Creato con successo.');
    }

    //! -SHOW-
    /**
     * Display the specified resource.
     ** Visualizza la risorsa specificata.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {

        return view('admin.projects.show', compact('project'));
    }

    //! -EDIT-
    /**
     * Show the form for editing the specified resource.
     ** Vsualizza il modulo per la modifica della risorsa specificata.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {

        //* Recupero Elenco Categorie
        $categories = Category::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'categories', 'technologies'));
    }

    //! -UPDATE-
    /**
     * Update the specified resource in storage.
     ** Aggiorna la risorsa specificata nell'archiviazione.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $form_data = $request->validated();

        $slug = Project::generateSlug($request->title, '-');

        $excerpt = '';
        if ($request->content != '') {
            $excerpt = substr($request->content, 0, 147) . '...';
        }

        //* Converti la data nel formato desiderato
        /* if (!empty($form_data['published'])) {
            $published_at = Carbon::parse($form_data['published']);
            $form_data['published_at'] = $published_at->toDateTimeString();
            unset($form_data['published']);
        }
 */
        //*Aggiungo Coppia Chiave Valore All'array $form_data
        $form_data['slug'] = $slug;
        $form_data['excerpt'] = $excerpt;

        if($request->has('cover_image')){
            //SECONDO CONTROLLO PER CANCELLARE IL FILE PRECEDENTE SE PRESENTE
            if($project->cover_image){
                Storage::delete($project->cover_image);
            }
            $path = Storage::disk('public')->put('project_images', $request->cover_image);

            $form_data['cover_image'] = $path;
        }

        $project->update($form_data);

        //* FORMA COMPLETA
        /* if($request->has('technologies')){
            $project->technologies()->detach();

            foreach($request->'technologies' as $technology){
                $project->technologies()->attach($technology['id']);
            }
        } */

        //* FORMA (FUNZIONE) OTTIMIZZATA GRAZIE AL SYNC
        /* $project->technologies()->sync($request->technologies); */



        return redirect()->route('admin.projects.index')->with('message', $project->title . 'Progetto Modificato Correttamente');
    }

    //! -DESTROY-
    /**
     * Remove the specified resource from storage.
     ** Rimuove una risorsa specifica dallo storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        // se non ho
        //* cancellare i record presenti nella tabella ponte.
        $project->technologies()->sync([]);

        //*Canacella i Project
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', 'Progetto Eliminato con Successo.');
    }
}
