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

/*Route::get('/', function () {
    return view('listings.search');
})->name('home');*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin']);
    Route::get('/register', [AuthController::class, 'showRegister']);
});

// guest
Route::get('/provider/listings/create', CreateListing::class)
                ->name('provider.listings.create');
Route::get('/provider/listings', [ListingController::class, 'index'])->name('provider.listings');
        Route::post('/listings', [ListingController::class, 'store'])->name('listings.store');
Route::get('/listings/{id}', [EnquiryController::class, 'index'])->name('index');

/*Route::get('/listings/{listing}', function (Listing $listing) {
    return view('listings.show', compact('listing'));
})->name('listings.show');*/

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


/*Route::get('/listings/{listing}', function (Listing $listing) {
    return view('listings.show', compact('listing'));
})->name('listings.show');*/

/*
|--------------------------------------------------------------------------
| Authenticated
|--------------------------------------------------------------------------
*/

/*Route::middleware(['auth', 'role:customer'])->group(function () {

        Route::get('/provider/listings/create', CreateListing::class)
                ->name('provider.listings.create');

        Route::get('/provider/listings', [ListingController::class, 'index'])->name('provider.listings');

        Route::post('/enquiries', [EnquiryController::class, 'store']);





});*/


    /*
    | Provider
    */
/*
    Route::get('/provider/enquiries', function () {
        return view('provider.enquiries');
    })->name('provider.enquiries');*/

    /*
    | Customer
    *//*
    Route::get('/customer/enquiries', function () {
        return view('customer.enquiries');
    })->name('customer.enquiries');*/

    /*
    | Admin
    */
   /* Route::get('/admin/listings/pending', function () {
        return view('admin.listings.pending');
    })->name('admin.listings.pending');*/

require __DIR__.'/auth.php';
