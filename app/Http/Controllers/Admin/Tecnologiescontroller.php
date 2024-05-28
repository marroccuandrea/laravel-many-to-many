<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tecnology;
use App\Functions\Helper as Help;

class Tecnologiescontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tecnologies = Tecnology::all();
        return view('admin.tecnologies.index', compact('tecnologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $exist = Tecnology::where('title', $request->title)->first();
        if ($exist) {
            return redirect()->route('admin.tecnologies.index')->with('error', 'Linguaggio già esistente');
        } else {
            $new = new Tecnology();
            $new->title = $request->title;
            $new->slug = Help::generateSlug($new->title, Tecnology::class);
            $new->save();
            return redirect()->route('admin.tecnologies.index')->with('success', 'Linguaggio creato correttamente');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tecnology $tecnology)
    {
        $data = $request->validate(
            [
                'title' => 'required|min:3|max:255',
            ],
            [
                'title.required' => 'Il titolo è obbligatorio',
                'title.max' => 'Il titolo non può superare i :max caratteri',
                'title.min' => 'Il titolo deve avere almeno :min caratteri',

            ]
        );
        $exist = Tecnology::where('title', $request->title)->first();
        if ($exist) {
            return redirect()->route('admin.tecnologies.index')->with('error', 'Progetto già esistente');
        } else {
            $data['slug'] = Help::generateSlug($request->title, Tecnology::class);
            $tecnology->update($data);
            return redirect()->route('admin.tecnologies.index')->with('success', 'Progetto modificato correttamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tecnology $tecnology)
    {
        $tecnology->delete();
        return redirect()->route('admin.tecnologies.index')->with('success', 'Linguaggio eliminato correttamente');
    }
}
