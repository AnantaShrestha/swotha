<?php

	namespace App\Http\Controllers;

	use App\BookedActivities;
    use App\BookingDetail;
    use App\BookingDiscount;
    use App\Bookings;
    use App\Coupons;
    use App\CustomPayment;
    use App\ExtraServices;
    use App\HoldDates;
    use App\Mail\ConfirmBooking;
    use App\Mail\ConfirmOnlineBooking;
    use App\Mail\ConfirmOnlineTripBooking;
    use App\Mail\ConfirmTripBooking;
    use App\Mail\CouponCode;
    use App\Mail\SendCustomInvoice;
    use App\PayementDetails;
    use App\Payment;
    use App\TExtraServices;
    use App\TPayment;
    use App\TripBookedActivities;
    use App\TripBookingDetail;
    use App\TripBookingDiscount;
    use App\TripBookings;
    use App\TripDates;
    use App\Trips;
    use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
    use Carbon\Carbon;
    use Exception;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Support\Facades\Response;
    use Illuminate\Support\Facades\Session;

    class PaymentController extends Controller
	{
		public function store(Request $request)
		{
			$input = $request->all();
			PayementDetails::create($input);
		}

		public function searchinvoice($number)
		{
			$invoice_number = $number;

			$trip1 = Payment::where('bid', $invoice_number)->where('left_amount_sum', '>', 0)->first();

			if ($trip1 == null) {
				$trip1 = TPayment::where('bid', $invoice_number)->where('left_amount_sum', '>', 0)->first();
			}

			if ($trip1 == null) {
				$trip1 = "notripfound";
			}
			return view('frontend.custompayment.inputformwithinvoice', compact('trip1'));
		}

		public function showonlinepaymentdetails()
		{
			$payments = PayementDetails::all();
			return view('admin-panel.onlinepayment.index', compact('payments'));
		}

		public function showattemptpaymentdetails()
		{
			$payments = CustomPayment::all();
			return view('admin-panel.onlinepayment.indexattempt', compact('payments'));
		}

		public function showpaidinvoice($id)
		{
            $filename = 'onlinepayment/invoice_number#' . $id . '.pdf';
			$path = storage_path($filename);

			return Response::make(file_get_contents($path), 200, [
				'Content-Type' => 'application/pdf',
				'Content-Disposition' => 'inline; filename="' . $filename . '"'
			]);
		}

		public function processpay(Request $request)
		{
			$data = $request->all();
			$amount = $data['amount'];
			$data['success'] = 0;
			$data['invoice_number'] = time();
//            $data['user_defined'] = "custompayment";

			if (strpos($amount, '.') !== false) {
				$allamount = explode('.', $amount);
				if (strlen($allamount[1]) === 1) {
					$cents = $allamount[1] . '0';
				} else {
					$cents = $allamount[1];
				}
				$jointprice = $allamount[0] . '.' . $cents;
			} else {
				$jointprice = $amount . '.00';
			}

            $data['amount'] = $jointprice;
			$pay = CustomPayment::create($data);
//            $pay->userDefined1 = 'custompayment';

			$data = CustomPayment::where('invoice_number', $data['invoice_number'])->first();
            $data['user_defined'] = "custompayment";
			$pdf = PDF::loadView('admin-panel.layout.custompayment', compact('data'))->setOrientation('landscape')->setPaper('a4');

			$destinationPath = storage_path('custompayment');

			if (!is_dir($destinationPath)) {
				mkdir($destinationPath, 0777, true);
			}

			if (file_exists(storage_path('custompayment/pay_' . $data['invoice_number'] . '.pdf'))) {
				unlink(storage_path('custompayment/pay_' . $data['invoice_number'] . '.pdf'));
			}

            $pdf->save(storage_path('custompayment/pay_' . $data['invoice_number'] . '.pdf'));
            return view('frontend.custompayment.processpayment', $data, compact('pay'));
		}

        public function processpay_invoice(Request $request)
		{
			$input = $request->all();
			$trip_payment = Payment::where('bid', '=', $input['invoice_number'])->where('left_amount_sum', '>', 0)->first();

            if ($trip_payment == null) {
				$trip_trippayment = TPayment::where('bid', '=', $input['invoice_number'])->where('left_amount_sum', '>', 0)->first();
			}
			if ($trip_payment == null) {
				$trip1 = $trip_trippayment;
				$invoice = $trip1->bid;
				$data['tripdate'] = $trip1->tbooking->start_date;

                $packs = TripBookedActivities::where('bid', '=', $invoice)->get();
				$equipments = TExtraServices::where('bid', '=', $invoice)->get();
				$tripbooking = TripBookings::where('bookid', '=', $invoice)->first();
				$tripdiscounts = TripBookingDiscount::where('book_id', '=', $invoice)->first();

                $data = array(
					'trip' => $trip1->tbooking->trips,
                    'name' => $trip1->tbooking->tbdetail->first(),
					'equipments' => $equipments,
					'discount' => $tripdiscounts->early_booking_discount,
					'payment' => $trip1,
					'booking' => $trip1->tbooking,
					'gdiscount' => $tripdiscounts->group_discount,
					'sdiscount' => $tripdiscounts->special_discount,
					'disamo' => $tripdiscounts->coupon_discount,
					'tripbooking' => $tripbooking,
					'allpacks' => $packs
				);

				$pdf1 = PDF::loadView('frontend.InvoiceTemplate.online.invoice_trippayment', $data)
					->setPaper('a4')->setOrientation('portrait')->setOption('margin-bottom', 0)->setOption('margin-top', 0);

				$pdf1->save(storage_path('onlinepayment/invoice_number#' . $invoice . ".pdf"));

				$data['fullname'] = $trip1->tbooking->user->name;
                if (count($trip1->tbooking->user->details) > 0) {
                    $data['address'] = $trip1->tbooking->user->details->address or "NA";
                } else {
                    $data['address'] = "NA";
                }
				$data['email'] = $trip1->tbooking->user->email;
				$data['phone'] = $trip1->tbooking->user->phone or "NA";
				$data['success'] = 0;
				$data['amount'] = $trip1->left_amount_sum;
				$data['invoice_number'] = $invoice;
                $data['user_defined'] = "onlinepayment_1";
                $pay = CustomPayment::create($data);
                return view('frontend.custompayment.processpayment', $data, compact('pay'));

            } else {
				$trip1 = $trip_payment;
				$data['tripdate'] = $trip1->booking->trips->start_date;
				$invoice = $trip1->bid;
				$packs = BookedActivities::where('bid', '=', $invoice)->get();
				$equipments = ExtraServices::where('bid', '=', $invoice)->get();
				$tripbooking = Bookings::where('bookid', '=', $invoice)->first();
				$tripdiscounts = BookingDiscount::where('book_id', '=', $invoice)->first();
				$tripdate = $trip1->booking->trips;
				$data = array(
					'trip' => $trip1->booking->trips,
					'tripdate' => $tripdate,
                    'name' => $trip1->booking->bdetail->first(),
					'equipments' => $equipments,
					'discount' => $tripdiscounts->early_booking_discount,
					'payment' => $trip1,
					'booking' => $tripbooking,
					'gdiscount' => $tripdiscounts->group_discount,
					'sdiscount' => $tripdiscounts->special_discount,
					'disamo' => $tripdiscounts->coupon_discount,
					'ldiscount' => $tripdiscounts->last_minute_deals,
					'allpacks' => $packs
				);
//				dd($data);
				$pdf1 = PDF::loadView('frontend.InvoiceTemplate.online.invoice_payment', $data)
					->setPaper('a4')->setOrientation('portrait')->setOption('margin-bottom', 0)->setOption('margin-top', 0);

                $pdf1->save(storage_path('onlinepayment/invoice_number#' . $invoice . ".pdf"), $overwrite = true);
				$data['fullname'] = $trip1->booking->user->name;

                if (count($trip1->booking->user->details) > 0) {
                    $data['address'] = $trip1->booking->user->details->address or "NA";
                } else {
                    $data['address'] = "NA";
                }
				$data['email'] = $trip1->booking->user->email;
				$data['phone'] = $trip1->booking->user->phone or "NA";
				$data['success'] = 0;
				$data['amount'] = $trip1->left_amount_sum;
				$data['invoice_number'] = $invoice;
                $data['user_defined'] = "onlinepayment_2";
                $pay = CustomPayment::where('invoice_number', '=', $invoice)->first();
                if (!$pay) {
                    $pay = CustomPayment::create($data);
                }
                return view('frontend.custompayment.processpayment', $data, compact('pay'));
			}

        }

		public function show(Request $request)
		{
			$input = $request->all();

//			dd($input);
			/*payment is done manually by the user*/
            if ($input['respCode'] == null) {    // this should not be null for live website
				if ($input['userDefined1'] == 'custompayment') {
                    $input = $request->all();
                    $invoce_No = $input['invoiceNo'];
                    CustomPayment::where('invoice_number', '=', $invoce_No)->update(['success' => 1]);
					$request->session()->flash('message', 'Your payment is successfully completed');
					return redirect('/');
				}
				if ($input['userDefined1'] == 'onlinepayment_1') {
					return $this->onlinetrippayment($request);
				}

                if ($input['userDefined1'] == 'onlinepayment_2') {
					return $this->onlinepayment($request);
				}
				/*if the trip is lastminute deals or fixed departure*/
				if ($input['userDefined1'] == 'lastminutefixed') {
					return $this->storelastandfixed($request);
				} /*if the trip is booked from normal procedure*/
				elseif ($input['userDefined1'] == 'normaltrip') {
					return $this->storenormaltrips($request);
				} elseif ($input['userDefined1'] == 'customtrip') {
					return $this->storenormaltrips($request);
                } elseif ($input['userDefined1'] == 'lpn') {
                    return redirect('https:://lonelyplanetnepal.com');
                } else {
					return 'empty value';
				}
			} else {
				return redirect('/');
			}
		}

        public function onlinetrippayment(Request $request)
		{
			$input = $request->all();
			$invoce_No = $input['invoiceNo'];

            $trippayment = TPayment::where('bid', '=', $invoce_No)->first();
			$has_paid = $trippayment->paid_amount_sum;
			$trippayment->update(['status' => 'fullpaid', 'online_paid' => 1, 'paid_amount_sum' => $trippayment->grandtotal, 'left_amount_sum' => 0]);

			CustomPayment::where('invoice_number', '=', $invoce_No)->update(['success' => 1]);

            $booking = TripBookings::where('bookid', '=', $invoce_No)->first();
			$bookid = $booking->bookid;
			$user = $booking->user;
			$name = $user->name;
			$trip = $booking->trips;

            $price = $trip->price;
			$message = "The booking has confirmed and email has been sent to " . $user->email;
			if ($trip->customtrip->coupon_discount != '' and $has_paid != 0) {
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
				$date->addMonths(18);
				$date = date('Y-m-d', strtotime($date));

                Mail::to($user)->later(5, new CouponCode($name, $code, $discount, $amount, $date));
				$message = "The booking has confirmed and coupon has been sent to " . $user->email;
			}
			Mail::to($user)->send(new ConfirmOnlineTripBooking($user, $trip, $booking, $bookid));
			return redirect('/')->with('success', $message);
		}

        public function onlinepayment(Request $request)
		{
			$input = $request->all();
			$invoce_No = $input['invoiceNo'];

            $trippayment = Payment::where('bid', '=', $invoce_No)->first();
			$has_paid = $trippayment->paid_amount_sum;
			$trippayment->update(['status' => 'fullpaid', 'online_paid' => 1, 'paid_amount_sum' => $trippayment->grandtotal, 'left_amount_sum' => 0]);
			CustomPayment::where('invoice_number', '=', $invoce_No)->update(['success' => 1]);

            $booking = Bookings::where('bookid', '=', $invoce_No)->first();
			$price = $booking->trips->price;
			$user = $booking->user;
			$tripdate = $booking->trips;
			$bookid = $booking->bookid;

            $message = "The booking has confirmed and email has been sent to " . $user->email;

			if ($booking->trips->trips->customtrip->coupon_discount != '' and $has_paid != 0) {
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
				$message = "The booking has confirmed and coupon has been sent to " . $user->email;
			}
			Mail::to($user)->send(new ConfirmOnlineBooking($user, $tripdate, $bookid));
			return redirect('/')->with('success', $message);
		}

        public function storelastandfixed(Request $request)
		{
			$status = false;
			try {
				$exception = DB::transaction(function () use ($request) {
					$alldata = Session::get('maindata');
					$invoice = $alldata['invoiceno'];
					$tripdateid = $alldata['tripdateid'];
					$previousinfo = Session::get('invoicedetails');

                    $manche = $alldata['not'];

                    $payment = new Payment();
					if ($previousinfo[1] == "full") {
						$payment->bid = $invoice;
						$payment->status = "fullpaid";
						$payment->date = Carbon::now()->format('Y-m-d');
						$payment->chosen = "fullpayment";
						$payment->paid_amount = $previousinfo[0][5];
						$payment->due_amount = 0;
					} else {
						if (!empty($previousinfo[2])) {
							$paid_amount = $previousinfo[2];
							$due_amount = $previousinfo[0][5] - $paid_amount;
						}

                        $payment->bid = $invoice;
						$payment->status = "halfpaid";
						$payment->date = Carbon::now()->format('Y-m-d');
						$payment->chosen = "confirm";
						$payment->paid_amount = $paid_amount;
						$payment->due_amount = $due_amount;
					}
					$payment->online_paid = 1;
                    $payment->grandtotal = $payment->paid_amount + $payment->due_amount;
                    $payment->paid_amount_sum = $payment->paid_amount;
                    $payment->left_amount_sum = $payment->grandtotal - $payment->paid_amount_sum;
					$payment->save();


                    $a = new Bookings();
					$a->user_id = Auth::user()->id;
					$a->trip_id = $tripdateid;
					$a->people = $manche;
					$a->bookid = $invoice;
					$a->save();


                    //person's details
					foreach ($alldata as $key => $val) {
						foreach ((array)$alldata[$key] as $value) {
							if ($key == "title") {
								$title[] = $value;
							} else {
								if ($key == "fname") {
									$fname[] = $value;
								} else {
									if ($key == "mname") {
										$mname[] = $value;
									} else {
										if ($key == "lname") {
											$lname[] = $value;
										} else {
											if ($key == "email") {
												$email[] = $value;
											} else {
												if ($key == "dd") {
													$dd[] = $value;
												} else {
													if ($key == "mm") {
														$mm[] = $value;
													} else {
														if ($key == "year") {
															$year[] = $value;
														} else {
															if ($key == "contactno") {
																$contactno[] = $value;
															} else {
																if ($key == "paddress") {
																	$paddress[] = $value;
																} else {
																	if ($key == "taddress") {
																		$taddress[] = $value;
																	} else {
																		if ($key == "country") {
																			$country[] = $value;
																		} else {
																			if ($key == "state") {
																				$state[] = $value;
																			} else {
																				if ($key == "town") {
																					$town[] = $value;
																				} else {
																					if ($key == "zip") {
																						$zip[] = $value;
																					} else {
																						if ($key == "passportno") {
																							$passportno[] = $value;
																						} else {
																							if ($key == "doi") {
																								$doi[] = $value;
																							} else {
																								if ($key == "ic") {
																									$ic[] = $value;
																								} else {
																									if ($key == "icn") {
																										$icn[] = $value;
																									} else {
																										if ($key == "ipn") {
																											$ipn[] = $value;
																										} else {
																											if ($key == "feedback") {
																												$feedback[] = $value;
																											} else {
																												continue;
																											}
																										}
																									}
																								}
																							}
																						}
																					}
																				}
																			}
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}


                    for ($i = 0; $i < $manche; $i++) {

                        if (!empty($mname[$i])) {
							$b = ucfirst($mname[$i]) . ' ';
						} else {
							$b = '';
						}
						if ($fname[$i] == null || $lname[$i] == null) {
							$a = null;
						} else {
							$a = ucfirst($title[$i]) . ' ' . ucfirst($fname[$i]) . ' ' . $b . ucfirst($lname[$i]);
						}

                        $d = $year[$i] . '-' . $mm[$i] . '-' . $dd[$i];
						$dob = $d;

                        if ($doi != null) {
							$c = '1/1/' . $doi[$i];
							$dateofins = date('Y-m-d', strtotime($c));
						} else {
							$dateofins = null;
						}

                        $sabaitraveller[] = array(
							"bid" => $invoice,
							"name" => $a,
							"email" => $email[$i],
							"dob" => $dob,
							"contactno" => $contactno[$i],
							"paddress" => $paddress[$i],
							"taddress" => $taddress[$i],
							"country" => $country[$i],
							"state" => $state[$i],
							"town" => $town[$i],
							"zip" => $zip[$i],
							"passportno" => $passportno[$i],
							"doi" => $dateofins,
							"ic" => $ic[$i],
							"icn" => $icn[$i],
							"ipn" => $ipn[$i],
							"feedback" => $feedback[$i]
						);
					}

                    BookingDetail::insert($sabaitraveller);
					//equipments details
					$equipment_name = [];
					$equipment_price = [];
					$equipment_quantity = [];
					foreach ($alldata as $key => $val) {
						foreach ((array)$alldata[$key] as $value) {
							if ($key == "equipment_name") {
								$equipment_name[] = $value;
							} elseif ($key == "equipment_price") {
								$equipment_price[] = $value;
							} elseif ($key == "equipment_quantity") {
								$equipment_quantity[] = $value;
							} elseif ($key == "equipment_id") {
								$equipment_id[] = $value;
							} else {
								continue;
							}
						}
					}

                    $number = array_sum($equipment_quantity);
					if ($number != 0) {
						for ($i = 0; $i < count($equipment_name); $i++) {
							$flag[$i] = false;
							if ($equipment_quantity[$i] != 0) {
								$flag[$i] = true;
							}
							if ($flag[$i] == true) {
								$equipments[] = array(
									"equipment_name" => $equipment_name[$i],
									'equipment_price' => $equipment_price[$i],
									'equipment_quantity' => $equipment_quantity[$i],
									'bid' => $invoice
								);
							}
						}
					} else {
						$equipments = 0;
					}

                    if ($equipments != 0) {
						ExtraServices::insert($equipments);
					}
					//optional activities
					$activity_name = [];
					$activity_price = [];
					$activity_quantity = [];
					foreach ($alldata as $key => $val) {
						foreach ((array)$alldata[$key] as $value) {
							if ($key == "activity_name") {
								$activity_name[] = $value;
							} elseif ($key == "actprice") {
								$activity_price[] = $value;
							} elseif ($key == "optact_number") {
								$activity_quantity[] = $value;
							} else {
								continue;
							}
						}
					}

                    $number1 = array_sum($activity_quantity);
					if ($number1 != 0) {
						for ($i = 0; $i < count($activity_name); $i++) {
							$flag[$i] = false;
							if ($activity_quantity[$i] != 0) {
								$flag[$i] = true;
							}
							if ($flag[$i] == true) {
								$activities[] = array(
									"title" => $activity_name[$i],
									'price' => $activity_price[$i],
									'pax' => $activity_quantity[$i],
									'bid' => $invoice
								);
							}
						}
					} else {
						$activities = 0;
					}

                    if ($activities != 0) {
						BookedActivities::insert($activities);
					}

                    //decrease the remaining seats

                    $tripdates = TripDates::findOrFail($tripdateid);

                    $remainseat = $tripdates->remainingseats;

                    $tr = Bookings::where('bookid', '=', $invoice)->first();

                    $bookedseats = $tr->people;

                    if (!isset($alldata['hold_id'])) {
						$updateseats = $remainseat - $bookedseats;
						TripDates::where('id', '=', $alldata['tripid'])->update(['remainingseats' => $updateseats]);
//			dd($hhh);
					} else {
						HoldDates::where('id', '=', $alldata['hold_id'])->update(['booked' => '1']);
//			dd($hod);
					}


                    //process for invoice pdf
					$booking = Bookings::where('bookid', '=', $invoice)->first();
					$name = BookingDetail::where('bid', '=', $invoice)->first();

                    $tripdate = TripDates::findOrFail($tripdateid);
					$gdiscount = $alldata['groupdiscount'];
					if (isset($alldata['specialdis'])) {
						$sdiscount = $alldata['specialdis'];
					} else {
						$sdiscount = 0;
					}
					if (isset($alldata['lastdis'])) {
						$ldiscount = $alldata['lastdis'];
					} else {
						$ldiscount = 0;
					}
					$discount = $alldata['earlybookdiscount'];

                    $coupon1discount = Session::get('users.coupons1' . Auth::user()->id);

                    $allcoupons = null;

                    if ($coupon1discount != null) {
						$allcoupons = Coupons::findOrFail($coupon1discount);
					} else {
						$allcoupons = null;
					}

                    if (!empty($allcoupons)) {
						$adddiscount = [];
						foreach ($allcoupons as $a) {
							if ($a) {
								if ($a->trip_price >= $tripdate->trips->price) {
									$coudiscount = round(($a->discount / 100) * $tripdate->trips->price);
									$remainamount = $a->discountamount - $coudiscount;

                                    if ($remainamount > 0) {
										$coudiscount = round(($a->discount / 100) * $tripdate->trips->price);
										Coupons::findOrFail($a->id)->update(['discountamount' => $remainamount, 'partial_used' => 1]);
									} else {
										$coudiscount = $a->discountamount;
										Coupons::findOrFail($a->id)->update(['redeemed' => 1]);
									}
									echo $coudiscount;
								} else {
									$coudiscount = $a->discountamount;
									Coupons::findOrFail($a->id)->update(['redeemed' => 1]);
								}
								array_push($adddiscount, $coudiscount);
							}
						}
						$totaldiscountamount = array_sum($adddiscount);
					} else {
						$totaldiscountamount = null;
					}

                    $packs = BookedActivities::where('bid', '=', $invoice)->get();
					$equipments = ExtraServices::where('bid', '=', $invoice)->get();

                    $data = array(
						'tripdate' => $tripdate,
						'name' => $name,
						'equipments' => $equipments,
						'discount' => $discount,
						'payment' => $payment,
						'booking' => $booking,
						'gdiscount' => $gdiscount,
						'sdiscount' => $sdiscount,
						'ldiscount' => $ldiscount,
						'disamo' => $totaldiscountamount,
						'allpacks' => $packs
					);

//					$pdf = PDF::loadView('frontend.InvoiceTemplate.pending.invoice1', $data)
//						->setPaper('a4')->setOrientation('portrait')->setOption('margin-bottom', 0)->setOption('margin-top', 0);
//					$pdf->save(storage_path('Invoices/Pending/invoice#' . $invoice . ".pdf"));

                    $pdf1 = PDF::loadView('frontend.InvoiceTemplate.paid.invoice1', $data)
						->setPaper('a4')->setOrientation('portrait')->setOption('margin-bottom', 0)->setOption('margin-top', 0);

                    $pdf1->save(storage_path('onlinepayment/invoice_number#' . $invoice . ".pdf"));

                    $booking = Bookings::where('bookid', '=', $invoice)->first();
					$price = $booking->trips->price;
					$user = $booking->user;
					$tripdate = $booking->trips;
					$bookid = $booking->bookid;

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
					}
					Mail::to($user)->later(5, new ConfirmBooking($user, $tripdate, $invoice));
					$request->session()->forget('users.coupons1' . Auth::user()->id);
				});
				$status = is_null($exception) ? true : $exception;
            } catch (Exception $e) {
				dd($e);
				$status = false;
			}

            $message = ($status) ? 'Thank You for booking a trip with us! Please find the invoice  at ' . Auth::user()->email : 'Error Occured! Try Again!';
			$alert = ($status) ? 'success' : 'error';

            $notification = array(
				'message' => $message,
				'alert-type' => $alert,
			);

            return redirect('/')->with($notification);

        }

		public function storenormaltrips(Request $request)
		{
			$status = false;
			try {
				$exception = DB::transaction(function () use ($request) {
					$alldata = Session::get('maindata');
					$invoice = $alldata['invoiceno'];
					$tripid = $alldata['tripid'];
					$previousinfo = Session::get('invoicedetails');

                    $manche = $alldata['not'];


                    $payment = new TPayment();
					if ($previousinfo[1] == "full") {
						$payment->bid = $invoice;
						$payment->status = "fullpaid";
						$payment->date = Carbon::now()->format('Y-m-d');
						$payment->chosen = "fullpayment";
						$payment->paid_amount = $previousinfo[0][5];
						$payment->due_amount = 0;
					} else {

                        if (!empty($previousinfo[2])) {
							$paid_amount = $previousinfo[2];
							$due_amount = $previousinfo[0][5] - $paid_amount;
						}

                        $payment->bid = $invoice;
						$payment->status = "halfpaid";
						$payment->date = Carbon::now()->format('Y-m-d');
						$payment->chosen = "confirm";
						$payment->paid_amount = $paid_amount;
						$payment->due_amount = $due_amount;
					}
                    $payment->online_paid = 1;
                    $payment->grandtotal = $payment->paid_amount + $payment->due_amount;
                    $payment->paid_amount_sum = $payment->paid_amount;
                    $payment->left_amount_sum = $payment->grandtotal - $payment->paid_amount_sum;
					$payment->save();


                    $a = new TripBookings();
					$a->user_id = Auth::user()->id;
					$a->trip_id = $tripid;
					$a->people = $manche;
					$a->people = $manche;
					$a->bookid = $invoice;
					$a->start_date = $alldata['start_date'];
					$a->save();


                    //person's details
					foreach ($alldata as $key => $val) {
						foreach ((array)$alldata[$key] as $value) {
							if ($key == "title") {
								$title[] = $value;
							} else {
								if ($key == "fname") {
									$fname[] = $value;
								} else {
									if ($key == "mname") {
										$mname[] = $value;
									} else {
										if ($key == "lname") {
											$lname[] = $value;
										} else {
											if ($key == "email") {
												$email[] = $value;
											} else {
												if ($key == "dd") {
													$dd[] = $value;
												} else {
													if ($key == "mm") {
														$mm[] = $value;
													} else {
														if ($key == "year") {
															$year[] = $value;
														} else {
															if ($key == "contactno") {
																$contactno[] = $value;
															} else {
																if ($key == "paddress") {
																	$paddress[] = $value;
																} else {
																	if ($key == "taddress") {
																		$taddress[] = $value;
																	} else {
																		if ($key == "country") {
																			$country[] = $value;
																		} else {
																			if ($key == "state") {
																				$state[] = $value;
																			} else {
																				if ($key == "town") {
																					$town[] = $value;
																				} else {
																					if ($key == "zip") {
																						$zip[] = $value;
																					} else {
																						if ($key == "passportno") {
																							$passportno[] = $value;
																						} else {
																							if ($key == "doi") {
																								$doi[] = $value;
																							} else {
																								if ($key == "ic") {
																									$ic[] = $value;
																								} else {
																									if ($key == "icn") {
																										$icn[] = $value;
																									} else {
																										if ($key == "ipn") {
																											$ipn[] = $value;
																										} else {
																											if ($key == "feedback") {
																												$feedback[] = $value;
																											} else {
																												continue;
																											}
																										}
																									}
																								}
																							}
																						}
																					}
																				}
																			}
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}


                    for ($i = 0; $i < $manche; $i++) {

                        if (!empty($mname[$i])) {
							$b = ucfirst($mname[$i]) . ' ';
						} else {
							$b = '';
						}

                        if ($fname[$i] == null || $lname[$i] == null) {
							$a = null;
						} else {
							$a = ucfirst($title[$i]) . ' ' . ucfirst($fname[$i]) . ' ' . $b . ucfirst($lname[$i]);
						}

                        $d = $year[$i] . '-' . $mm[$i] . '-' . $dd[$i];
						$dob = $d;

                        if ($doi != null) {
							$c = '1/1/' . $doi[$i];
							$dateofins = date('Y-m-d', strtotime($c));
						} else {
							$dateofins = null;
						}

                        $sabaitraveller[] = array(
							"bid" => $invoice,
							"name" => $a,
							"email" => $email[$i],
							"dob" => $dob,
							"contactno" => $contactno[$i],
							"paddress" => $paddress[$i],
							"taddress" => $taddress[$i],
							"country" => $country[$i],
							"state" => $state[$i],
							"town" => $town[$i],
							"zip" => $zip[$i],
							"passportno" => $passportno[$i],
							"doi" => $dateofins,
							"ic" => $ic[$i],
							"icn" => $icn[$i],
							"ipn" => $ipn[$i],
							"feedback" => $feedback[$i]
						);
					}

                    TripBookingDetail::insert($sabaitraveller);
					//equipments details
					$equipment_name = [];
					$equipment_price = [];
					$equipment_quantity = [];
					foreach ($alldata as $key => $val) {
						foreach ((array)$alldata[$key] as $value) {
							if ($key == "equipment_name") {
								$equipment_name[] = $value;
							} elseif ($key == "equipment_price") {
								$equipment_price[] = $value;
							} elseif ($key == "equipment_quantity") {
								$equipment_quantity[] = $value;
							} elseif ($key == "equipment_id") {
								$equipment_id[] = $value;
							} else {
								continue;
							}
						}
					}

                    $number = array_sum($equipment_quantity);
					if ($number != 0) {
						for ($i = 0; $i < count($equipment_name); $i++) {
							$flag[$i] = false;
							if ($equipment_quantity[$i] != 0) {
								$flag[$i] = true;
							}
							if ($flag[$i] == true) {
								$equipments[] = array(
									"equipment_name" => $equipment_name[$i],
									'equipment_price' => $equipment_price[$i],
									'equipment_quantity' => $equipment_quantity[$i],
									'bid' => $invoice
								);
							}
						}
					} else {
						$equipments = 0;
					}

                    if ($equipments != 0) {
						TExtraServices::insert($equipments);
					}
					//optional activities
					$activity_name = [];
					$activity_price = [];
					$activity_quantity = [];
					foreach ($alldata as $key => $val) {
						foreach ((array)$alldata[$key] as $value) {
							if ($key == "activity_name") {
								$activity_name[] = $value;
							} elseif ($key == "actprice") {
								$activity_price[] = $value;
							} elseif ($key == "optact_number") {
								$activity_quantity[] = $value;
							} else {
								continue;
							}
						}
					}

                    $number1 = array_sum($activity_quantity);
					if ($number1 != 0) {
						for ($i = 0; $i < count($activity_name); $i++) {
							$flag[$i] = false;
							if ($activity_quantity[$i] != 0) {
								$flag[$i] = true;
							}
							if ($flag[$i] == true) {
								$activities[] = array(
									"title" => $activity_name[$i],
									'price' => $activity_price[$i],
									'pax' => $activity_quantity[$i],
									'bid' => $invoice
								);
							}
						}
					} else {
						$activities = 0;
					}

                    if ($activities != 0) {
						TripBookedActivities::insert($activities);
					}


                    //process for invoice pdf
					$booking = TripBookings::where('bookid', '=', $invoice)->first();
					$name = TripBookingDetail::where('bid', '=', $invoice)->first();

                    $trip = Trips::findOrFail($tripid);
					$gdiscount = $alldata['groupdiscount'];
					if (isset($alldata['specialdis'])) {
						$sdiscount = $alldata['specialdis'];
					} else {
						$sdiscount = 0;
					}

                    $discount = $alldata['earlybookdiscount'];

                    $coupon1discount = Session::get('users.coupons1' . Auth::user()->id);

                    $allcoupons = null;

                    if ($coupon1discount != null) {
						$allcoupons = Coupons::findOrFail($coupon1discount);
					} else {
						$allcoupons = null;
					}

                    if (!empty($allcoupons)) {
						$adddiscount = [];
						foreach ($allcoupons as $a) {
							if ($a) {
								if ($a->trip_price >= $trip->price) {
									$coudiscount = round(($a->discount / 100) * $trip->price);
									$remainamount = $a->discountamount - $coudiscount;

                                    if ($remainamount > 0) {
										$coudiscount = round(($a->discount / 100) * $trip->price);
										Coupons::findOrFail($a->id)->update(['discountamount' => $remainamount, 'partial_used' => 1]);
									} else {
										$coudiscount = $a->discountamount;
										Coupons::findOrFail($a->id)->update(['redeemed' => 1]);
									}
									echo $coudiscount;
								} else {
									$coudiscount = $a->discountamount;
									Coupons::findOrFail($a->id)->update(['redeemed' => 1]);
								}
								array_push($adddiscount, $coudiscount);
							}
						}
						$totaldiscountamount = array_sum($adddiscount);
					} else {
						$totaldiscountamount = null;
					}

                    $packs = TripBookedActivities::where('bid', '=', $invoice)->get();
					$equipments = TExtraServices::where('bid', '=', $invoice)->get();
					$tripbooking = TripBookings::where('bookid', '=', $invoice)->first();

                    $data = array(
						'trip' => $trip,
						'name' => $name,
						'equipments' => $equipments,
						'discount' => $discount,
						'payment' => $payment,
						'booking' => $booking,
						'gdiscount' => $gdiscount,
						'sdiscount' => $sdiscount,
						'disamo' => $totaldiscountamount,
						'tripbooking' => $tripbooking,
						'allpacks' => $packs
					);

//					$pdf = PDF::loadView('frontend.InvoiceTemplate.pending.invoice', $data)
//						->setPaper('a4')->setOrientation('portrait')->setOption('margin-bottom', 0)->setOption('margin-top', 0);
//					$pdf->save(storage_path('Invoices/Pending/invoice#' . $invoice . ".pdf"));
//
					$pdf1 = PDF::loadView('frontend.InvoiceTemplate.paid.invoice', $data)
						->setPaper('a4')->setOrientation('portrait')->setOption('margin-bottom', 0)->setOption('margin-top', 0);

                    $pdf1->save(storage_path('onlinepayment/invoice_number#' . $invoice . ".pdf"));

                    $booking = TripBookings::where('bookid', '=', $invoice)->first();
					$user = $booking->user;
					$name = $user->name;
					$trip = $booking->trips;

                    $price = $trip->price;

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
						$date->addMonths(18);
						$date = date('Y-m-d', strtotime($date));
						Mail::to($user)->later(5, new CouponCode($name, $code, $discount, $amount, $date));

                    }
					Mail::to($user)->later(5, new ConfirmTripBooking($user, $trip, $tripbooking, $invoice));
					$request->session()->forget('users.coupons1' . Auth::user()->id);

                });
				$status = is_null($exception) ? true : $exception;
            } catch (Exception $e) {
				dd($e);
				$status = false;
			}

            $message = ($status) ? 'Thank You for booking a trip with us! Please find the invoice at ' . Auth::user()->email : 'Error Occured! Try Again!';
			$alert = ($status) ? 'success' : 'error';

            $notification = array(
				'message' => $message,
				'alert-type' => $alert,
			);
			return redirect('/')->with($notification);
		}

        public function storecustomizedtrip(Request $request)
		{
			$status = false;
			try {
				$exception = DB::transaction(function () use ($request) {
					$alldata = Session::get('maindata');

                    $invoice = $alldata['invoiceno'];
					$tripid = $alldata['tripid'];
					$previousinfo = Session::get('invoicedetails');

                    $manche = $alldata['not'];

                    $payment = new TPayment();
					if ($previousinfo[1] == "full") {
						$payment->bid = $invoice;
						$payment->status = "fullpaid";
						$payment->date = Carbon::now()->format('Y-m-d');
						$payment->chosen = "fullpayment";
						$payment->paid_amount = $previousinfo[0][5];
						$payment->due_amount = 0;
					} else {

                        if (!empty($previousinfo[2])) {
							$paid_amount = $previousinfo[2];
							$due_amount = $previousinfo[0][5] - $paid_amount;
						}

                        $payment->bid = $invoice;
						$payment->status = "halfpaid";
						$payment->date = Carbon::now()->format('Y-m-d');
						$payment->chosen = "confirm";
						$payment->paid_amount = $paid_amount;
						$payment->due_amount = $due_amount;
					}
                    $payment->online_paid = 1;
                    $payment->grandtotal = $payment->paid_amount + $payment->due_amount;
                    $payment->paid_amount_sum = $payment->paid_amount;
                    $payment->left_amount_sum = $payment->grandtotal - $payment->paid_amount_sum;
					$payment->save();


                    $a = new TripBookings();
					$a->user_id = Auth::user()->id;
					$a->trip_id = $tripid;
					$a->people = $manche;
					$a->people = $manche;
					$a->bookid = $invoice;
					$a->start_date = $alldata['start_date'];
					$a->save();

                    //person's details
					foreach ($alldata as $key => $val) {
						foreach ((array)$alldata[$key] as $value) {
							if ($key == "title") {
								$title[] = $value;
							} else {
								if ($key == "fname") {
									$fname[] = $value;
								} else {
									if ($key == "mname") {
										$mname[] = $value;
									} else {
										if ($key == "lname") {
											$lname[] = $value;
										} else {
											if ($key == "email") {
												$email[] = $value;
											} else {
												if ($key == "dd") {
													$dd[] = $value;
												} else {
													if ($key == "mm") {
														$mm[] = $value;
													} else {
														if ($key == "year") {
															$year[] = $value;
														} else {
															if ($key == "contactno") {
																$contactno[] = $value;
															} else {
																if ($key == "paddress") {
																	$paddress[] = $value;
																} else {
																	if ($key == "taddress") {
																		$taddress[] = $value;
																	} else {
																		if ($key == "country") {
																			$country[] = $value;
																		} else {
																			if ($key == "state") {
																				$state[] = $value;
																			} else {
																				if ($key == "town") {
																					$town[] = $value;
																				} else {
																					if ($key == "zip") {
																						$zip[] = $value;
																					} else {
																						if ($key == "passportno") {
																							$passportno[] = $value;
																						} else {
																							if ($key == "doi") {
																								$doi[] = $value;
																							} else {
																								if ($key == "ic") {
																									$ic[] = $value;
																								} else {
																									if ($key == "icn") {
																										$icn[] = $value;
																									} else {
																										if ($key == "ipn") {
																											$ipn[] = $value;
																										} else {
																											if ($key == "feedback") {
																												$feedback[] = $value;
																											} else {
																												continue;
																											}
																										}
																									}
																								}
																							}
																						}
																					}
																				}
																			}
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}


                    for ($i = 0; $i < $manche; $i++) {

                        if (!empty($mname[$i])) {
							$b = ucfirst($mname[$i]) . ' ';
						} else {
							$b = '';
						}
						if ($fname[$i] == null || $lname[$i] == null) {
							$a = null;
						} else {
							$a = ucfirst($title[$i]) . ' ' . ucfirst($fname[$i]) . ' ' . $b . ucfirst($lname[$i]);
						}

                        $d = $year[$i] . '-' . $mm[$i] . '-' . $dd[$i];
						$dob = $d;

                        if ($doi != null) {
							$c = '1/1/' . $doi[$i];
							$dateofins = date('Y-m-d', strtotime($c));
						} else {
							$dateofins = null;
						}

                        $sabaitraveller[] = array(
							"bid" => $invoice,
							"name" => $a,
							"email" => $email[$i],
							"dob" => $dob,
							"contactno" => $contactno[$i],
							"paddress" => $paddress[$i],
							"taddress" => $taddress[$i],
							"country" => $country[$i],
							"state" => $state[$i],
							"town" => $town[$i],
							"zip" => $zip[$i],
							"passportno" => $passportno[$i],
							"doi" => $dateofins,
							"ic" => $ic[$i],
							"icn" => $icn[$i],
							"ipn" => $ipn[$i],
							"feedback" => $feedback[$i]
						);
					}

                    TripBookingDetail::insert($sabaitraveller);
					//equipments details
					$equipment_name = [];
					$equipment_price = [];
					$equipment_quantity = [];
					foreach ($alldata as $key => $val) {
						foreach ((array)$alldata[$key] as $value) {
							if ($key == "equipment_name") {
								$equipment_name[] = $value;
							} elseif ($key == "equipment_price") {
								$equipment_price[] = $value;
							} elseif ($key == "equipment_quantity") {
								$equipment_quantity[] = $value;
							} elseif ($key == "equipment_id") {
								$equipment_id[] = $value;
							} else {
								continue;
							}
						}
					}

                    $number = array_sum($equipment_quantity);
					if ($number != 0) {
						for ($i = 0; $i < count($equipment_name); $i++) {
							$flag[$i] = false;
							if ($equipment_quantity[$i] != 0) {
								$flag[$i] = true;
							}
							if ($flag[$i] == true) {
								$equipments[] = array(
									"equipment_name" => $equipment_name[$i],
									'equipment_price' => $equipment_price[$i],
									'equipment_quantity' => $equipment_quantity[$i],
									'bid' => $invoice
								);
							}
						}
					} else {
						$equipments = 0;
					}

                    if ($equipments != 0) {
						TExtraServices::insert($equipments);
					}
					//optional activities
					$activity_name = [];
					$activity_price = [];
					$activity_quantity = [];
					foreach ($alldata as $key => $val) {
						foreach ((array)$alldata[$key] as $value) {
							if ($key == "activity_name") {
								$activity_name[] = $value;
							} elseif ($key == "actprice") {
								$activity_price[] = $value;
							} elseif ($key == "optact_number") {
								$activity_quantity[] = $value;
							} else {
								continue;
							}
						}
					}

                    $number1 = array_sum($activity_quantity);
					if ($number1 != 0) {
						for ($i = 0; $i < count($activity_name); $i++) {
							$flag[$i] = false;
							if ($activity_quantity[$i] != 0) {
								$flag[$i] = true;
							}
							if ($flag[$i] == true) {
								$activities[] = array(
									"title" => $activity_name[$i],
									'price' => $activity_price[$i],
									'pax' => $activity_quantity[$i],
									'bid' => $invoice
								);
							}
						}
					} else {
						$activities = 0;
					}

                    if ($activities != 0) {
						TripBookedActivities::insert($activities);
					}


                    //process for invoice pdf
					$booking = TripBookings::where('bookid', '=', $invoice)->first();
					$name = TripBookingDetail::where('bid', '=', $invoice)->first();

                    $trip = Trips::findOrFail($tripid);
					$gdiscount = $alldata['groupdiscount'];
					if (isset($alldata['specialdis'])) {
						$sdiscount = $alldata['specialdis'];
					} else {
						$sdiscount = 0;
					}

                    $discount = $alldata['earlybookdiscount'];

                    $coupon1discount = Session::get('users.coupons1' . Auth::user()->id);

                    $allcoupons = null;

                    if ($coupon1discount != null) {
						$allcoupons = Coupons::findOrFail($coupon1discount);
					} else {
						$allcoupons = null;
					}

                    if (!empty($allcoupons)) {
						$adddiscount = [];
						foreach ($allcoupons as $a) {
							if ($a) {
								if ($a->trip_price >= $trip->price) {
									$coudiscount = round(($a->discount / 100) * $trip->price);
									$remainamount = $a->discountamount - $coudiscount;

                                    if ($remainamount > 0) {
										$coudiscount = round(($a->discount / 100) * $trip->price);
										Coupons::findOrFail($a->id)->update(['discountamount' => $remainamount, 'partial_used' => 1]);
									} else {
										$coudiscount = $a->discountamount;
										Coupons::findOrFail($a->id)->update(['redeemed' => 1]);
									}
									echo $coudiscount;
								} else {
									$coudiscount = $a->discountamount;
									Coupons::findOrFail($a->id)->update(['redeemed' => 1]);
								}
								array_push($adddiscount, $coudiscount);
							}
						}
						$totaldiscountamount = array_sum($adddiscount);
					} else {
						$totaldiscountamount = null;
					}

                    $packs = TripBookedActivities::where('bid', '=', $invoice)->get();
					$equipments = TExtraServices::where('bid', '=', $invoice)->get();
					$tripbooking = TripBookings::where('bookid', '=', $invoice)->first();

                    $customprice = $alldata['customprice'];

                    $data = array(
						'trip' => $trip,
						'name' => $name,
						'equipments' => $equipments,
						'discount' => $discount,
						'payment' => $payment,
						'booking' => $booking,
						'gdiscount' => $gdiscount,
						'sdiscount' => $sdiscount,
						'customprice' => $customprice,
						'disamo' => $totaldiscountamount,
						'tripbooking' => $tripbooking,
						'allpacks' => $packs
					);

                    $pdf = PDF::loadView('frontend.InvoiceTemplate.pending.invoice2', $data)
						->setPaper('a4')->setOrientation('portrait')->setOption('margin-bottom', 0)->setOption('margin-top', 0);
					$pdf->save(storage_path('Invoices/Pending/invoice#' . $invoice . ".pdf"));

                    $pdf1 = PDF::loadView('frontend.InvoiceTemplate.paid.invoice2', $data)
						->setPaper('a4')->setOrientation('portrait')->setOption('margin-bottom', 0)->setOption('margin-top', 0);

                    $pdf1->save(storage_path('onlinepayment/invoice_number#' . $invoice . ".pdf"));

                    $booking = TripBookings::where('bookid', '=', $invoice)->first();
					$user = $booking->user;
					$name = $user->name;
					$trip = $booking->trips;

                    $price = $trip->price;

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
						$date->addMonths(18);
						$date = date('Y-m-d', strtotime($date));
						Mail::to($user)->later(5, new CouponCode($name, $code, $discount, $amount, $date));
					}

                    Mail::to($user)->later(5, new ConfirmTripBooking($user, $trip, $tripbooking, $invoice));

                    $request->session()->forget('users.coupons1' . Auth::user()->id);
				});
				$status = is_null($exception) ? true : $exception;
            } catch (Exception $e) {
				dd($e);
				$status = false;
			}

            $message = ($status) ? 'Thank You for booking a trip with us! Please find the invoice  at ' . Auth::user()->email : 'Error Occured! Try Again!';
			$alert = ($status) ? 'success' : 'error';

            $notification = array(
				'message' => $message,
				'alert-type' => $alert,
			);

            return redirect('/')->with($notification);
		}

		public function sendmail($id){
		    $detail = CustomPayment::findorFail($id);
            Mail::to($detail->email)->later(5, new SendCustomInvoice($detail));
            $detail->update(['mail_sent'=>1]);
            return redirect('backend/attemptpaymentdetails')->with('success', 'Mail Sent Successfully !');
        }
	}

