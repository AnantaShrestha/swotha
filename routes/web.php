<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|backend/blog/12/show
*/

use App\Articles;
use App\Contact;
use App\Enquiry;
use App\PayementDetails;
use App\Payment;
use App\Reviews;
use App\TPayment;
use App\TripDates;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['web']], function () {
    Auth::routes();
    Route::resource('/review', 'ReviewController');

    Route::group(['middleware' => ['auth', 'isAdmin']], function () {
		Route::get('/admin', function()
		{
            $reviewCount = Reviews::where('is_accepted', '=', null)->count();

            $enquiry = Enquiry::where('reply_message', '=', null)->count();

            $paid0 = Payment::where(function ($query) {
                $query->where('status', '=', 'fullpaid')->where('online_paid', '=', 0)->orWhere('status', '=', 'halfpaid');
			})->count();

            $paid1 = TPayment::where(function ($query) {
                $query->where('status', '=', 'fullpaid')->where('online_paid', '=', 0)->orWhere('status', '=', 'halfpaid');
			})->count();

			$paid = $paid0 + $paid1;

            $paid2 = Payment::where('status', '=', 'canceled')->count();

            $paid3 = TPayment::where('status', '=', 'canceled')->count();

			$paid4 = $paid2 + $paid3;

            $paid5 = Payment::where('status', '=', 'postponed')->count();
            $paid6 = TPayment::where('status', '=', 'postponed')->count();

			$paid7 = $paid5 + $paid6;

            $online_pay = Payment::where('online_paid', '=', 1)->where('status', '!=', 'postponed')->count();

            $online_trippay = TPayment::where('online_paid', '=', 1)->where('status', '!=', 'postponed')->count();

			$all_online_payment = $online_pay + $online_trippay;

            $blog = Articles::where('is_published', '=', 0)->count();

//        $feedback = \App\Feedback::where('is_accepted','=','0')->count();
            $a = TripDates::where('discount', '!=', NULL)->get();
			$count = 0;
			foreach ($a as $s){
				if(strtotime($s->start_date) < strtotime('-3 month ago')
					and strtotime($s->start_date) > strtotime('now')){
					$count++;
				}
			}

            $fixed = TripDates::where('discount', '=', NULL)->get();
			$count1 = 0;
			foreach ($fixed as $s){
				if(strtotime($s->start_date) > strtotime('now')){
					$count1++;
				}
			}

            $contactsCount = Contact::count();

            $pendingPayments = Payment::where('status', '=', 'pending')->count();
            $pendingTripPayments = TPayment::where('status', '=', 'pending')->count();

            $onlineP = PayementDetails::all()->count();

			return view('admin-panel.dashboard',compact('reviewCount','pendingPayments','pendingTripPayments',
				'count','paid','blog','enquiry','count1','paid4','paid7', 'contactsCount','onlineP','all_online_payment'));

		});

		Route::get('/clear-cache', function() {
			Artisan::call('cache:clear');
			Artisan::call('view:clear');
			return redirect()->back();
		})->name('clear-cache');

		Route::get('/backend/onlinepaymentdetails','PaymentController@showonlinepaymentdetails');
		Route::get('/backend/attemptpaymentdetails','PaymentController@showattemptpaymentdetails');
		Route::get('/showonlinepaidinvoice/{id}','PaymentController@showpaidinvoice');
		Route::resource('/backend/destinations', 'DestinationsController');
		Route::post('/backend/destinations/changeImage', 'DestinationsController@changeImage')->middleware('optimizeImages');
		Route::post('/backend/destinations/ImageChange', 'DestinationsController@imageChange')->middleware('optimizeImages');
		Route::resource('/backend/gallery', 'GalleryColtroller');
		Route::post('/backend/gallery/createMap', 'GalleryColtroller@addmap')->middleware('optimizeImages');
		Route::post('/backend/gallery/addmap', 'GalleryColtroller@uploadmap')->middleware('optimizeImages');
		Route::post('/backend/users/changestatus', 'UserController@changestatus');
		Route::resource('/backend/cities', 'CitiesController');
		Route::post('/backend/cities/changeImage', 'CitiesController@changeImage')->middleware('optimizeImages');
		Route::post('/backend/cities/ImageChange', 'CitiesController@imageChange')->middleware('optimizeImages');
		Route::resource('/backend/trips', 'TripsController');
		Route::post('/backend/trips/image', 'TripsController@ImageChange')->middleware('optimizeImages');
		Route::post('/backend/trips/changeImage', 'TripsController@changeImage')->middleware('optimizeImages');
		Route::resource('/backend/styles', 'StyleController');
		Route::resource('/backend/users', 'UserController');
		Route::resource('/backend/themes', 'ThemeController');
		Route::post('/backend/themes/changeImage', 'ThemeController@changeImage')->middleware('optimizeImages');
		Route::post('/backend/themes/ImageChange', 'ThemeController@ImageChange')->middleware('optimizeImages');
		Route::resource('/backend/itenaries', 'ItenaryController');
		Route::get('/backend/trips/pdf/{id}', 'pdfController@makepdf');
		Route::get('/backend/bulkpdf', 'pdfController@bulkpdf');

		//added later_itinerary
		Route::post('/backend/itenaries/addOne','ItenaryController@createone');
		Route::post('/backend/itenaries/saveOne','ItenaryController@saveone');
		Route::resource('/backend/tripdates', 'TripDateController');
		Route::resource('/backend/equipments', 'EquipmentsController');
		Route::post('/backend/review/show/{id}', 'ReviewsController@show');
		Route::get('/backend/review/show/{id}', 'ReviewsController@show');
		Route::post('/backend/review/approve', 'ReviewsController@approve')->name('approve.review');
		Route::post('/backend/reviews/delete/{reviewId}', 'ReviewsController@deleteReview');
		Route::post('/backend/feadback/delete/{reviewId}', 'ReviewsController@deleteFeadback');
		Route::resource('/backend/review', 'ReviewsController');
		Route::resource('/backend/feedback', 'FeedbacksController');
		Route::resource('/backend/deal', 'DealsController');
		Route::get('/backend/fixed', 'DealsController@indexfixed');
		Route::resource('/backend/tripfaq', 'TripFaqController');

		Route::post('/backend/feedback/approve', 'FeedbacksController@approve');
		Route::resource('/backend/indexcoverimage', 'BackEndIndexCoverController');
		Route::get('/backend/payments', 'BackendPaymentController@showPending');
		Route::get('/backend/tripspayments', 'BackendPaymentController@showTripPending');
		Route::get('/backend/bookings', 'BackendPaymentController@showBookings');
		Route::get('/backend/onlinebookings', 'BackendPaymentController@showonlineBookings');
		Route::post('/backend/confirmedbookings/{id}', 'BackendPaymentController@deleteConfirmedBooking');
		Route::post('/backend/confirmedbookings/custom/{id}', 'BackendPaymentController@deleteCustomConfirmedBooking');
		Route::get('/backend/cancelledbookings', 'BackendPaymentController@showcancelledBookings');
		Route::post('/backend/cancelledbookings/{id}', 'BackendPaymentController@deleteCancelledBookings');
		Route::post('/backend/cancelledbookings/custom/{id}', 'BackendPaymentController@deleteCustomCancelledBookings');
		Route::get('/backend/postponedbookings', 'BackendPaymentController@showpostponedBookings');
		Route::post('/backend/postponedbookings/{id}', 'BackendPaymentController@deletepostponedBookings');
		Route::post('/backend/customPostponedbookings/{id}', 'BackendPaymentController@deleteCustomPostponedBookings');
		Route::get('/backend/show/{bid}','BackendPaymentController@show');
		Route::post('/backend/bookdelete/{id}','BackendPaymentController@deletebook');
		Route::post('/backend/booktripdelete/{id}','BackendPaymentController@deletetripbook');

		Route::get('/backend/showtrips/{bid}','BackendPaymentController@showtrips');
		Route::get('/backend/restorefixed/{bid}','BackendPaymentController@restorefixed');
		Route::get('/backend/restorenormal/{bid}','BackendPaymentController@restorenormal');

		Route::get('/backend/payments/{bid}', 'BackendPaymentController@confirm');
		Route::get('/backend/tripspayments/{bid}', 'BackendPaymentController@confirmtrips');

		Route::get('/backend/cancelBookings/{bid}', 'BackendPaymentController@cancelbooking');
		Route::get('/backend/cancelTripBookings/{bid}', 'BackendPaymentController@cancelTripBooking');
		Route::post('/backend/postponedBookings/{bid}', 'BackendPaymentController@postponedbooking');
		Route::post('/backend/postponedTripBookings/{bid}', 'BackendPaymentController@postponedTripBooking');

		Route::post('/backend/indexcoverimage/changeimage', 'BackEndIndexCoverController@changeImage')->middleware('optimizeImages');
		Route::post('/backend/indexcoverimage/ImageChange', 'BackEndIndexCoverController@imageChange')->middleware('optimizeImages');
		Route::get('/backend/indexcovervideo/addvideo', 'BackEndIndexCoverController@addvideo');
		Route::post('/backend/indexcovervideo/storevideo', 'BackEndIndexCoverController@storevideo');
		Route::post('/backend/enquiry/deleteMultiple', 'EnquiryController@deleteMultiple');
		Route::get('/backend/enquiry', 'EnquiryController@show');
		Route::get('/backend/enquiry/{id}', 'EnquiryController@view');
		Route::post('/backend/enquiry/{id}', 'EnquiryController@delete');

		Route::resource('/backend/about', 'About1Controller');
		Route::get('/backend/about/add', 'About1Controller@create');
		Route::get('backend/about/seo/{id}', 'About1Controller@seosectionshow')->middleware('optimizeImages');
		Route::post('backend/about/seo/{id}/change', 'About1Controller@seosectionchange')->middleware('optimizeImages');


		//for csr
		Route::post('/changecustom','TripsController@changecustom');
		Route::post('/changeforeign', 'TripsController@changeForeign');

		Route::get('/backend/team', 'TeamController@index');

		Route::post('/backend/about/team', 'TeamController@teamcreate')->middleware('optimizeImages');
		Route::post('/backend/about/teamstore', 'TeamController@teamstore');
		Route::get('/backend/about/teamedit/{id}', 'TeamController@teamedit')->middleware('optimizeImages');
		Route::post('/backend/about/teamupdate', 'TeamController@teamupdate');


		Route::resource('/backend/team','TeamController');

		Route::get('/backend/muldocs/{id}','TeamController@muldocs');
		Route::post('/backend/addmuldocs','TeamController@storemuldocs')->middleware('optimizeImages');
		Route::get('/deletedoc/{id}', array('as' => 'delete_doc','uses' => 'TeamController@destroyimage'));


        Route::get('/invoice/{id}','TestController@invoice');
		Route::get('/paidinvoice/{id}','TestController@paidinvoice');
		Route::get('/tripsinvoice/{id}','TestController@tripsinvoice');
		Route::get('/paidtripsinvoice/{id}','TestController@paidtripsinvoice');
		Route::get('/onlinepaidtripsinvoice/{id}','TestController@onlinepaidtripsinvoice');

        Route::get('/backend/unblog','BlogController@unindex');
		Route::get('/backend/gallery/show/{id}','GalleryColtroller@show');
		Route::get('/backend/gallery/edit/{id}','GalleryColtroller@edit');
		Route::post('/backend/gallery/update/{id}','GalleryColtroller@update');
//    Route::post('/backend/gallery/{id}','GalleryColtroller@delete');

        Route::get('/backend/blog/create','BlogController@create')->middleware('optimizeImages');
		Route::post('/backend/blog/store','BlogController@store')->middleware('optimizeImages');
		Route::get('/backend/blog/deleteSection/{sectionId}', 'BlogController@deleteSection');
		Route::resource('/backend/blog','BlogController');
		Route::get('/backend/blog/{id}/show','BlogController@show');
		Route::post('/backend/blog/updatePhoto/{id}', 'BlogController@addPhoto')->middleware('optimizeImages');
		Route::get('/backend/blog/addSection/{blogId}', 'BlogController@addSection')->middleware('optimizeImages');;
		Route::get('/backend/blog/section/{sectionId}', 'BlogController@editSection')->middleware('optimizeImages');;
		Route::post('/backend/blog/updateSection/{sectionId}', 'BlogController@updateSection')->middleware('optimizeImages');;
		Route::post('/backend/blog/addSection/{blogId}', 'BlogController@storeSection')->middleware('optimizeImages');;
		Route::post('/backend/blog/{id}/publish','BlogController@publish');
		Route::post('/backend/blog/{id}/unpublish','BlogController@unpublish');

        Route::get('/backend/mulimages/{id}','BlogController@mulimages');
		Route::post('/backend/addmulimages','BlogController@storemulimages')->middleware('optimizeImages');
		Route::get('/deleteimage/{id}', array('as' => 'delete_image','uses' => 'BlogController@destroyimage'));

        Route::resource('/backend/blogcategory','CategoryController');
		Route::resource('/backend/department','DepartmentsController');
		Route::resource('/backend/customtrip','CustomTripController');

        Route::get('/backend/trips/duplicate/{id}', 'DuplicateController@duplicate');
		Route::get('/backend/duplicate/{id}', 'DuplicateController@show');
		Route::get('/backend/duplicate/{id}/edit', 'DuplicateController@edit');
		Route::patch('/backend/duplicate/{id}', 'DuplicateController@update');
		Route::delete('/backend/duplicate/{id}', 'DuplicateController@destroy');


        //Frequently Asked Questions (FAQ)
		Route::get('/backend/faq','FaqController@index');
		Route::post('/backend/faq/addTopic', 'FaqController@addTopic');
		Route::get('/backend/faq/editTopic/{id}', 'FaqController@editTopic');
		Route::post('/backend/faq/editTopic/{id}', 'FaqController@updateTopic');
		Route::post('/backend/faq/deleteTopic/{id}', 'FaqController@deleteTopic');
		Route::get('/backend/faq/questions/{id}', 'FaqController@showQuestions');
		Route::post('/backend/faq/addQuestion/{id}', 'FaqController@addQuestion');
		Route::post('/backend/faq/deleteQuestion/{id}', 'FaqController@deleteQuestion');
		Route::get('/backend/faq/question/{id}', 'FaqController@showDescription');
		Route::post('/backend/faq/editQuestion/{id}', ['as'=>'edit_faq_question', 'uses'=>'FaqController@updateQuestion']);

        //Extra Packages(services) of trips
		Route::get('/backend/extrapackages', 'ExtraPackagesController@index');
		Route::get('/backend/extrapackages/create', 'ExtraPackagesController@create');
		Route::get('/backend/extrapackages/{id}/edit', 'ExtraPackagesController@edit');
		Route::post('/backend/extrapackages/update/{id}', 'ExtraPackagesController@update')->middleware('optimizeImages');
		Route::post('/backend/extrapackages/store', 'ExtraPackagesController@store')->middleware('optimizeImages');
		Route::post('/backend/extrapackages/{id}', 'ExtraPackagesController@destroy');

        Route::post('/backend/trips/extraPackages/{id}', 'ExtraPackagesController@addToTrip');
		Route::post('/backend/trips/extraPackages/delete/{id}', 'ExtraPackagesController@deletePackageFromTrip');

        //Trip Packages classification of trips
		Route::get('/backend/tripPackages', 'TripPackageController@index');
		Route::get('/backend/tripPackage/create', 'TripPackageController@create')->middleware('optimizeImages');
		Route::post('/backend/tripPackage/store', 'TripPackageController@store');
		Route::post('/backend/deletePackage/{packageId}', 'TripPackageController@destroy');
		Route::get('/backend/tripPackages/edit/{packageId}', 'TripPackageController@edit');
		Route::post('/backend/tripPackage/update/{packageId}', 'TripPackageController@update')->middleware('optimizeImages');
		Route::get('/backend/tripPackages/addTrips/{packageId}', 'TripPackageController@addTrips');
		Route::post('/backend/tripPackages/attachTrips/{packageId}', 'TripPackageController@attachTrips');
		Route::post('backend/tripPackages/detachTrips/{packageId}', 'TripPackageController@detachTrips');


        Route::get('/searchseo','SearchSeoController@index');

        Route::post('/changesearchbar','SearchSeoController@changesearchbar');
		Route::post('/changetitle','SearchSeoController@changetitle');
		Route::post('/changedescription','SearchSeoController@changetitle');
		Route::post('/changekeywords','SearchSeoController@changetitle');

		Route::get('backend/terms-and-condition', 'TermsnConditionController@view');
		Route::get('backend/terms-and-condition/create', 'TermsnConditionController@create');
		Route::post('backend/terms-and-condition/store', 'TermsnConditionController@store')->name('backend-terms-and-condition-store');
		Route::get('backend/terms-and-condition/show/{id}', 'TermsnConditionController@show')->name('backend-terms-and-condition-show');
		Route::get('backend/terms-and-condition/edit/{id}', 'TermsnConditionController@edit')->name('backend-terms-and-condition-edit');
		Route::post('backend/terms-and-condition/delete/{id}', 'TermsnConditionController@delete')->name('backend-terms-and-condition-delete');
		Route::post('backend/terms-and-condition/update/{id}', 'TermsnConditionController@update')->name('backend-terms-and-condition-update');
		Route::get('backend/terms-and-condition/selected/{id}', 'TermsnConditionController@selected')->name('backend-terms-and-condition-selected');

		Route::get('backend/deposit-and-cancellation-policy', 'DepositCancelController@view');
		Route::get('backend/deposit-and-cancellation-policy/create', 'DepositCancelController@create');
		Route::post('backend/deposit-and-cancellation-policy/store', 'DepositCancelController@store')->name('backend-deposit-and-cancellation-policy-store');
		Route::get('backend/deposit-and-cancellation-policy/show/{id}', 'DepositCancelController@show')->name('backend-deposit-and-cancellation-policy-show');
		Route::get('backend/deposit-and-cancellation-policy/edit/{id}', 'DepositCancelController@edit')->name('backend-deposit-and-cancellation-policy-edit');
		Route::post('backend/deposit-and-cancellation-policy/delete/{id}', 'DepositCancelController@delete')->name('backend-deposit-and-cancellation-policy-delete');
		Route::post('backend/deposit-and-cancellation-policy/update/{id}', 'DepositCancelController@update')->name('backend-deposit-and-cancellation-policy-update');
		Route::get('backend/deposit-and-cancellation-policy/selected/{id}', 'DepositCancelController@selected')->name('backend-deposit-and-cancellation-policy-selected');

		Route::get('backend/sitemaps', 'SitemapsController@view');
		Route::get('backend/sitemaps/create', 'SitemapsController@create');
		Route::post('backend/sitemaps/store', 'SitemapsController@store')->name('backend-sitemaps-store');
		Route::get('backend/sitemaps/show/{id}', 'SitemapsController@show')->name('backend-sitemaps-show');
		Route::get('backend/sitemaps/edit/{id}', 'SitemapsController@edit')->name('backend-sitemaps-edit');
		Route::post('backend/sitemaps/delete/{id}', 'SitemapsController@delete')->name('backend-sitemaps-delete');
		Route::post('backend/sitemaps/update/{id}', 'SitemapsController@update')->name('backend-sitemaps-update');

		Route::get('send/customemail/{id}','PaymentController@sendmail')->name('send-email-custom');

	});


    Route::get('/brochure', 'TestController@showbrochure');

    Route::get('/', 'TestIndexController@index'); //this is nice


//    Route::group(['domain' => 'swotahtravel.test'], function()
//    {
//    Route::get('/', 'TestIndexController@index'); //this is nice
//
//    });

//    Route::domain('{account}.swotahtravel.test')->group(function () {
//        Route::get('/', ['as' => 'index', 'uses' => 'UserProfileController@index'])->middleware("auth");
//    });

    Route::get('/home', ['as' => 'home', 'uses' => 'IndexController@index']);
//	Route::get('/destination/{slug}', 'FrontDestinationController@show');
//	Route::get('/region/{slug}', 'FrontCityController@show');
//	Route::get('/venture/{slug}', 'FrontendThemeController@show');

    Route::get('search', ['as' => 'search', 'uses' => 'TripSearchController@index']);
    Route::get('/compare/{triplist}', 'TripCompareController@compare');

    Route::get('/profile/{user}', 'UserProfileController@index')->middleware('auth')->name('profile');
    Route::get('/profile/payment/store', 'UserProfileController@paymentadd')->middleware('auth')->name('profilepaymentadd');
    Route::get('/profile/payment/update/{id}', 'UserProfileController@paymentupdate')->middleware('auth')->name('profilepaymentupdate');
    Route::get('/profile/payment/delete/{id}', 'UserProfileController@paymentdelete')->middleware('auth')->name('profilepaymentdelete');
    Route::get('/bookdetails/{id}', 'UserProfileController@bookdetails')->middleware('auth');
    Route::post('/submit/document', 'UserProfileController@submitdocument')->middleware('auth');
    Route::post('/submit/documents', 'UserProfileController@submitdocuments')->middleware('auth');
    Route::get('/profile/edit/resend/{id}', 'UserProfileController@resendVerification');
    Route::get('/primaryverify/{code}', 'TestController@confirm');

    Route::get('/profilesetting', function(){
		return view('frontend.userprofile.profileSetting');
	});

    Route::get('confirmuser/{code}', 'ConfirmController@confirm');

	Route::get('/wish/{id}','WishListController@addtowishlist')->middleware('auth');
	Route::get('/wish','WishListController@index')->middleware('auth');
	Route::get('/removewish/{id}','WishListController@removewish')->middleware('auth');
	Route::post('/remove','WishListController@remove')->middleware('auth');
	Route::post('/removeallwish','WishListController@removeallwish')->middleware('auth');
	Route::post('/addwish','WishListController@addwish')->middleware('auth');
	Route::post('/hold/{id}', 'HoldController@hold')->middleware('auth');
	Route::post('/backend/holds/cancel/{id}', 'HoldController@cancelReply');
	Route::get('/holdconfirm/{confirmation}', 'HoldController@confirm')->middleware('auth');
	Route::get('/terms','TestController@test');


//	Route::get('/book/{id}','BookingController@check')->middleware('auth');
//	Route::post('/booking/step2','BookingController@step2')->middleware('auth');
//	Route::post('/booking/step3','BookingController@step3')->middleware('auth');
//	Route::post('/booking/step4','BookingController@step4')->middleware('auth');
//	Route::post('/booking/confirm','BookingController@confirm')->middleware('auth');

    Route::post('/custombook/step2', 'CustomBookingController@step2')->middleware('auth');
	Route::post('/custombook/step3', 'CustomBookingController@step3')->middleware('auth');
	Route::post('/custombook/step4', 'CustomBookingController@step4')->middleware('auth');
	Route::post('/custombook/confirm', 'CustomBookingController@confirm')->middleware('auth');

//	Route::get('/trip/book/{id}','TripBookingController@book')->middleware('auth');
//	Route::post('/trip/booking/step2','TripBookingController@step2')->middleware('auth');
//	Route::post('/trip/booking/step3','TripBookingController@step3')->middleware('auth');
//	Route::post('/trip/booking/step4','TripBookingController@step4')->middleware('auth');
//	Route::post('/trip/booking/confirm','TripBookingController@confirm')->middleware('auth');

    Route::get('/custom-trip/{id}', 'FrontTripController@customtrip')->middleware('auth');
	Route::post('/groupdiscount','FrontTripController@groupdiscount');
	Route::post('/porterpriceup','FrontTripController@porterpriceup');
	Route::post('/porterpricedown','FrontTripController@porterpricedown');
	Route::get('/transport','FrontTripController@transport');
	Route::post('/accomodation','FrontTripController@accomodation');
	Route::post('/tour','FrontTripController@tour');
	Route::post('/meal','FrontTripController@meal');

//for routes custom trips
	Route::post('/guideup','FrontTripController@guideup');
	Route::post('/guidedown','FrontTripController@guidedown');

    Route::post('/sherpaup','FrontTripController@sherpaup');
	Route::post('/sherpadown','FrontTripController@sherpadown');

    Route::post('/assistantup','FrontTripController@assistantup');
	Route::post('/assistantdown','FrontTripController@assistantdown');

    Route::post('/roomup','FrontTripController@roomup');
	Route::post('/roomdown','FrontTripController@roomdown');

    Route::any('/mohan','FrontTripController@mohan');
//	Route::get('/about/{slug}','FrontendAboutController@show');

    Route::get('/corporate-social-responsibility/detail-{slug}', 'FrontendAboutController@showcontent');

//	Route::get('/allmembers/{slug}','FrontTeamController@index');
    Route::get('/our-team/member-{id}', 'FrontTeamController@show');

	Route::get('/fixed-departures','FixedDepartureController@index');

	Route::get('/pdf','FixedDepartureController@pdfview');

	Route::post('/enquiry','EnquiryController@store');
	Route::post('/request-a-brochure','EnquiryController@brochurestore');

//Route::get('webhook','EnquiryController@receive');
//Route::post('webhook','EnquiryController@receive');


//login with facebook
	Route::get('login/facebook', 'Auth\LoginController@redirectToProvider')->middleware('guest');
	Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback')->middleware('guest');

    Route::get('/member', function (){
		return view('frontend.about.teammembers');
	});

    Route::get('/profSetting', function (){
		return view('frontend.profileSetting');
	});

    Route::get('/invoice', function (){
		return view('frontend.InvoiceTemplate.invoiceTemplate');
	});

    Route::get ('/check',function(){
		return view ('frontend.booking.tripbook.invoice');
	});
	Route::get ('/in',function(){
		return view ('frontend.InvoiceTemplate.in');
	});
	Route::get ('/trp',function(){
		return view ('frontend.custombook.customtrip');
	});
	Route::get ('/alogin',function(){
		return view ('auth.agentregister');
	});


    Route::get('/agent/register', 'AgencyController@create');

    Route::post('/agent/register', 'AgencyController@store');


    Route::get('/backend/agencies', 'AgencyController@index')->middleware('auth');

    Route::get('/backend/agencies/{id}', 'AgencyController@show')->middleware('auth');

    Route::DELETE('/backend/agencies/{id}', 'AgencyController@destroy')->middleware('auth');

    Route::get('/blogs', 'FrontBlogController@index');

    Route::get('/blogs/{slug}', 'FrontBlogController@redirectTo')->name('blog-path');

	Route::get('/backend/trips/duplicate/{id}', 'DuplicateController@duplicate')->middleware('auth');

    Route::get('/backend/duplicate/{id}', 'DuplicateController@show')->middleware('auth');

    Route::get('/backend/duplicate/{id}/edit', 'DuplicateController@edit')->middleware('auth')->middleware('optimizeImages');

    Route::patch('/backend/duplicate/{id}', 'DuplicateController@update')->middleware('auth');

    Route::delete('/backend/duplicate/{id}', 'DuplicateController@destroy')->middleware('auth');

    Route::post('/profile/edit/{id}', 'UserProfileController@update');
	Route::get('/profile/edit/resendprimary/{id}', 'UserProfileController@resendPrimary');

    Route::post('/profile/ajax/edit/{id}', 'UserProfileController@makePrimary');

    Route::post('/backend/brochure/deleteMultiple', 'EnquiryController@deleteBrochures');
	Route::post('/backend/brochure/{id}', 'EnquiryController@deleteBrochureRequest')->middleware('auth');

    Route::post('/backend/enquiry/reply/{email}', 'EnquiryController@reply')->middleware('auth');

    Route::get('/secondaryverify/{code}', 'TestController@secondaryVerify');

    Route::get('/backend/holds', 'HoldController@index')->middleware('auth');

    Route::get('/backend/hold/{id}', 'HoldController@destroy')->middleware('auth');
	Route::get('/hold/destroy/{id}', 'HoldController@cancelHold')->middleware('auth');

//Routes Related to coupons
	Route::get('/backend/coupons', 'CouponController@index')->middleware('auth');
	Route::delete('/backend/coupons/destroy/{id}', 'CouponController@destroy')->middleware('auth');
	Route::post('/backend/coupons/add', 'CouponController@add')->middleware('auth');
	Route::post('/backend/coupon/deleteMultiple', 'CouponController@deleteMultiple')->middleware('auth');


//For contacts
	Route::get('/contact-us',function (){
		return view('layouts.contact');
	});

    Route::post('/contact', 'ContactController@store');
	Route::get('/backend/contacts', 'ContactController@index')->middleware('auth');
	Route::delete('/backend/contacts/destroy/{id}', 'ContactController@destroy')->middleware('auth');
	Route::post('/backend/contacts/deleteMultiple', 'ContactController@deleteMultiple')->middleware('auth');

    Route::post('/submitcoupon1','BookingController@coupondiscount1');
	Route::post('/submitcoupon2','BookingController@coupondiscount2');

    Route::post('/submittripcoupon1','TripBookingController@tripcoupondiscount1');
	Route::post('/submittripcoupon2','TripBookingController@tripcoupondiscount2');

    Route::post('/submitctripcoupon1','CustomBookingController@ctripcoupondiscount1');
	Route::post('/submitctripcoupon2','CustomBookingController@ctripcoupondiscount2');

    Route::post('/backend/holds/deleteMultiple', 'HoldController@deleteMultiple');

    Route::get('/backend/seo/add', 'SeoController@create')->middleware('auth');
	Route::get('/backend/seoblog/add', 'SeoController@createblog')->middleware('auth');

    Route::post('/backend/seo/saveOne', 'SeoController@store')->middleware('auth');
	Route::post('/backend/seoblog/saveOne', 'SeoController@storeblog')->middleware('auth');

//Related to trekking partners
	Route::get('/backend/trekkingpartners', 'PartnerController@index');
	Route::delete('/backend/trekkingpartners/delete/{id}', 'PartnerController@destroy');
	Route::get('/backend/trekkingpartners/show/{id}', 'PartnerController@show');

//Increase decrease remaining seats by super admin
	Route::post('/backend/deal/increase', 'DealsController@changeSeats');

//About Pages
	Route::get('/backend/about/addSection/{id}', 'About1Controller@addSection')->middleware('auth');
	Route::post('/backend/about/addSection/create/{id}', 'About1Controller@createSection')->middleware('auth');
	Route::get('/backend/about/editSection/{id}', 'About1Controller@editSection')->middleware('auth');
	Route::post('/backend/about/editSection/{id}', 'About1Controller@saveSection')->middleware('auth');
	Route::post('/backend/about/deleteSection', 'About1Controller@deleteSections')->middleware('auth');

    Route::get('/backend/parallax/add',
		'BackEndIndexCoverController@addParallax')->middleware('auth');
	Route::get('/backend/parallax/edit/{id}', 'BackEndIndexCoverController@editParallax')->middleware('auth');
	Route::post('/backend/parallax/update/{id}', 'BackEndIndexCoverController@updateParallax')->middleware('auth')->middleware('optimizeImages');
	Route::post('/backend/parallax/add',
		'BackEndIndexCoverController@storeParallax')->middleware('auth')->middleware('optimizeImages');
	Route::delete('/backend/deleteParallax/{id}',
		'BackEndIndexCoverController@deleteParallax')->middleware('auth');
	Route::post('/backend/search/placeholder', ['as'=>'updateSearch', 'uses'=>'BackEndIndexCoverController@updateSearch']);

    Route::get('/payment', function(){
		return view('frontend.newindex');
	});

//Related to trekking partners
	Route::get('/partner', 'FrontPartnerController@index');
	Route::get('/partner/destination/{id}', 'FrontPartnerController@showPosts');
	Route::get('/partner/showDetail/{id}', 'FrontPartnerController@showDetail');
	Route::get('/partner/profile/{id}', 'FrontPartnerController@showProfile');
	Route::post('/partner/post/{id}', 'FrontPartnerController@post');
	Route::post('/partner/comment/{id}', 'FrontPartnerController@comment');
	Route::post('/partner/comment/edit/{commentId}', 'FrontPartnerController@editComment');
	Route::post('/partner/reply/{id}', 'FrontPartnerController@reply');
	Route::post('/partner/reply/edit/{replyId}', 'FrontPartnerController@editReply');
	Route::get('/partner/deleteComment/{id}', 'FrontPartnerController@deleteComment');
	Route::get('/partner/deleteReply/{id}', 'FrontPartnerController@deleteReply');
	Route::get('/partner/deletePost/{postId}', 'FrontPartnerController@deletePost');
	/*end of trekking partners */

//Front FAQ
    Route::get('/faq/', 'FrontFaqController@show');
	Route::get('/faq/{id}', 'FrontFaqController@topicQuestions');


    Route::post('/paymentsuccess', 'PaymentController@show'); /*frontend call back url to be hit by himalayan bank*/

//Route::post('/paymentsuccess', )

    Route::get('/custompayment', function(){
		return view('frontend.custompayment.inputformwithinvoice');
	});

    Route::get('/custompayment1', function(){
        return view('frontend.custompayment.inputformwithinvoice');
    });

    Route::get('/custompayment/invoice/{number}','PaymentController@searchinvoice');
	Route::post('/processpay', 'PaymentController@processpay');
	Route::post('/processpay/invoice', 'PaymentController@processpay_invoice')->name('payment-invoice');

    Route::post('/backend/paymentsuccess', 'PaymentController@store');/*backend call back url to be hit by himalayan bank*/

    Route::post('/generatelastminuteinvoice','PaymentController@storelastandfixed');
	Route::post('/generatenormalinvoice','PaymentController@storenormaltrips');
	Route::post('/generatecustomizedtripinvoice','PaymentController@storecustomizedtrip')->name('generate-invoice');


    Route::get('/msb', function(){
		return view('frontend.paymentsuccess');
	});

    Route::get('/email', function(){
		return view('emails.naya');
	});

//	Route::get('/test', 'TestIndexController@index');f
//
	Route::get('/naya', function(){
		return view('frontend.nayaindex');});

    Route::post('/currency/convert', 'CurrencyController@convert');

//Blog at frontend
	Route::get('/blog/create', 'FrontBlogController@create');
	Route::post('/blog/add', 'FrontBlogController@store')->middleware('optimizeImages');
	Route::get('/blog/edit/{id}', 'FrontBlogController@edit');
	Route::post('/blog/update/{id}', 'FrontBlogController@update')->middleware('optimizeImages');
	Route::post('/blog/delimage/{id}', 'FrontBlogController@deleteOtherImage');

    Route::get('/trip-pdf/{id}', 'pdfController@downloadpdf')->middleware('auth');

//	Route::get('/alltrips/{id}', 'TestIndexController@yestrips');

	Route::post('/emailsubscribe','EmailSubscribeController@insert');

    Route::get('/book/{id}','FixedandLastController@showform')->middleware('auth');
	Route::get('/holdbook/{id}','FixedandLastController@showform1')->middleware('auth');
    Route::get('/book-trip/{id}', 'NormalBookController@showform')->middleware('auth');
	Route::post('/trip/book/{id}','NormalBookController@showform')->middleware('auth');

    Route::get('/book',function(){
		return view('frontend.newbooking.onepagebook');
	});

    Route::post('/changegroupdiscount','FixedandLastController@changegroupdiscount');
	Route::post('/changetripgroupdiscount','NormalBookController@changegroupdiscount');
	Route::post('/changedeparture','NormalBookController@changedeparture');
	Route::post('/changingcoupon','FixedandLastController@changecoupondiscount');
	Route::post('/changingtripcoupon','NormalBookController@changecoupondiscount');

	Route::post('/savealldata','FixedandLastController@savefirstdata');
	Route::post('/savealltripdata','NormalBookController@savefirstdata');
	Route::post('/saveallcustomtripdata','ThreeBookController@savefirstdata');

    Route::post('/book-confirm','FixedandLastController@savealldata');
	Route::post('/tripbook-confirm','NormalBookController@savealldata');
	Route::post('/customtripbook-confirm','ThreeBookController@savealldata');

    Route::post('/proceedonline','FixedandLastController@savedataonline');
	Route::post('/tripproceedonline','NormalBookController@savedataonline');
	Route::post('/customtripproceedonline','ThreeBookController@savedataonline');

    Route::post('/custombook/one', 'ThreeBookController@showform')->middleware('auth');

    Route::get('/viewreviews', 'ShowallreviewsController@allreviews');
	Route::post('/upload-image','ReviewController@changeimage');
    Route::post('/backend-upload-image/{id}','ReviewsController@instantImageReview');

    Route::get('terms-and-condition' , 'TermsnConditionController@index');
    Route::get('deposit-and-cancellation-policy' , 'DepositCancelController@index');
    Route::get('sitemaps' , 'SitemapsController@index');


    Route::get('404e' , function(){
    	return view('frontend.error.404');
    });

    Route::get('fixed-departures/search','FixedDepartureController@search');
    Route::get('city/destination','FrontFilterController@filter1')->name('city-by-destination');
    Route::get('days/city','FrontFilterController@filter2')->name('days-by-cities');
    Route::get('price/days','FrontFilterController@filter3')->name('price-by-days');

    Route::get('filter','FrontFilterController@searchresult')->name('search-filter');

    Route::post('show/fixeddepbymonth','FrontTripController@fixeddepbymonth')->name('showfixeddep');
    /*Route::get('/reviewform',function(){
        return view('frontend.testindex');
    });*/

    Route::get('holdthetrip/{id}', 'HoldController@holdthetrip')->name('hold-trip')->middleware('auth');

    Route::pattern('slug', '[a-z0-9-]+');

//    Route::get('/reviewform',function(){
//        return view('frontend.testindex');
//    });
//
//    Route::get('/trip/{slug}',function($slug){
//        return Redirect::to('/'.$slug.'');
//    });
//
//    Route::get('/about/{slug}',function($slug){
//        return Redirect::to('/'.$slug.'');
//    });

    Route::get('/{slug}', 'FrontTripController@redirectTo')->name('show-path');
});
