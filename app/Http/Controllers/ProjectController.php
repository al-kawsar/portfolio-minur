<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type_menu = "projects";
        $projects = Project::all();
        return view('admin.projects', compact('type_menu', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createProject(Request $request)
    {
        $validated = $request->validate([
            'nama' => "required|max:255",
            'link' => "nullable|max:255",
            'tahun_dibuat' => "required",
            'image' => "required|image|mimes:jpeg,jpg,png",
        ]);

        if ($request->hasFile('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $image = $request->file('image');
            $imageName = uniqid() . '.webp';

            $compressedImage = Image::make($image)
                ->fit(1000, 1000) //  ukuran gambar ex: 16:9
                ->encode('webp', 75); // Encode gambar menjadi format WebP dengan kualitas 75%

            $pathToSave = 'uploads/' . $imageName;
            Storage::put($pathToSave, $compressedImage->stream());

            $project = new Project();
            $project->nama = $request->nama;
            $project->link = $request->link;
            $project->tahun_dibuat = $request->tahun_dibuat;
            $project->gambar = $pathToSave;
            $project->save();
        }
        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->route('projects')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function showEditProject(Project $project)
    {
        $type_menu = "projects";
        return view('admin.project-edit', compact('type_menu', 'project'));
    }

    public function updateProject(Request $request, Project $project)
    {
        $validated = $request->validate([
            'nama' => "required|max:255",
            'tahun' => "required|max:255",
            'link' => "required|url",
            'image' => "image|mimes:jpeg,jpg,png",
        ]);

        if ($request->hasFile('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $image = $request->file('image');
            $imageName = uniqid() . '.webp';

            $compressedImage = Image::make($image)
                ->fit(1000, 1000) //  ukuran gambar ex: 16:9
                ->encode('webp', 75); // Encode gambar menjadi format WebP dengan kualitas 75%

            $pathToSave = 'uploads/' . $imageName;
            Storage::put($pathToSave, $compressedImage->stream());
        }

        $project = Project::find($project->id);
        $project->nama = $request->nama;
        $project->link = $request->link;
        $project->tahun_dibuat = $request->tahun;
        $project->gambar = $pathToSave ?? $request->oldImage;
        $project->save();

        return redirect()->route('edit-project', $project->id)->with('success', 'Data Berhasil Diubah');
    }

    public function destroyProject(Project $project)
    {
        if ($project->gambar) {
            Storage::delete($project->gambar);
        }
        Project::destroy($project->id);
        return redirect()->route('projects')->with('success', "Data Berhasil Dihapus");
    }
}
