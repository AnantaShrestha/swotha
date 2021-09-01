<?php

namespace App\Http\Controllers;

use App\Faq;

class FrontFaqController extends Controller
{
    public function show(){
        $faq = Faq::with('questions')->get();
        return view('frontend.faq.questions', compact('faq'));
    }

    /* public function topicQuestions($id){
         $allQuestions = FaqQuestion::where('faq_id', $id)->get();
         $faq = Faq::all();
         $active = Faq::where('id', $id)->first()->topic;
         return view('frontend.faq.questions', compact('allQuestions', 'faq', 'active'));
     }*/
}
