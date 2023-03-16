<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     ** Determinare se l'utente è autorizzato ad effettuare la richiesta.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //! Cambiare valore da False a True per Autorizzare...
    }

    /**
     * Get the validation rules that apply to the request.
     ** Ottenere le regole di convalida applicabili alla richiesta.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'         => ['required', 'unique:projects,title', 'max:40'], // campo obbligatorio con una lunghezza massima di 255 caratteri
            'description'   => ['nullable', 'string'], //* campo facoltativo di tipo stringa
            'autor'         => ['nullable', 'string'], // campo facoltativo di tipo stringa
            'category_id'   => ['nullable', 'exists:categories,id'],
            'technologies'  => ['exists:technologies,id'],
            'published_at'  => ['date_format:d-m-Y H:i:s', 'nullable'], // campo facoltativo che deve essere una data valida
            //*  campo di tipo immagine con i formati consentiti JPEG, PNG, JPG, GIF e SVG e dimensione massima di 2 MB
            'cover_image'   => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048', 'dimensions:min_width=100,min_height=100,max_width=5000,max_height=5000'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     ** Ottenere i messaggi di errore per le regole di convalida definite.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required'        => 'Il titolo del progetto è obbligatorio',
            'title.unique'          => 'Il titolo del progetto è già stato utilizzato',
            'title.max'             => 'Il titolo del progetto non può superare i :max caratteri',
            'category_id.exist'     => 'Seleziona Cadegoria Valida',
            'technologies.exist'    => 'Seleziona Tecnologia Valida',
            'description.string'    => 'La descrizione del progetto deve essere una stringa',
            'cover_image.image'     => 'Il file caricato non è un\'immagine',
            'cover_image.mimes'     => 'Il file caricato deve essere in formato: :values',
            'cover_image.max'        => 'Il file caricato non può superare i :max Kb',
            'cover_image.dimensions'  => 'Le dimensioni dell\'immagine devono essere tra :min_widthx:min_height',
        ];
    }
}
