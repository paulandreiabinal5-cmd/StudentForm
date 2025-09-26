<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\studentcontroller;

Route::get('/', function () {
    return view('welcome');
});

route::get('/liststudent', [studentcontroller::class, 'studentinfo']);
route::get('/studentarray', [studentcontroller::class, 'studentarray']);
route::get('/studentwith', [studentcontroller::class, 'studWith']);
route::get('/studentcompact', [studentcontroller::class, 'studcompact']);
route::get('/listmaster', [studentcontroller::class, 'studmasterlist'])->name('student.list');
route::post('/student/add', [studentcontroller::class,'addstudent'])->name('student.add');
route::get('/student/edit/{index}', [studentcontroller::class, 'editstudent'])->name('student.edit');
route::post('/student/update/{index}', [studentcontroller::class, 'updatestudent'])->name('student.update');
route::delete('/student/delete/{index}', [studentcontroller::class, 'deletestudent'])->name('student.delete');