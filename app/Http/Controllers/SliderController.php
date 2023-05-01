<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type_menu = "sliders";
        $sliders = Slider::latest()->get();
        return view('admin.slider', compact('type_menu', 'sliders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '.webp';

            $compressedImage = Image::make($image)
                ->fit(1600, 900) //  ukuran gambar ex: 16:9
                ->encode('webp', 75); // Encode gambar menjadi format WebP dengan kualitas 75%

            // Menyimpan gambar ke penyimpanan
            $pathToSave = 'uploads/' . $imageName;
            Storage::put($pathToSave, $compressedImage->stream());

            // Membuat record slider
            $slider = new Slider();
            $slider->gambar = $pathToSave;
            $slider->status = $request->status == 1 ? 'Active' : 'Not active';
            $slider->save();
        }

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->route('sliders')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function showEditSlider(Slider $slider)
    {
        $type_menu = "sliders";
        return view('admin.slider-edit', compact('type_menu', 'slider'));
    }
    public function updateSlider(Request $request, Slider $slider)
    {
        // dd($request->status);
        $validated = $request->validate([
            'image' => 'image|mimes:jpeg,jpg,png|max:2048',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $image = $request->file('image');
            $imageName = uniqid() . '.webp';
            $compressedImage = Image::make($image)
                ->fit(1600, 900) // Sesuaikan ukuran gambar sesuai kebutuhan
                ->encode('webp', 75); // Encode gambar menjadi format WebP dengan kualitas 75%

            // Menyimpan gambar ke penyimpanan
            $pathToSave = 'uploads/' . $imageName;
            Storage::put($pathToSave, $compressedImage->stream());
        }
        $slider = Slider::find($slider->id);
        $slider->gambar = $pathToSave ?? $slider->gambar;
        $slider->status = $request->status === "1" ? 'Active' : 'Not Active';
        $slider->save();


        return redirect()->route('edit-slider', $slider->id)->with('success', 'Data Berhasil Diubah!');
    }

    public function destroySlider(Slider $slider)
    {
        if ($slider->gambar) {
            Storage::delete($slider->gambar);
        }
        Slider::destroy($slider->id);
        return redirect()->route('sliders')->with('success', "Data Berhasil Dihapus");
    }
}
