<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\LaboratoireController;
use App\Http\Controllers\EquipeRechercheController;
use App\Http\Controllers\AgentRechercheController;
use App\Http\Controllers\AgentBibliothequeController;
use App\Http\Controllers\DoctorantController;
use App\Http\Controllers\TheseController;
use App\Http\Controllers\DirecteurTheseController;
use App\Http\Controllers\UserTheseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ThesesFilesController;

// Departement ROUTES
Route::get('/api/departements', [DepartementController::class, 'index']);
Route::get('/api/departement/{id}', [DepartementController::class, 'show']);
Route::post('/api/departements', [DepartementController::class, 'store']);
Route::put('/api/departement/{id}', [DepartementController::class, 'update']);
Route::delete('/api/departement/{id}', [DepartementController::class, 'destroy']);
// Laboratoire ROUTES
Route::get('/api/laboratoires', [LaboratoireController::class, 'index']);
Route::get('/api/laboratoire/{id}', [LaboratoireController::class, 'show']);
Route::post('/api/laboratoires', [LaboratoireController::class, 'store']);
Route::put('/api/laboratoire/{id}', [LaboratoireController::class, 'update']);
Route::delete('/api/laboratoire/{id}', [LaboratoireController::class, 'destroy']);
// equipe de recherche ROUTES
// Route::get('/api/equipe-recherches', [EquipeRechercheController::class, 'index']);
// Route::get('/api/equipe-recherche/{id}', [EquipeRechercheController::class, 'show']);
// Route::post('/api/equipe-recherches', [EquipeRechercheController::class, 'store']);
// Route::put('/api/equipe-recherche/{id}', [EquipeRechercheController::class, 'update']);
// Route::delete('/api/equipe-recherche/{id}', [EquipeRechercheController::class, 'destroy']);
// agent de recherche ROUTES
// Route::get('/api/agent-recherches', [AgentRechercheController::class, 'index']);
// Route::get('/api/agent-recherche/{id}', [AgentRechercheController::class, 'show']);
// Route::post('/api/agent-recherches', [AgentRechercheController::class, 'store']);
// Route::put('/api/agent-recherche/{id}', [AgentRechercheController::class, 'update']);
// Route::delete('/api/agent-recherche/{id}', [AgentRechercheController::class, 'destroy']);
// agent de bibliotheque ROUTES
// Route::get('/api/agent-bibliotheques', [AgentBibliothequeController::class, 'index']);
// Route::get('/api/agent-bibliotheque/{id}', [AgentBibliothequeController::class, 'show']);
// Route::post('/api/agent-bibliotheques', [AgentBibliothequeController::class, 'store']);
// Route::put('/api/agent-bibliotheque/{id}', [AgentBibliothequeController::class, 'update']);
// Route::delete('/api/agent-bibliotheque/{id}', [AgentBibliothequeController::class, 'destroy']);
// doctorant ROUTES
// Route::get('/api/doctorants', [DoctorantController::class, 'index']);
// Route::get('/api/doctorants/{id}', [DoctorantController::class, 'show']);
// Route::post('/api/doctorants', [DoctorantController::class, 'store']);
// Route::put('/api/doctorants/{id}', [DoctorantController::class, 'update']);
// Route::delete('/api/doctorants/{id}', [DoctorantController::class, 'destroy']);
// directeur de these ROUTES
// Route::get('/api/directeur-theses', [DirecteurTheseController::class, 'index']);
// Route::get('/api/directeur-these/{id}', [DirecteurTheseController::class, 'show']);
// Route::post('/api/directeur-theses', [DirecteurTheseController::class, 'store']);
// Route::put('/api/directeur-these/{id}', [DirecteurTheseController::class, 'update']);
// Route::delete('/api/directeur-these/{id}', [DirecteurTheseController::class, 'destroy']);
// theses ROUTES
Route::get('/api/theses', [TheseController::class, 'index']);
Route::get('/api/these/{id}', [TheseController::class, 'show']);
Route::post('/api/theses', [TheseController::class, 'store']);
Route::put('/api/these/{id}', [TheseController::class, 'update']);
Route::delete('/api/these/{id}', [TheseController::class, 'destroy']);
// theses ROUTES
Route::get('/api/users', [UserTheseController::class, 'index']);
Route::get('/api/user/{id}', [UserTheseController::class, 'show']);
Route::post('/api/users', [UserTheseController::class, 'store']);
Route::put('/api/user/{id}', [UserTheseController::class, 'update']);
Route::delete('/api/user/{id}', [UserTheseController::class, 'destroy']);
// Login Routes
Route::post('/api/login', [LoginController::class, 'login']);

Route::get('/api/files', [ThesesFilesController::class, 'get_all']);
Route::get('/api/file/{id}', [ThesesFilesController::class, 'get']);
Route::get('/api/download/file/{id}', [ThesesFilesController::class, 'download']);
Route::post('/api/files', [ThesesFilesController::class, 'post']);
// Route::put('/{id}', [ThesesFilesController::class, 'put']);
Route::delete('/api/file/{id}', [ThesesFilesController::class, 'delete']);
