<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SocialLinkController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\HomeSectionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GalleryImageController;
use App\Http\Controllers\GalleryVideoController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TestimonialController;


//Home API

Route::get('/home-section',[HomeSectionController::class, 'index']);
Route::get('/about',[AboutController::class, 'index']);
Route::get('/services',[ServiceController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);


Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blogs/{slug}', [BlogController::class, 'show']);

Route::get('/settings',[SettingsController::class, 'index']);
Route::get('/social-links',[SocialLinkController::class, 'index']);


Route::get('/projects',[ProjectController::class, 'index']);
Route::get('/get-project-by-id/{slug}',[ProjectController::class, 'getProjectById']);
Route::post('/contact',[ContactController::class, 'create']);
Route::get('/staffs',[StaffController::class, 'index']);
Route::get('/gallery-images',[GalleryImageController::class, 'index']);
Route::get('/gallery-videos',[GalleryVideoController::class, 'index']);
Route::get('/testimonials',[TestimonialController::class, 'index']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
