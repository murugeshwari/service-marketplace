<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\Admin\ListingModerationController;
use App\Livewire\Listings\Search;
use App\Livewire\Provider\MyListings;
use App\Livewire\Provider\Enquiries as ProviderEnquiries;
use App\Livewire\Customer\Enquiries as CustomerEnquiries;
use App\Models\Listing;
use App\Livewire\Provider\CreateListing;
use App\Http\Controllers\ProviderEnquiryController;
use App\Http\Controllers\EnquiryReplyController;
use App\Http\Controllers\Admin\AdminEnquiryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Public (Guest)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin']);
    Route::get('/register', [AuthController::class, 'showRegister']);
});

// CUSTOMER 
Route::get('/provider/listings/create', CreateListing::class)->name('provider.listings.create');
Route::get('/provider/listings', [ListingController::class, 'index'])->name('provider.listings');
Route::post('/listings', [ListingController::class, 'store'])->name('listings.store');
Route::get('/listings/{id}', [EnquiryController::class, 'index'])->name('index');


// CUSTOMER
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::post('/enquiries', [EnquiryController::class, 'index']);
    Route::post('/enquiriessubmit', [EnquiryController::class, 'store']);
        Route::get('/my-enquiries', [EnquiryController::class, 'customerIndex'])
        ->name('my-enquiries');

});
// PROVIDER
Route::middleware(['auth', 'role:provider'])->group(function () {
    Route::get('/provider/enquiries', [ProviderEnquiryController::class, 'index']);
    Route::get('/provider/enquiries/{enquiry}', [ProviderEnquiryController::class, 'show']);
    Route::post('/provider/enquiries/{enquiry}/reply', [EnquiryReplyController::class, 'store']);
});

// admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/enquiries', [AdminEnquiryController::class, 'index']);
});


require __DIR__.'/auth.php';
