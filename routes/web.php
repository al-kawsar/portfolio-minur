<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PortofolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SliderController;
use App\Models\Slider;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Dashboard

Route::get('/', [PortofolioController::class, 'index']);
Route::view('/modal', 'pages.bootstrap-modal', ["type_menu" => "dashboard"]);

Route::get('/admin', [AuthController::class, 'index'])->name('auth.index')->middleware(['isLogin']);
Route::post('/admin', [AuthController::class, 'authenticate'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // * admins
    Route::get('admins', [AdminController::class, 'index'])->name('admins')->middleware(['isSuperadmin']);
    Route::post('admins', [AdminController::class, 'store'])->name('create-admin')->middleware(['isSuperadmin']);

    // * buat prefix admins
    Route::prefix('admins')->middleware(['isSuperadmin'])->group(function () {
        Route::get('{user:email}', [AdminController::class, 'show'])->name('admins.detail');
        Route::delete('{user:id}', [AdminController::class, 'destroy'])->name('delete-admin');
        Route::put('{user:id}', [AdminController::class, 'update'])->name('update-admin');
        Route::get('reset-password/{user:email}', [AdminController::class, 'resetPassword'])->name('admin.reset-password');
    });

    // * Sliders
    Route::get('sliders', [SliderController::class, 'index'])->name('sliders');
    Route::post('sliders', [SliderController::class, 'store'])->name('create-slider');

    // * buat prefix sliders
    Route::prefix('sliders')->group(function () {
        Route::get('{slider:id}', [SliderController::class, 'showEditSlider'])->name('edit-slider');
        Route::put('{slider:id}', [SliderController::class, 'updateSlider'])->name('update-slider');
        Route::delete('{slider:id}', [SliderController::class, 'destroySlider'])->name('delete-slider');
    });

    // * Profiles
    Route::get('profile', [ProfileController::class, 'index'])->name('profiles');
    Route::post('profile', [ProfileController::class, 'createProfile'])->name('create-profile');

    // * Prefix Profiles
    Route::prefix('profile')->group(function () {
        Route::get('{profile:id}', [ProfileController::class, 'viewEditProfile'])->name('edit-profile');
        Route::put('{profile:id}', [ProfileController::class, 'updateProfile'])->name('update-profile');
        Route::delete('{profile:id}', [ProfileController::class, 'destroyProfile'])->name('delete-profile');
    });

    // * redirect ketika seseorang mengakses dengan method get
    Route::redirect('profile/{id}', '/admin/profile');

    // * Skills
    Route::get('skills', [SkillController::class, 'index'])->name('skills');
    Route::post('skills', [SkillController::class, 'createSkill'])->name('create-skills');

    Route::prefix('skills')->group(function () {
        Route::get('{skill:id}', [SkillController::class, 'viewSkillEdit'])->name('edit-skills');
        Route::put('{skill:id}', [SkillController::class, 'updateSkill'])->name('update-skills');
        Route::delete('{skill:id}', [SkillController::class, 'destroySkill'])->name('delete-skills');
    });


    // * Services
    Route::get('services', [ServiceController::class, 'index'])->name("services");
    Route::get('services/create', [ServiceController::class, 'viewServiceCreate'])->name("create-service");

    // * Projects
    Route::get('projects', [ProjectController::class, 'index'])->name("projects");
    Route::post('projects', [ProjectController::class, 'createProject'])->name("create-project");

    // * buat prefix projects
    Route::prefix('projects')->group(function () {
        Route::get('{project:id}', [ProjectController::class, 'showEditProject'])->name('edit-project');
        Route::put('{project:id}', [ProjectController::class, 'updateProject'])->name('update-project');
        Route::delete('{project:id}', [ProjectController::class, 'destroyProject'])->name('delete-project');
    });
});
