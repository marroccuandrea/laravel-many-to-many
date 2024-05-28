<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use App\Models\Tecnology;
use App\Functions\Helper as Help;
use Illuminate\Support\Facades\Storage;

class Projectscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (isset($_GET['toSearch'])) {
            $projects = Project::where('title', 'like', '%' . $_GET['toSearch'] . '%')->get();
        } else {
            $projects = Project::all();
        }

        $direction = 'desc';

        return view('admin.projects.index', compact('projects', 'direction'));
    }

    public function orderby($direction, $column)
    {
        $direction = $direction === 'desc' ? 'asc' : 'desc';
        $projects = Project::orderby($column, $direction)->get();
        return view('admin.projects.index', compact('projects', 'direction'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $tecnologies = Tecnology::all();
        return view('admin.projects.create', compact('types', 'tecnologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $exist = $request->validate(
            [
                'title' => 'required|min:3|max:255',
                'image' => 'sometimes|image',
                'tecnologies' => 'array',
                'tecnologies.*' => 'exists:tecnologies,id',
            ],
            [
                'title.required' => 'Il titolo è obbligatorio',
                'title.max' => 'Il titolo non può superare i :max caratteri',
                'title.min' => 'Il titolo deve avere almeno :min caratteri',
                'image.image' => 'Il file caricato deve essere una immagine',
                'tecnologies.array' => 'Il campo tecnologie deve essere un array',
                'tecnologies.*exists' => 'La tecnologia non esiste',

            ]
        );
        $data = $request->all();
        if (array_key_exists('image', $data)) {
            $image_path = Storage::put('uploads', $data['image']);

            $data['image'] = $image_path;
        }



        $exist = Project::where('title', $request->title)->first();
        if ($exist) {
            return redirect()->route('admin.projects.index')->with('error', 'Progetto già esistente');
        } else {
            $new = new Project();
            $new->title = $request->title;
            $new->slug = Help::generateSlug($new->title, Project::class);
            $new->image = $data['image'] ?? null;
            $new->type_id = $request->type;
            $new->save();
        }
        if (array_key_exists('tecnologies', $data)) {
            $new->tecnologies()->sync($data['tecnologies']);
        }
        return redirect()->route('admin.projects.index')->with('success', 'Progetto creato correttamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $tecnologies = Tecnology::all();
        return view('admin.projects.edit', compact('project', 'types', 'tecnologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate(
            [
                'title' => 'required|min:3|max:255',
                'image' => 'image',
                'tecnologies' => 'array',
                'tecnologies.*' => 'exists:tecnologies,id',
            ],
            [
                'title.required' => 'Il titolo è obbligatorio',
                'title.max' => 'Il titolo non può superare i :max caratteri',
                'title.min' => 'Il titolo deve avere almeno :min caratteri',
                'image.image' => 'Il file caricato deve essere una immagine',
                'tecnologies.array' => 'Il campo tecnologie deve essere un array',
                'tecnologies.*exists' => 'La tecnologia non esiste',

            ]
        );
        $data = $request->all();
        if (array_key_exists('image', $data)) {
            $image_path = Storage::put('uploads', $data['image']);

            $data['image'] = $image_path;
        }
        $exist = Project::where('title', $request->title)->first();
        if ($exist) {
            return redirect()->route('admin.projects.index')->with('error', 'Progetto già esistente');
        } else {
            $data['slug'] = Help::generateSlug($request->title, Project::class);
            $project->image = $data['image'] ?? null;
            $project->type_id = $request->type;
            $project->update($data);
        }
        if (array_key_exists('tecnologies', $data)) {
            $project->tecnologies()->sync($data['tecnologies']);
        }
        return redirect()->route('admin.projects.index')->with('success', 'Progetto modificato correttamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Progetto eliminato correttamente');
    }
}
