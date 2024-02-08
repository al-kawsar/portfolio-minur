<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function index()
    {
        $type_menu = "profiles";
        $profiles = Profile::all();
        return view('admin.profile', compact('type_menu', 'profiles'));
    }

    public function createProfile(Request $request)
    {

        $validated = $request->validate([
            'status' => "required",
            'nama' => "required",
            'deskripsi' => "required",
            'tanggal_lahir' => "required|date",
            'email' => "required|email",
            'alamat' => "required",
            'nomor_hp' => "required",
        ], [
            'status.required' => "status wajib di isi",
            'nama.required' => "nama wajib di isi",
            'deskripsi.required' => "deskripsi wajib di isi!",
            'tanggal_lahir.required' => "tanggal lahir wajib di isi",
            'tanggal_lahir.date' => "kesalahan inputan tanggal lahir",
            'email.required' => "email wajib di isi!",
            'email.email' => "inputan harus berupa email!",
            'alamat.required' => "alamat wajib di isi",
            'nomor_hp.required' => "nomor hp wajib diisi!"
        ]);

        if ($request->status == 1) {
            Profile::where('status', 1)->update(['status' => 0]);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '.webp';

            $compressedImage = Image::make($image)
                ->fit(1000, 1000)
                ->encode('webp', 75);

            // Menyimpan gambar ke penyimpanan
            $pathToSave = 'uploads/' . $imageName;
            Storage::put($pathToSave, $compressedImage->stream());

            // Membuat record profile
            $profile = new Profile();
            $profile->status = $request->status;
            $profile->nama = $request->nama;
            $profile->bio = $request->deskripsi;
            $profile->tanggal_lahir = $request->tanggal_lahir;
            $profile->alamat = $request->alamat;
            $profile->email = $request->email;
            $profile->nomor_hp = $request->nomor_hp;
            $profile->gambar = $pathToSave;
            $profile->save();
        }

        Contact::create([
            'profile_id' => $profile->id,
        ]);

        return redirect()->route('profiles')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function viewEditProfile(Profile $profile)
    {
        $type_menu = "profiles";
        $contact = Contact::find($profile->id);
        return view('admin.profile-edit', compact('type_menu', 'profile', 'contact'));
    }

    public function updateProfile(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            "akun_instagram" => "nullable",
            "akun_facebook" => "nullable",
            "akun_twitter" => "nullable",
            "akun_github" => "nullable",
            "akun_youtube" => "nullable",
            "akun_linkedin" => "nullable",
            'nama' => "required|max:255|min:2",
            'email' => "required|email|max:255",
            'tanggal_lahir' => "required|date",
            'alamat' => 'required|max:100',
            'nomor_hp' => "required|max:20",
            'bio' => 'required',

        ], [
            'nama.required' => "nama tidak boleh kosong!",
            'tanggal_lahir.required' => "tanggal lahir wajib di isi!",
            'tanggal_lahir.date' => "inputan harus berupa date!",
            'email.required' => "email tidak boleh kosong!",
            'email.email' => "yang anda inputkan bukan email!",
            'alamat.required' => "alamat wajib di isi!",
            'alamat.max' => 'alamat maksimal 100 karakter!',
            'nomor_hp.required' => 'nomor hp wajib di isi!',
            'nomor.max' => "nomor hp terlalu banyak!",
        ]);


        if ($request->hasFile('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $image = $request->file('image');
            $imageName = uniqid() . '.webp';
            $compressedImage = Image::make($image)
                ->fit(1000, 1000) // Sesuaikan ukuran gambar sesuai kebutuhan
                ->encode('webp', 75); // Encode gambar menjadi format WebP dengan kualitas 75%

            // Menyimpan gambar ke penyimpanan
            $pathToSave = 'uploads/' . $imageName;
            Storage::put($pathToSave, $compressedImage->stream());
        }

        if ($request->status == 1) {
            Profile::where('status', 1)->update(['status' => 0]);
        }

        // ? PROFILE ACTION
        $profile = Profile::findOrFail($profile->id);
        $profile->status = $request->status;
        $profile->nama = $request->nama;
        $profile->bio = $request->bio;
        $profile->tanggal_lahir = $request->tanggal_lahir;
        $profile->alamat = $request->alamat;
        $profile->email = $request->email;
        $profile->nomor_hp = $request->nomor_hp;
        $profile->gambar = $pathToSave ?? $request->oldImage;
        $profile->save();

        // ? CONTACT ACTION
        $contact = Contact::find($profile->id);
        $contact->akun_instagram = $request->akun_instagram ?? "";
        $contact->akun_facebook = $request->akun_facebook ?? "";
        $contact->akun_twitter = $request->akun_twitter ?? "";
        $contact->akun_github = $request->akun_github ?? "";
        $contact->akun_youtube = $request->akun_youtube ?? "";
        $contact->akun_linkedin = $request->akun_linkedin ?? "";
        $contact->save();

        return redirect()->route('edit-profile', $profile->id)->with('success', 'Data Berhasil Diubah!');
    }

    public function destroyProfile(Profile $profile)
    {
        if ($profile->gambar) {
            Storage::delete($profile->gambar);
        }
        Contact::where('profile_id', $profile->id)->delete();
        $profile = Profile::findOrFail($profile->id);
        $profile->delete();
        return redirect()->route('profiles')->with('success', "Data Berhasil Dihapus");
    }
}
