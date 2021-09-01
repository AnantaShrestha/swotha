<?php

	namespace App\Http\Controllers;


    use App\Coupons;
    use App\DepositCancel;
    use App\Equipment;
    use App\Mail\TInvoice;
    use App\TermsnCondition;
    use App\TExtraServices;
    use App\Themes;
    use App\TPayment;
    use App\TripBookedActivities;
    use App\TripBookingDetail;
    use App\TripBookingDiscount;
    use App\TripBookings;
    use App\Trips;
    use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
    use Carbon\Carbon;
    use Exception;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\File;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Support\Facades\Session;

    class NormalBookController extends Controller
	{
		public function showform(Request $request, $id)
		{
//			dd($request->all());
			if (Auth::user()) {
				if (Auth::user()->is_active != 1) {
					$notification = array(
						'message' => 'Sorry, your account has not been actived yet. Please click the verification link from your email ('
							. Auth::user()->email . ') to activate your account. Thank You!',
					);
					return redirect()->back()->with($notification);
				}
			}

			$request->session()->forget('users.coupons1' . Auth::user()->id);

			$fdid = $id;
			$trips = Trips::findOrFail($fdid);

			$invoiceNo = time();
			/*equipments*/
			$id = [];
			$count = 0;
			foreach ($trips->themes as $theme) {
				$id[$count++] = $theme->id;
			}
			$themes = Themes::find($id);

			$items = [];
			$count = 0;
			foreach ($themes as $theme) {
				foreach ($theme->equipments as $equip) {
					$items[$count++] = $equip->id;
				}
			}

			$path = storage_path() . "/json/country.json";
			if (!File::exists($path)) {
				throw new Exception("Invalid File");
			}
			$file = File::get($path);
			$countries = \GuzzleHttp\json_decode($file, true);

			$uniqueitems = array_unique($items);
			$allequipments = Equipment::findOrfail($uniqueitems);

			$extrapackages = $trips->extraPackages;

			$termsDetails = TermsnCondition::where('selected', '=', 1)->first();
			$depositDetails = DepositCancel::where('selected', '=', 1)->first();
			return view('frontend.newbooking.normaltrip.normaltripbook', compact('trips', 'invoiceNo', 'allequipments', 'extrapackages', 'countries', 'termsDetails', 'depositDetails'));
		}

		public function changedeparture(Request $request)
		{
			$depdat = $request->startdate;
			$start_date = strtotime($depdat);
			$year = strtotime('-1 year ago');
			$_100days = strtotime('-100 day ago');
			$_60days = strtotime('-60 day ago');
			$earlybookdiscount = 0;
			$confirm = 100;

            if ($start_date >= $year) {
				$confirm = 15;
				$earlybookdiscount = 10;
			}
			if ($start_date >= $_100days and $start_date < strtotime('-364 day ago')) {
				$confirm = 20;
				$earlybookdiscount = 5;
			}
			if ($start_date >= $_60days and $start_date < strtotime('-99 day ago')) {
				$confirm = 25;
				$earlybookdiscount = 0;
			}
			if ($start_date >= strtotime('-30 day ago') and $start_date < strtotime('-59 day ago')) {
				$confirm = 50;
				$earlybookdiscount = 0;
			}
			if ($start_date < strtotime('-30 day ago')) {
				$confirm = 100;
				$earlybookdiscount = 0;
			}

            $data = array();
			$data[0] = date('j F, Y', $start_date);
			$data[1] = $earlybookdiscount;
			$data[2] = $confirm;
			$data[3] = $year;
			$data[4] = $_100days;
			$data[5] = $_60days;
			$data[6] = $start_date;
			return response()->json($data);
		}

        public function changegroupdiscount(Request $request)
		{
			$people = $request->person;
			$trip_id = $request->tripid;

            $trip = Trips::findorFail($trip_id);

            $totalrange = explode(',', $trip->customtrip->group_discount);

            foreach ($totalrange as $item) {
				$price = explode('=', $item);
			}

			$person = $price[0];
            $dis = $price[1] or 0;
			$price = null;

            if ($people >= $person) {
				$groupdiscount = str_replace('%', '', $dis);

            } else {

                foreach ($totalrange as $item) {
					$price = explode('=', $item);

                    if ($people == 1) {
						$groupdiscount = 0;
						continue;
					} elseif ($price[0] == $people) {
						$groupdiscount = str_replace('%', '', $price[1]);
						continue;
					}
				}
			}
			$data = array();
			$data[0] = $groupdiscount;
			return response()->json($data);
		}

        public function changecoupondiscount(Request $request)
		{
			$input = $request->all();
			$code = $input['coupon'];
			$tripid = $input['tripid'];
			$cmessage = null;
			$cmessage1 = null;
			$adddiscount = [];
			$alldiscount = null;
			$coupid = null;

            $trip = Trips::findOrFail($tripid);
			$actualprice = Coupons::where('code', '=', $code)->first();

            if (!$actualprice) {
				$cmessage = "Promo code doesnot exist";
			}

            $coupon1discount = Session::get('users.coupons1' . Auth::user()->id);
			if (!empty($coupon1discount) || $actualprice) {
				if (!empty($coupon1discount)) {
					$all = array_unique($coupon1discount);
					$allcoupons = Coupons::findOrFail($all);
					foreach ($allcoupons as $a) {
						if ($a) {
							if ($a->trip_price >= $trip->price) {
								$coudiscount = round(($a->discount / 100) * $trip->price);
								$remainamount = $a->discountamount - $coudiscount;

                                if ($remainamount > 0) {
									$coudiscount = round(($a->discount / 100) * $trip->price);
								} else {
									$coudiscount = $a->discountamount;
								}
							} else {
								$coudiscount = $a->discountamount;
							}
							array_push($adddiscount, $coudiscount);
						}
					}
					$alldiscount = array_sum($adddiscount);
					$coupid = Coupons::where('code', '=', $code)->first();
					if (!empty($coupid)) {
						if (in_array($coupid->id, $all)) {
							$cmessage = 'You have already used this promo code';
						}
					} else {
						$cmessage = 'Promo code doesnot exist';
					}
				}

                if ($actualprice == null) {
					$cmessage = "Promo code doesnot exist";
				} else {
					if ($actualprice) {
						if ($actualprice->created_at->addMonths(18)->isPast()) {
							$cmessage = "Your promo code has already been expired.";
						}

                        if ($actualprice->redeemed == 1) {
							$cmessage = "Promo code already Used";
						}
					}

                    if ($cmessage == null) {
						$id = $actualprice->id;
						if ($actualprice->trip_price >= $trip->price) {
							$coudiscount = round(($actualprice->discount / 100) * $trip->price);

                            $remainamount = $actualprice->discountamount - $coudiscount;

                            if ($remainamount > 0) {
								$coudiscount = round(($actualprice->discount / 100) * $trip->price);
								$cmessage1 = 'You have received promo code discount worth $ ' . $coudiscount . ' and you can use remaining $' . $remainamount . ' for another booking using same coupon';

                            } else {
								$coudiscount = $actualprice->discountamount;
								$cmessage1 = 'You have received promo code discount worth $ ' . $coudiscount;
							}


                        } else {
							$coudiscount = $actualprice->discountamount;
							$cmessage1 = 'You have received promo code discount worth $ ' . $coudiscount;
						}

                        $alldiscount = $alldiscount + $coudiscount;

                        $request->session()->push('users.coupons1' . Auth::user()->id, $id);
					}
				}
			}

            if ($cmessage != null) {
				$messagepat = $cmessage;
			} else {
				$messagepat = $cmessage1;
			}

            $data = array();
			$data[0] = $code;
			$data[1] = $messagepat;
			$data[2] = $alldiscount;
			$data[3] = $coupon1discount;
			return response()->json($data);
		}

        public function savefirstdata(Request $request)
		{
			$maindata = $request->formData;
			$request->session()->put('invoicedetails', $maindata);
			$data = array();
			$data[0] = $maindata;
			return response()->json($data);
		}

        public function savealldata(Request $request)
		{

            $status = false;
            
			try {
				$exception = DB::transaction(function () use ($request) {
					$alldata = $request->all();
					$invoice = $alldata['invoiceno'];
					$tripid = $alldata['tripid'];
					$previousinfo = Session::get('invoicedetails');
                    $manche = $alldata['not'];

                    $payment = new TPayment();

					if ($previousinfo[1] == "full") {
						//dd($previousinfo[1]);
						$payment->bid = $invoice;
						$payment->status = "pending";
						$payment->date = Carbon::now()->format('Y-m-d');
						$payment->chosen = "fullpayment";
						
						$payment->paid_amount = $previousinfo[0][0];

						$payment->due_amount = 0;
					} else {

                        if (!empty($previousinfo[2])) {
							$paid_amount = $previousinfo[2];
							$due_amount = $previousinfo[0][0] - $paid_amount;
						}

                        $payment->bid = $invoice;
						$payment->status = "pending";
						$payment->date = Carbon::now()->format('Y-m-d');
						$payment->chosen = "confirm";
						$payment->paid_amount = $paid_amount;
						$payment->due_amount = $due_amount;
					}
					$payment->grandtotal = $payment->paid_amount + $payment->due_amount;
					$payment->paid_amount_sum = 0;
					$payment->left_amount_sum = $payment->grandtotal;
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
																			if ($key == "state") {//cahena
																				$state[] = $value;
																			} else {
																				if ($key == "town") {//chaena
																					$town[] = $value;
																				} else {
																					if ($key == "zip") {//chaena
																						$zip[] = $value;
																					} else {
																						if ($key == "passportno") {
																							$passportno[] = $value;
																						} else {
																							if ($key == "doi") {//chaena
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
                    	if($key==0){
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
							if(isset($doi))
							{
								if ($doi != null) {
								$c = '1/1/' . $doi[$i];
								$dateofins = date('Y-m-d', strtotime($c));
								} else {
									$dateofins = null;
								}
							}
							else
								$dateofins=null;
							if(!isset($state))
								$state[]=null;
							if(!isset($town))
								$town[]=null;
							if(!isset($zip))
								$zip[]=null;
	                        

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
						break;
					}
                    TripBookingDetail::insert($sabaitraveller[0]);

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

                    $equipments = array();
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

                    $activities = array();
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

//                    dd($activities);

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

                    /*Save discounts and coupon value in database*/
					$bookdiscounts = new TripBookingDiscount();
					$bookdiscounts->early_booking_discount = $discount;
					$bookdiscounts->group_discount = $gdiscount;
					$bookdiscounts->special_discount = $sdiscount;
					$bookdiscounts->coupon_discount = $totaldiscountamount;
					$bookdiscounts->book_id = $invoice;
					$bookdiscounts->save();

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
                    //dd($data);
                    $pdf = PDF::loadView('frontend.InvoiceTemplate.pending.invoice', $data)
						->setPaper('a4')->setOrientation('portrait')->setOption('margin-bottom', 0)->setOption('margin-top', 0);

                    if (file_exists(storage_path('Invoices/Pending/invoice#' . $invoice . ".pdf"))) unlink(storage_path('Invoices/Pending/invoice#' . $invoice . ".pdf"));


                    $pdf->save(storage_path('Invoices/Pending/invoice#' . $invoice . ".pdf"));

                    $user = Auth::user();

                    Mail::to($user)->later(5, new TInvoice($user, $trip, $tripbooking, $invoice));

                    $request->session()->forget('users.coupons1' . Auth::user()->id);

                });
				$status = is_null($exception) ? true : $exception;
            } catch (Exception $e) {
				dd($e);
				$status = false;
			}

            $message = ($status) ? 'Thank You for booking a trip with us! Please find the invoice with bank account details at ' . Auth::user()->email : 'Error Occured! Try Again!';
			$alert = ($status) ? 'success' : 'error';

            $notification = array(
				'message' => $message,
				'alert-type' => $alert,
			);
			return redirect('/')->with($notification);
		}

        public function savedataonline(Request $request)
		{
			$maindata = $request->all();
			$previousinfo = Session::get('invoicedetails');
			//dd($previousinfo);
			$request->session()->put('maindata', $maindata);

            $totalP = null;

            if ($previousinfo[1] == "full") {
				//$totalP = $previousinfo[0][5];
				$totalP = $previousinfo[0][0];

			} else {
				$totalP = $previousinfo[2];
			}

            $invoice = $maindata['invoiceno'];
			$tripid = $maindata['tripid'];

            $trip = Trips::findOrFail($tripid);
			$tripname = $trip->name;

            return view('frontend.newbooking.normaltrip.trippayonline', compact('totalP', 'invoice', 'tripname'));
		}
	}
