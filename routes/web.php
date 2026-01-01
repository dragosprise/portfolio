<?php

use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\DashboardController;

//Route::get('/welcome', function () {
//    return view('welcome');
//})->name('home');

Route::get('/', [PageController::class, 'index'])->name('home');
//about routes
Route::get('/admin/about',[AboutController::class,'edit'])->middleware(['auth', 'verified'])->name('about.edit');
Route::patch('/admin/about',[AboutController::class,'update'])->name('about.update');

Route::get('admin/skills', [SkillsController::class, 'index'])
    ->name('admin.skills.index');
Route::post('admin/skills', [SkillsController::class, 'store'])
    ->name('admin.skills.store');
Route::get('admin/skills/{skill}/edit', [SkillsController::class, 'edit'])
    ->name('admin.skills.edit');
Route::patch('admin/skills/{skill}', [SkillsController::class, 'update'])
    ->name('admin.skills.update');
Route::delete('admin/skills/{id}', [SkillsController::class, 'destroy'])->name('admin.skills.destroy');

Route::get('/admin/projects', [ProjectsController::class,'index'])->middleware(['auth', 'verified'])->name('projects.index');
Route::post('admin/projects', [ProjectsController::class, 'store'])->name('admin.projects.store');
Route::delete('admin/projects/{id}', [ProjectsController::class, 'destroy'])->name('admin.projects.destroy');
Route::patch('admin/projects/{id}', [ProjectsController::class, 'update'])->name('admin.projects.update');

Route::get('/admin/education',[EducationController::class,'index'])->middleware(['auth', 'verified'])->name('admin.education.index');
Route::post('admin/education',[EducationController::class,'store'])->middleware(['auth','verified'])->name('admin.education.store');
Route::delete('admin/education/{id}', [EducationController::class, 'destroy'])->name('admin.education.destroy');
Route::patch('admin/education/{id}', [EducationController::class, 'update'])->name('admin.education.update');

Route::get('/admin/work',[ExperienceController::class,'index'])->middleware(['auth', 'verified'])->name('admin.experience.index');
Route::post('admin/work', [ExperienceController::class, 'store'])->name('admin.experience.store');
Route::delete('admin/work/{id}', [ExperienceController::class, 'destroy'])->name('admin.experience.destroy');
Route::patch('admin/work/{id}', [ExperienceController::class, 'update'])->name('admin.experience.update');


route::get('/admin/users',[UserController::class,'index'])->middleware(['auth', 'verified'])->name('users.index');
Route::post('admin/users', [UserController::class, 'store'])->name('admin.users.store');
Route::delete('admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
Route::patch('admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');


Route::get('/{any}', function (){
    return view('notFoundPage');
});

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
