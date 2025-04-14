<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseVideoController;
use App\Http\Controllers\TempUploadsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\YouTubeAuthController;
use App\Http\Controllers\ChunkedUploadController;
use App\Http\Controllers\YouTubeUploadController;
use App\Http\Controllers\Trooper\TCourseController;
use App\Http\Controllers\Trooper\TDiscussController;
use App\Http\Controllers\Trooper\TDashboardController;

Route::get('/', [PageController::class, 'index'])->name('welcome');
// Route::get('/test-yt', [CourseVideoController::class, 'testYT']);
Route::get('/successauth', [CourseVideoController::class, 'callback']);

Route::middleware(['auth','phone.verified'])
->prefix('troopers')
->name('troopers.')
->group(function () {
    Route::get('/dashboard', [TDashboardController::class, 'index'])->name('dashboard');
    Route::get('/account', [TDashboardController::class, 'account'])->name('account');
    Route::put('/account', [TDashboardController::class, 'updateAccount'])->name('account.update');
    Route::put('/account/modal', [TDashboardController::class, 'updateModal'])->name('account.modal');

    Route::get('/course/all', [TCourseController::class, 'allCourse'])->name('all-course');
    Route::get('/course/{slug}/detail', [TCourseController::class, 'detailCourse'])->name('detail-course');
    Route::get('/my-course', [TCourseController::class, 'myCourse'])->name('my-course');
    Route::get('/my-course/{slug}/detail', [TCourseController::class, 'myDetailCourse'])->name('my-detail-course');
    Route::get('/my-transactions', [TDashboardController::class, 'myTransactions'])->name('my-transactions');
    Route::delete('/transaction/{transactionId}', [TDashboardController::class, 'deleteTransaction'])->name('transaction.delete');

    Route::get('/course/{slug}/discuss', [TDiscussController::class, 'discussCourse'])->name('discuss-course');
    Route::post('/discussion/{courseId}/comment', [TDiscussController::class, 'postComment'])->name('discussion.comment');

    Route::post('/buy-course/{id}', [PaymentController::class, 'buyCourse'])->name('buy.course');
    Route::post('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');
    Route::post('/retry-payment/{order_id}', [PaymentController::class, 'retryPayment'])->name('troopers.retry-payment');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth','admin'])
->prefix('manage')
->name('admin.')
->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('categories', CategoryController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('types', TypeController::class);
    Route::resource('sliders', SliderController::class);
    Route::resource('users', UserController::class);
    Route::post('/admin/users/import', [UserController::class, 'importExcel'])->name('users.import');
    Route::resource('courses', CourseController::class);
    Route::post('/courses/import', [CourseController::class, 'importExcel'])->name('courses.import');
    Route::get('/admin/discuss', [DashboardController::class, 'adminDiscussCourse'])->name('discuss-course');
    
    Route::get('/courses/{course_id}/videos', [CourseVideoController::class, 'index'])->name('videos.index');
    Route::get('/courses/{course_id}/videos/create', [CourseVideoController::class, 'create'])->name('videos.create');
    Route::get('/courses/{course_id}/videos/{id}/edit', [CourseVideoController::class, 'edit'])->name('videos.edit');
    Route::put('/videos/{id}', [CourseVideoController::class, 'update'])->name('videos.update');
    Route::delete('/videos/{id}', [CourseVideoController::class, 'destroy'])->name('videos.destroy');
    Route::post('/videos', [CourseVideoController::class, 'store'])->name('videos.store');
    Route::post('/video-upload/large', [CourseVideoController::class, 'upload'])->name('videos.upload')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
});

require __DIR__.'/auth.php';
