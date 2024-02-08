<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type_menu = "skills";
        $skills = Skill::all();
        return view('admin.skills', compact('type_menu', 'skills'));
    }

    public function createSkill(Request $request)
    {
        $validatedData = $request->validate([
            'skill' => "required|max:100",
            'level' => "required|integer|max:100|min:0"
        ], [
            'skill.required' => "skill wajib di isi!",
            'level.required' => 'level wajib di isi!',
            'level.max' => "maksimal tingkat 100 karakter!"
        ]);

        $skill = new Skill();
        $skill->nama = $request->skill;
        $skill->tingkat = $request->level;
        $skill->save();

        return redirect()->route('skills')->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function viewSkillEdit(Skill $skill)
    {
        $type_menu = "skills";

        return view('admin.skill-edit', compact('type_menu', 'skill'));
    }

    public function updateSkill(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'nama' => "required",
            'skill' => "required|max:100|min:0"
        ]);

        $skill = Skill::find($skill->id);
        $skill->nama = $skill->nama;
        $skill->tingkat = $request->skill;
        $skill->save();

        return redirect()->route('edit-skills',$skill->id)->with('success','Data Berhasil Diubah');
    }

    public function destroySkill(Skill $skill)
    {
        Skill::destroy($skill->id);
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }
}
