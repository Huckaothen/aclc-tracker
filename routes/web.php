<?php

use Illuminate\Support\Facades\Route;

// Admin
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Alumni\AlumniController;
use App\Http\Controllers\Admin\Career\CareerController;
use App\Http\Controllers\Admin\Event\EventController;
use App\Http\Controllers\Admin\Announcement\AnnouncementController;
use App\Http\Controllers\Admin\Forum\ForumController;
use App\Http\Controllers\Admin\Users\UsersController;

// Alumni
use App\Http\Controllers\Alumni\UserController;
use App\Http\Controllers\Alumni\HomeController;
use App\Http\Controllers\Alumni\JobsController;
use App\Http\Controllers\Alumni\EventsController;
use App\Http\Controllers\Alumni\ProfileController;
use App\Http\Controllers\Alumni\BatchController;
use App\Http\Controllers\Alumni\AnnouncementsController;
use App\Http\Controllers\Alumni\ForumsController;

// Alumni
Route::get('/', [UserController::class, 'index'])->name('alumni.login');
Route::post('/login-alumni', [UserController::class, 'login'])->name('alumni.auth');
Route::get('/register', [UserController::class, 'account'])->name('alumni.register');
Route::post('/register-alumni', [UserController::class, 'register'])->name('alumni.create.account');
Route::get('/verify-email/{token}', [UserController::class, 'verifyEmail'])->name('alumni.verify.email');

Route::prefix('alumni')->name('alumni.')->group(function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('home');
    Route::get('jobs', [JobsController::class, 'index'])->name('job');
    Route::get('jobs/fetch', [JobsController::class, 'fetchJobs'])->name('job.fetch');
    Route::get('jobs/{id}', [JobsController::class, 'show'])->name('job.show');

    Route::get('events', [EventsController::class, 'index'])->name('event');
    Route::get('events/get', [EventsController::class, 'getEvents'])->name('event.get');

    Route::get('profile/{id?}', [ProfileController::class, 'index'])->name('profile');
    Route::get('profile/{id}/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('profile/jobs/list', [ProfileController::class, 'getJobs'])->name('profile.jobs');
    Route::get('profile/{id}/show-jobs', [ProfileController::class, 'showJobs'])->name('career.show');
    Route::post('profile/store', [ProfileController::class, 'store'])->name('profile.store');

    Route::get('batch', [BatchController::class, 'index'])->name('batch');
    Route::get('batch/fetch', [BatchController::class, 'fetchBatch'])->name('batch.fetch');


    Route::get('announcement', [AnnouncementsController::class, 'index'])->name('announcement');

    Route::get('forums', [ForumsController::class, 'index'])->name('forums');
    Route::get('forums/fetch', [ForumsController::class, 'fetchForums'])->name('forums.fetch');
    Route::get('forums/{id}', [ForumsController::class, 'show'])->name('forums.show');

    Route::get('logout', [UserController::class, 'logout'])->name('logout');
});


// Admin 
Route::get('admin', [LoginController::class, 'index'])->name('admin.login');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('home');
   
    Route::post('auth', [LoginController::class, 'login'])->name('auth');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    //Alumni
    Route::get('alumni', [AlumniController::class, 'index'])->name('alumni');
    Route::get('alumni/{id}', [AlumniController::class, 'show'])->name('alumni.show');
    Route::post('alumni/update/{id}', [AlumniController::class, 'update'])->name('alumni.update');

    //Career
    Route::get('career', [CareerController::class, 'index'])->name('career');
    Route::post('career/store', [CareerController::class, 'store'])->name('career.store');
    Route::get('career/{id}/show', [CareerController::class, 'show'])->name('career.show');
    Route::post('career/status', [CareerController::class, 'updateStatus'])->name('career.status');


    Route::get('event', [EventController::class, 'index'])->name('event');
    Route::post('event/store', [EventController::class, 'saveEvent'])->name('event.submit');
    Route::get('event/{event}', [EventController::class, 'show'])->name('event.show');

    Route::get('announcement', [AnnouncementController::class, 'index'])->name('announcement');
    Route::post('announcement/store', [AnnouncementController::class, 'saveAnnouncement'])->name('announcement.submit');
    Route::get('announcement/{announcement}', [AnnouncementController::class, 'show'])->name('announcement.show');

    Route::get('forum', [ForumController::class, 'index'])->name('forum');
    Route::post('forum/store', [ForumController::class, 'saveForum'])->name('forum.submit');
    Route::get('forum/{forum}', [ForumController::class, 'show'])->name('forum.show');

    Route::get('user', [UsersController::class, 'index'])->name('user');
    Route::post('user/store', [UsersController::class, 'saveUser'])->name('user.submit');
    Route::get('user/{user}', [UsersController::class, 'show'])->name('user.show');
});