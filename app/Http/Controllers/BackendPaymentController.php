<?php

	namespace App\Http\Controllers;

	use App\BookedActivities;
    use App\BookingDetail;
    use App\BookingDiscount;
    use App\Bookings;
    use App\Coupons;
    use App\ExtraServices;
    use App\Helper\PasswordChecker;
    use App\Mail\CancelBooking;
    use App\Mail\CancelTripBooking;
    use App\Mail\ConfirmBooking;
    use App\Mail\ConfirmTripBooking;
    use App\Mail\CouponCode;
    use App\Payment;
    use App\TExtraServices;
    use App\TPayment;
    use App\TripBookedActivities;
    use App\TripBookingDetail;
    use App\TripBookingDiscount;
    use App\TripBookings;
    use App\TripDates;
    use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Mail;

    class BackendPaymentController extends Controller
	{
		/*show fixed departures pending*/
		public function showPending()
		{

			$pending = Payment::where('status', '=', 'pending')
				->where('chosen', '=', 'fullpayment')
				->get();
			$pending1 = Payment::where('status', '=', 'pending')
				->where('chosen', '=', 'confirm')
				->get();
			return view('admin-panel.bookings.pendingPayments', compact('pending', 'pending1'));
		}

		/*show trips and custom trips */
		public function showTripPending()
		{
			$pending = TPayment::where('status', '=', 'pending')
				->where('chosen', '=', 'fullpayment')
				->get();
			$pending1 = TPayment::where('status', '=', 'pending')
				->where('chosen', '=', 'confirm')
				->get();
			return view('admin-panel.tripbookings.pendingPayments', compact('pending', 'pending1'));
		}

		public function show($id)
		{
			$booking = Bookings::where('bookid', '=', $id)->first();
			$bookingDetail = BookingDetail::where('bid', '=', $id)->first();
			$bookingDetails = BookingDetail::where('bid', '=', $id)->get();
			return view('admin-panel.bookings.show', compact('bookingDetail', 'bookingDetails', 'booking'));
		}

		public function showtrips($id)
		{
			$booking = TripBookings::where('bookid', '=', $id)->first();
			$bookingDetail = TripBookingDetail::where('bid', '=', $id)->first();
			$bookingDetails = TripBookingDetail::where('bid', '=', $id)->get();

//            dd($booking->payment, $bookingDetail, $bookingDetails);
			return view('admin-panel.tripbookings.show', compact('bookingDetail', 'bookingDetails', 'booking'));
		}

        public function confirm($id)
		{


            $payment = Payment::where('bid', '=', $id)->first();

			if ($payment->chosen == "fullpayment") {
				$payment->paid_amount_sum = $payment->grandtotal;
				$payment->left_amount_sum = 0;
				$payment->status = "fullpaid";
			} else {
				$payment->paid_amount_sum = $payment->paid_amount;
				$payment->left_amount_sum = $payment->grandtotal - $payment->paid_amount;
				$payment->status = "halfpaid";
			}
			$payment->save();

            $booking = Bookings::where('bookid', '=', $id)->first();

            $price = $booking->trips->price;

            $user = $booking->user;

            /*decrease the seat of fixed departures*/
			$bookid = $booking->bookid;
			$people = $booking->people;
			$tripdate = $booking->trips;
			$nicepeople = $tripdate->remainingseats - $people;

            $tripdate->update(['remainingseats' => $nicepeople]);

            /*data to be sent for invoice template*/
            $data['tripdate'] = $payment->booking->trips->start_date;
            $invoice = $payment->bid;
			$packs = BookedActivities::where('bid', '=', $invoice)->get();
			$equipments = ExtraServices::where('bid', '=', $invoice)->get();
			$tripbooking = Bookings::where('bookid', '=', $invoice)->first();
			$tripdiscounts = BookingDiscount::where('book_id', '=', $invoice)->first();
            $name = BookingDetail::where('bid', '=', $invoice)->first();
            $tripdate = $payment->booking->trips;
			$data = array(
                'trip' => $payment->booking->trips,
				'tripdate' => $tripdate,
                'name' => $name,
				'equipments' => $equipments,
				'discount' => $tripdiscounts->early_booking_discount,
                'payment' => $payment,
				'booking' => $tripbooking,
				'gdiscount' => $tripdiscounts->group_discount,
				'sdiscount' => $tripdiscounts->special_discount,
				'disamo' => $tripdiscounts->coupon_discount,
				'ldiscount' => $tripdiscounts->last_minute_deals,
				'allpacks' => $packs
			);

            $pdf1 = PDF::loadView('frontend.InvoiceTemplate.paid.invoice1', $data)
				->setPaper('a4')->setOrientation('portrait')->setOption('margin-bottom', 0)->setOption('margin-top', 0);

            $pdf1->save(storage_path('Invoices/Paid/invoice#' . $bookid . ".pdf"));

            if ($booking->trips->trips->customtrip->coupon_discount != '') {
				$name = $user->name;
				$discount = $booking->trips->trips->customtrip->coupon_discount;
				$amount = round(($discount / 100) * $price);
				$count = 0;

                $code = array();
				for ($i = 0; $i < ($booking->people); $i++) {
					$random_code = str_random(8);

                    Coupons::create([
						'user_id' => $booking->user_id,
						'trip_price' => $price,
						'discount' => $discount,
						'code' => $random_code,
						'discountamount' => $amount
					]);

                    $code[$count++] = $random_code;
				}

                $date = Carbon::now();
				$date->addMonths(18);
				$date = date('Y-m-d', strtotime($date));

                Mail::to($user)->send(new CouponCode($name, $code, $discount, $amount, $date));
				Mail::to($user)->send(new ConfirmBooking($user, $tripdate, $bookid));

                return redirect('backend/payments')->with('success', 'The booking has confirmed and coupon has been sent.');
			} else {

                Mail::to($user)->send(new ConfirmBooking($user, $tripdate, $bookid));
				return redirect('backend/payments')->with('success', 'The booking has been confirmed');
			}

        }

		public function confirmtrips($id)
		{
			$payment = TPayment::where('bid', '=', $id)->first();

            if ($payment->chosen == "fullpayment") {
				$payment->paid_amount_sum = $payment->grandtotal;
				$payment->left_amount_sum = 0;
				$payment->status = "fullpaid";
			} else {
				$payment->paid_amount_sum = $payment->paid_amount;
				$payment->left_amount_sum = $payment->grandtotal - $payment->paid_amount;
				$payment->status = "halfpaid";
			}
			$payment->save();

            $booking = TripBookings::where('bookid', '=', $id)->first();
			$bookid = $booking->bookid;
			$user = $booking->user;
//			$name = $user->name;
			$trip = $booking->trips;

            $price = $trip->price;

            /*data to generate invoice*/
			$trip1 = $payment;
			$invoice = $trip1->bid;
			$data['tripdate'] = $trip1->tbooking->start_date;

            $packs = TripBookedActivities::where('bid', '=', $invoice)->get();
			$equipments = TExtraServices::where('bid', '=', $invoice)->get();
			$tripbooking = TripBookings::where('bookid', '=', $invoice)->first();
			$tripdiscounts = TripBookingDiscount::where('book_id', '=', $invoice)->first();
            $name = TripBookingDetail::where('bid', '=', $invoice)->first();

            $data = array(
                'trip' => $booking->trips,
                'name' => $name,
				'equipments' => $equipments,
				'discount' => $tripdiscounts->early_booking_discount,
                'payment' => $payment,
                'booking' => $booking,
				'gdiscount' => $tripdiscounts->group_discount,
				'sdiscount' => $tripdiscounts->special_discount,
				'disamo' => $tripdiscounts->coupon_discount,
				'tripbooking' => $tripbooking,
				'allpacks' => $packs
			);

            if ($trip1->is_custom == 0) {
				$pdf1 = PDF::loadView('frontend.InvoiceTemplate.paid.invoice', $data)
					->setPaper('a4')->setOrientation('portrait')->setOption('margin-bottom', 0)->setOption('margin-top', 0);
				$pdf1->save(storage_path('Invoices/Paid/invoice#' . $invoice . ".pdf"));
			}

            if ($trip1->is_custom == 1) {
				$pdf1 = PDF::loadView('frontend.InvoiceTemplate.paid.invoice2', $data)
					->setPaper('a4')->setOrientation('portrait')->setOption('margin-bottom', 0)->setOption('margin-top', 0);

                $pdf1->save(storage_path('Invoices/Paid/invoice#' . $invoice . ".pdf"));
			}
			if ($trip->customtrip->coupon_discount != '') {
				$discount = $booking->trips->customtrip->coupon_discount;
				$amount = round(($discount / 100) * $price);
				$count = 0;

                $code = array();
				for ($i = 0; $i < ($booking->people); $i++) {
					$random_code = str_random(8);

                    Coupons::create([
						'user_id' => $booking->user_id,
						'trip_price' => $price,
						'discount' => $trip->customtrip->coupon_discount,
						'code' => $random_code,
						'discountamount' => $amount
					]);

                    $code[$count++] = $random_code;
				}

                $date = Carbon::now();
//				dd($date);
				$date->addMonths(18);
				$date = date('Y-m-d', strtotime($date));

                Mail::to($user)->later(5, new CouponCode($name, $code, $discount, $amount, $date));
				Mail::to($user)->send(new ConfirmTripBooking($user, $trip, $booking, $bookid));

                return redirect('backend/tripspayments')->with('success', 'The booking has confirmed and coupon has been sent.');
			} else {
				Mail::to($user)->send(new ConfirmTripBooking($user, $trip, $booking, $bookid));
				return redirect('backend/tripspayments')->with('success', 'The booking has been confirmed');
			}
		}

        public function showBookings()
		{
            $paid = Payment::where('status', '=', 'fullpaid')->orWhere('status', '=', 'halfpaid')->get();

            $paidTrips = TPayment::where('status', '=', 'fullpaid')->orWhere('status', '=', 'halfpaid')->get();

            return view('admin-panel.bookings.bookingStatus', compact('paid', 'paidTrips'));
		}

        public function showonlineBookings()
		{
            $paid = Payment::where('online_paid', '=', 1)->where('status', '!=', 'postponed')->get();

            $paidTrips = TPayment::where('online_paid', '=', 1)->where('status', '!=', 'postponed')->get();

            return view('admin-panel.onlinepayment.showonlineBookings', compact('paid', 'paidTrips'));
		}

        public function showcancelledBookings()
		{
            $paid = Payment::where('status', '=', 'canceled')->get();

            $paidTrips = TPayment::where('status', '=', 'canceled')->get();

            return view('admin-panel.bookings.cancelledStatus', compact('paid', 'paidTrips'));
		}

        public function showpostponedBookings()
		{
            $paid = Payment::where('status', '=', 'postponed')->get();

            $paidTrips = TPayment::where('status', '=', 'postponed')->get();

            return view('admin-panel.bookings.postponedStatus', compact('paid', 'paidTrips'));
		}

        public function cancelTripBooking($bid)
		{
			TPayment::where('bid', '=', $bid)->update(['status' => 'canceled']);
			$booking = TripBookings::where('bookid', '=', $bid)->first();

            $user = $booking->user;
			$trip = $booking->trips;

            Mail::to($user)->send(new CancelTripBooking($user, $trip, $booking));
			return redirect('/backend/tripspayments')->with('success', 'Booking Cancelled Successfully.');


        }

		public function postponedTripBooking($bid)
		{
			TPayment::where('bid', '=', $bid)->update(['status' => 'postponed']);
			$booking = TripBookings::where('bookid', '=', $bid)->first();

            $user = $booking->user;
			$trip = $booking->trips;

            Mail::to($user)->send(new CancelTripBooking($user, $trip, $booking));
			return redirect()->back()->with('success', 'Booking Cancelled Successfully.');
		}

        public function cancelBooking($bid)
		{
			Payment::where('bid', '=', $bid)->update(['status' => 'canceled']);
			$booking = Bookings::where('bookid', '=', $bid)->first();
//         dd($booking->trips);
//         dd(($booking->trips->start_date)->format('Y-m-d'));
//         dd(date('Y-m-d', strtotime($booking->trips->start_date)));

            $trip = TripDates::where('trip_id', '=', $booking->trips->trip_id)
				->where('start_date', '=', date('Y-m-d', strtotime($booking->trips->start_date)))->first();

            $tripseats = $trip->remainingseats;
			$people = $booking->people;
			$updateseats = $tripseats + $people;

            $input['remainingseats'] = $updateseats;

            TripDates::where('id', '=', $trip->id)->update(['remainingseats' => $updateseats]);

            $user = $booking->user;
			$tripdate = $booking->trips;

            Mail::to($user)->send(new CancelBooking($user, $tripdate));
			return redirect('backend/payments')->with('success', 'Booking Cancelled Successfully.');
		}

        public function postponedBooking($bid)
		{
			Payment::where('bid', '=', $bid)->update(['status' => 'postponed']);
			$booking = Bookings::where('bookid', '=', $bid)->first();
//         dd($booking->trips);
//         dd(($booking->trips->start_date)->format('Y-m-d'));
//         dd(date('Y-m-d', strtotime($booking->trips->start_date)));

            $trip = TripDates::where('trip_id', '=', $booking->trips->trip_id)
				->where('start_date', '=', date('Y-m-d', strtotime($booking->trips->start_date)))->first();

            $tripseats = $trip->remainingseats;
			$people = $booking->people;
			$updateseats = $tripseats + $people;

            $input['remainingseats'] = $updateseats;

            TripDates::where('id', '=', $trip->id)->update(['remainingseats' => $updateseats]);

            $user = $booking->user;
			$tripdate = $booking->trips;

            Mail::to($user)->send(new CancelBooking($user, $tripdate));
			return redirect()->back()->with('success', 'Booking Cancelled Successfully.');
		}

        public function restorefixed($bid)
		{
			Payment::where('bid', '=', $bid)->update(['status' => 'pending']);
			return redirect()->back();

        }

		public function restorenormal($bid)
		{
			TPayment::where('bid', '=', $bid)->update(['status' => 'pending']);
			return redirect()->back();
		}

        public function bookfixed($bid)
		{
			Payment::where('bid', '=', $bid)->update(['status' => 'pending']);
			return redirect('backend/payments');

        }

		public function booknormal($bid)
		{
			TPayment::where('bid', '=', $bid)->update(['status' => 'pending']);
			return redirect('backend/tripspayments');
		}

        public function deleteCancelledBookings(Request $request, $id)
		{
			$input = $request->all();
			$result = PasswordChecker::checkpass($input['password']);

            if ($result == true) {
				Payment::find($id)->delete();
				return redirect()->back()->with('success', 'Cancelled Booking Deleted Successfully.');
			} else {
				return redirect()->back()->with('error', 'The password you entered is incorrect.');
			}
		}

        public function deleteCustomCancelledBookings(Request $request, $id)
		{
			$input = $request->all();
			$result = PasswordChecker::checkpass($input['password']);

            if ($result == true) {
				TPayment::find($id)->delete();
				return redirect()->back()->with('success', 'Cancelled Booking Deleted Successfully.');
			} else {
				return redirect()->back()->with('error', 'The password you entered is incorrect.');
			}
		}

        public function deletepostponedBookings(Request $request, $id)
		{
			$input = $request->all();
			$result = PasswordChecker::checkpass($input['password']);

            if ($result == true) {
				Payment::find($id)->delete();
				return redirect()->back()->with('success', 'Cancelled Booking Deleted Successfully.');
			} else {
				return redirect()->back()->with('error', 'The password you entered is incorrect.');
			}
		}

        public function deleteCustomPostponedBookings(Request $request, $id)
		{
			$input = $request->all();
			$result = PasswordChecker::checkpass($input['password']);

            if ($result == true) {
				TPayment::find($id)->delete();
				return redirect()->back()->with('success', 'Cancelled Booking Deleted Successfully.');
			} else {
				return redirect()->back()->with('error', 'The password you entered is incorrect.');
			}
		}

        public function deleteConfirmedBooking(Request $request, $id)
		{
			$input = $request->all();
			$result = PasswordChecker::checkpass($input['password']);

            if ($result == true) {
				Payment::find($id)->delete();
				return redirect()->back()->with('success', 'Booking Deleted Successfully.');
			} else {
				return redirect()->back()->with('error', 'The password you entered is incorrect.');
			}
		}

        public function deleteCustomConfirmedBooking(Request $request, $id)
		{
			$input = $request->all();
			$result = PasswordChecker::checkpass($input['password']);

            if ($result == true) {
				TPayment::find($id)->delete();
				return redirect()->back()->with('success', 'Booking Deleted Successfully.');
			} else {
				return redirect()->back()->with('error', 'The password you entered is incorrect.');
			}
		}

        public function deletebook(Request $request, $id)
		{
			$input = $request->all();
			$result = PasswordChecker::checkpass($input['password']);

            if ($result == true) {
				Payment::find($id)->delete();
				return redirect()->back()->with('success', 'Booking Deleted Successfully.');
			} else {
				return redirect()->back()->with('error', 'The password you entered is incorrect.');
			}
		}

        public function deletetripbook(Request $request, $id)
		{
			$input = $request->all();
			$result = PasswordChecker::checkpass($input['password']);

            if ($result == true) {
				TPayment::find($id)->delete();
				return redirect()->back()->with('success', 'Booking Deleted Successfully.');
			} else {
				return redirect()->back()->with('error', 'The password you entered is incorrect.');
			}
		}

    }
