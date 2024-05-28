<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Functions\Helper as Help;

class Typescontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
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
        $exist = Type::where('title', $request->title)->first();
        if ($exist) {
            return redirect()->route('admin.types.index')->with('error', 'Tipo già esistente');
        } else {
            $new = new Type();
            $new->title = $request->title;
            $new->slug = Help::generateSlug($new->title, Type::class);
            $new->save();
            return redirect()->route('admin.types.index')->with('success', 'Tipo creato correttamente');
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
    public function update(Request $request, Type $type)
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
        $exist = Type::where('title', $request->title)->first();
        if ($exist) {
            return redirect()->route('admin.types.index')->with('error', 'Tipo già esistente');
        } else {
            $data['slug'] = Help::generateSlug($request->title, Type::class);
            $type->update($data);
            return redirect()->route('admin.types.index')->with('success', 'Tipo modificato correttamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.types.index')->with('success', 'Tipo eliminato correttamente');
    }
}
