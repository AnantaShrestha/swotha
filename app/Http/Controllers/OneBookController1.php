<?php

namespace App\Http\Controllers;

use App\BookedActivities;
use App\BookingDetail;
use App\Bookings;
use App\Coupons;
use App\Equipment;
use App\ExtraServices;
use App\HoldDates;
use App\Mail\Invoice;
use App\Payment;
use App\Themes;
use App\TripDates;
use App\Trips;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class OneBookController extends Controller
{
    public function showform(Request $request, $id)
    {
        if (Auth::user()) {
            if (Auth::user()->is_active != 1) {
                $notification = array(
                    'message' => 'Sorry, your account has not been activated yet. Please click the verification link from your email ('
                        . Auth::user()->email . ') to activate your account. Thank You!',
                );
                return redirect()->back()->with($notification);
            }
        } else {
            $notification = array(
                'message' => 'Please login to book this trip',
            );
            return redirect()->back()->with($notification);
        }

        $request->session()->forget('users.coupons1' . Auth::user()->id);

        $fdid = $id;
        $tripdate = TripDates::findOrFail($fdid);
        $trip = Trips::findOrFail($tripdate->trip_id);

        $invoiceNo = time();
        /*equipments*/
        $id = [];
        $count = 0;
        foreach ($trip->themes as $theme) {
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

        $extrapackages = $trip->extraPackages;

        return view('frontend.newbooking.fixedandlast.fixedandlastbook', compact('tripdate', 'invoiceNo', 'allequipments', 'extrapackages', 'countries'));
    }

    public function changegroupdiscount(Request $request)
    {
        $people = $request->person;
        $trip_id = $request->tripid;

        $tripdate = TripDates::find($trip_id);
        $trip = Trips::find($tripdate->trip_id);

        $totalrange = explode(',', $trip->customtrip->group_discount);

        foreach ($totalrange as $item) {
            $price = explode('=', $item);
        }

        $person = $price[0];
        $dis = $price[1];

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

        $tripdate = TripDates::findOrFail($tripid);
        $actualprice = Coupons::where('code', '=', $code)->first();

        if (!$actualprice) {
            $cmessage = "Coupon does not exist";
        }

        $coupon1discount = Session::get('users.coupons1' . Auth::user()->id);
        if (!empty($coupon1discount) || $actualprice) {
            if (!empty($coupon1discount)) {
                $all = array_unique($coupon1discount);
                $allcoupons = Coupons::findOrFail($all);
                foreach ($allcoupons as $a) {
                    if ($a) {
                        if ($a->trip_price >= $tripdate->trips->price) {
                            $coudiscount = round(($a->discount / 100) * $tripdate->trips->price);
                            $remainamount = $a->discountamount - $coudiscount;

                            if ($remainamount > 0) {
                                $coudiscount = round(($a->discount / 100) * $tripdate->trips->price);
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
                        $cmessage = 'You have already used this coupon';
                    }
                } else {
                    $cmessage = 'Coupon does not exist';
                }
            }

            if ($actualprice == null) {
                $cmessage = "Coupon does not exist";
            } else {
                if ($actualprice) {
                    if ($actualprice->created_at->addMonths(18)->isPast()) {
                        $cmessage = "Your coupon has already been expired.";
                    }

                    if ($actualprice->redeemed == 1) {
                        $cmessage = "Coupon already Used";
                    }
                }

                if ($cmessage == null) {
                    $id = $actualprice->id;
                    if ($actualprice->trip_price >= $tripdate->price) {
                        $coudiscount = round(($actualprice->discount / 100) * $tripdate->price);

                        $remainamount = $actualprice->discountamount - $coudiscount;

                        if ($remainamount > 0) {
                            $coudiscount = round(($actualprice->discount / 100) * $tripdate->trips->price);
                            $cmessage1 = 'You have received coupon discount worth $ ' . $coudiscount . ' and you can use remaining $' . $remainamount . ' for another booking using same coupon';

                        } else {
                            $coudiscount = $actualprice->discountamount;
                            $cmessage1 = 'You have received coupon discount worth $ ' . $coudiscount;
                        }


                    } else {
                        $coudiscount = $actualprice->discountamount;
                        $cmessage1 = 'You have received coupon discount worth $ ' . $coudiscount;
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
        $alldata = $request->all();

        $invoice = $alldata['invoiceno'];
        $tripdateid = $alldata['tripdateid'];
        $previousinfo = Session::get('invoicedetails');

        $manche = $alldata['not'];


        $a = new Bookings();
        $a->user_id = Auth::user()->id;
        $a->trip_id = $tripdateid;
        $a->people = $manche;
        $a->bookid = $invoice;
        $a->save();

        $payment = new Payment();
        if ($previousinfo[1] == "full") {
            $payment->bid = $invoice;
            $payment->status = "pending";
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
            $payment->status = "pending";
            $payment->date = Carbon::now()->format('Y-m-d');
            $payment->chosen = "confirm";
            $payment->paid_amount = $paid_amount;
            $payment->due_amount = $due_amount;
        }

        $payment->save();
        //person's details
        foreach ($alldata as $key => $val) {
            foreach ((array)$alldata[$key] as $value) {
                if ($key == "title") {
                    $title[] = $value;
                } else if ($key == "fname") {
                    $fname[] = $value;
                } else if ($key == "mname") {
                    $mname[] = $value;
                } else if ($key == "lname") {
                    $lname[] = $value;
                } else if ($key == "email") {
                    $email[] = $value;
                } else if ($key == "dd") {
                    $dd[] = $value;
                } else if ($key == "mm") {
                    $mm[] = $value;
                } else if ($key == "year") {
                    $year[] = $value;
                } else if ($key == "contactno") {
                    $contactno[] = $value;
                } else if ($key == "paddress") {
                    $paddress[] = $value;
                } else if ($key == "taddress") {
                    $taddress[] = $value;
                } else if ($key == "country") {
                    $country[] = $value;
                } else if ($key == "state") {
                    $state[] = $value;
                } else if ($key == "town") {
                    $town[] = $value;
                } else if ($key == "zip") {
                    $zip[] = $value;
                } else if ($key == "passportno") {
                    $passportno[] = $value;
                } else if ($key == "doi") {
                    $doi[] = $value;
                } else if ($key == "ic") {
                    $ic[] = $value;
                } else if ($key == "icn") {
                    $icn[] = $value;
                } else if ($key == "ipn") {
                    $ipn[] = $value;
                } else if ($key == "feedback") {
                    $feedback[] = $value;
                } else {
                    continue;
                }
            }
        }


        for ($i = 0; $i < $manche; $i++) {

            if (!empty($mname[$i])) {
                $b = ucfirst($mname[$i]) . ' ';
            } else {
                $b = '';
            }
            if ($fname[$i] == null or $lname == null) {
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

        if (!isset($input1['is_hold'], $input1['hold_id'])) {
            $updateseats = $remainseat - $bookedseats;
            TripDates::where('id', '=', $alldata['tripid'])->update(['remainingseats' => $updateseats]);
        } else {
            HoldDates::where('id', $alldata['hold_id'])->delete();
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
            'tripdate' => $tripdate, 'name' => $name, 'equipments' => $equipments,
            'discount' => $discount, 'payment' => $payment,
            'booking' => $booking, 'gdiscount' => $gdiscount, 'sdiscount' => $sdiscount, 'ldiscount' => $ldiscount,
            'disamo' => $totaldiscountamount,
            'allpacks' => $packs
        );


        $pdf = PDF::loadView('frontend.InvoiceTemplate.pending.invoice1', $data)
            ->setPaper('a4')->setOrientation('portrait')->setOption('margin-bottom', 0)->setOption('margin-top', 0);
        $pdf->save(storage_path('Invoices/Pending/invoice#' . $invoice . ".pdf"));

        $pdf1 = PDF::loadView('frontend.InvoiceTemplate.paid.invoice1', $data)
            ->setPaper('a4')->setOrientation('portrait')->setOption('margin-bottom', 0)->setOption('margin-top', 0);

        $pdf1->save(storage_path('Invoices/Paid/invoice#' . $invoice . ".pdf"));

        $user = Auth::user();

        Mail::to($user)->later(5, new Invoice($user, $tripdate, $invoice));

        $request->session()->forget('users.coupons1' . Auth::user()->id);
        $notification = array(
            'message' => 'Thank You for booking a trip with us! Please find the invoice with bank account details at ' . Auth::user()->email,
            'alert-type' => 'success',
        );

        return redirect('/')->with($notification);

    }

    public function savedataonline(Request $request)
    {
        $maindata = $request->all();
        $previousinfo = Session::get('invoicedetails');

        $request->session()->put('maindata', $maindata);

        $totalP = null;

        if ($previousinfo[1] == "full") {
            $totalP = $previousinfo[0][5];
        } else {
            $totalP = $previousinfo[2];
        }

        $invoice = $maindata['invoiceno'];
        $tripid = $maindata['tripid'];

        $trip = Trips::findOrFail($tripid);
        $tripname = $trip->name;

        return view('frontend.newbooking.fixedandlast.payonline', compact('totalP', 'invoice', 'tripname'));
    }
}
