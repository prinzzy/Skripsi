<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\StudentSessionController;
use App\Http\Controllers\TuitionPaymentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ParentsController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ProgressReportController;
use App\Http\Controllers\RegisterController;
use App\Models\Student;
use App\Models\StudentSession;
use App\Http\Controllers\BankTransferController;

// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
// });

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'teacherDashboard'])->name('teacher.dashboard');
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
});



Route::middleware(['auth', 'role:parent'])->group(function () {
    Route::get('/parents/payment', [TuitionPaymentController::class, 'indexparent'])->name('payments.parent');
    Route::post('/parents/tuition-payment/store', [TuitionPaymentController::class, 'storeForParent'])
        ->name('payment.store');
    Route::get('/parents/dashboard', [ParentsController::class, 'parentsDashboard'])->name('parents.dashboard');
});



Route::middleware('auth')->group(function () {
    Route::get('/parent-progress-reports', [ProgressReportController::class, 'parentIndex'])->name('parent_progress_reports');
});



// Redirect
Route::get('/redirect', [RedirectController::class, 'redirectBasedOnRole'])->name('redirect');

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

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

Route::get('/', function () {
    return view('auth.login');
});
Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {;
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::group(['prefix' => 'components', 'as' => 'components.'], function () {
        Route::get('/alert', function () {
            return view('admin.component.alert');
        })->name('alert');
        Route::get('/accordion', function () {
            return view('admin.component.accordion');
        })->name('accordion');
    });
});

// Data Murid
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');
Route::post('/students/store', [StudentController::class, 'store'])->name('students.store');
Route::post('/students/update', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');


// Jadwal
Route::get('/jadwal', [StudentSessionController::class, 'index'])->name('jadwal.index');
Route::post('/jadwal', [StudentSessionController::class, 'store'])->name('jadwal.store');
Route::post('/jadwal/{id}/update', [StudentSessionController::class, 'update'])->name('jadwal.update');
Route::post('/jadwal/{id}/delete', [StudentSessionController::class, 'destroy'])->name('jadwal.destroy');
Route::get('/students/{id}', function ($id) {
    return response()->json(App\Models\Student::find($id));
});
Route::get('/teacher/view-sessions', [StudentSessionController::class, 'viewSessions'])->name('teacher.view-sessions');

// Pembayaran 
Route::get('/payments', [TuitionPaymentController::class, 'index'])->name('payments.index');
Route::get('/payments/create', [TuitionPaymentController::class, 'create'])->name('payments.create');
Route::post('/payments/store', [TuitionPaymentController::class, 'store'])->name('payments.store');
Route::get('/payments/edit/{id}', [TuitionPaymentController::class, 'edit'])->name('payments.edit');
Route::post('/payments/update/{id}', [TuitionPaymentController::class, 'update'])->name('payments.update');
Route::post('/payments/delete/{id}', [TuitionPaymentController::class, 'destroy'])->name('payments.destroy');
Route::get('/payments/export-pdf', [TuitionPaymentController::class, 'exportPdf'])->name('payments.exportPdf');
// Route::post('/parents/tuition-payment/store', [TuitionPaymentController::class, 'storeForParent'])
//     ->name('parents.tuition-payment.store');
// Route::get('/parents/payment', [TuitionPaymentController::class, 'indexparent'])->name('payments.parent');
// // Route::resource('teachers', TeacherController::class);



//Pendaftaran
Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('auth.pendaftaran');



// Jadwal bagian pengajar
Route::post('/jadwal/update-all', [StudentSessionController::class, 'updateAll'])->name('jadwal.updateAll');
Route::post('/jadwal/update-single/{id}', [StudentSessionController::class, 'updateSingle'])->name('jadwal.updateSingle');


Route::get('/parents/schedule', [ParentsController::class, 'schedule'])->name('parents.schedule');

// Progress Report
Route::get('/progress-reports', [ProgressReportController::class, 'index'])->name('progress_reports.index');
Route::post('/progress-reports', [ProgressReportController::class, 'store'])->name('progress_reports.store');
Route::post('/progress-reports/{progressReport}', [ProgressReportController::class, 'update'])->name('progress_reports.update');
Route::delete('/progress-reports/{progressReport}/delete', [ProgressReportController::class, 'destroy'])->name('progress_reports.destroy');


// registrasi
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/bank-transfer', [BankTransferController::class, 'show'])->name('bank-transfer.show');
Route::post('/bank-transfer', [BankTransferController::class, 'uploadReceipt'])->name('bank-transfer.upload');
