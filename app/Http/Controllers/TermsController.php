<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;

class TermsController extends Controller
{
    public function terms(){
        // $filename = storage_path('terms/SwotahBookingTerms.pdf")
        return Response::make(file_get_contents(storage_path('terms/SwotahBookingTerms.pdf')), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename=SwotahBookingTerms.pdf'
        ]);
    }
}