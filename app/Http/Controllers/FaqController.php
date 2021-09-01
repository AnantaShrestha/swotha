<?php

namespace App\Http\Controllers;

use App\Faq;
use App\FaqQuestion;
use App\Helper\PasswordChecker;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$faq = Faq::all();
        return view('admin-panel.faq.index', compact('faq'));
    }
    
    public function addTopic(Request $request){
    	$input = $request->all();
    	
    	if(!isset($input['topic'])){
    		return redirect()->back()->with('error', 'Please enter the topic');
	    }
	    
	    Faq::create([
	    	'topic'=>$input['topic'],
	    ]);
    	
    	return redirect('/backend/faq')->with('success', 'Topic added successfully.');
    }
    
    public function editTopic($id){
    	$topic = Faq::where('id', $id)->first();
    	return view('admin-panel.faq.editTopic', compact('topic'));
    }
    
    public function updateTopic(Request $request, $id){
    	$input = $request->all();
	    $topic = Faq::where('id', $id)->first();
	    $topic->topic = $input['topic'];
	    $topic->save();
	    
	    return redirect('/backend/faq')->with('success', 'Topic renamed sucessfully.');
    }
    
    public function deleteTopic(Request $request, $id){
	    $input = $request->all();
	    $result = PasswordChecker::checkpass($input['password']);
	
	    if($result == true){
		    $topic = Faq::where('id', $id)->first();
		    $topic->delete();
		    return redirect()->back()->with('success', 'Topic Deleted Successfully.');
	    } else {
		    return redirect()->back()->with('error', 'The password you entered is incorrect.');
	    }
    }
    
    public function showQuestions($id){
    	$questions = FaqQuestion::where('faq_id', $id)->get();
    	$topic = Faq::select('topic')->where('id', $id)->first()->topic;
    	
    	return view('admin-panel.faq.questions', compact('questions','topic','id'));
    }
    
    public function addQuestion(Request $request, $id){
        $input = $request->all();
        
        if(!isset($input['question'])){
        	return redirect()->back()->with('error', 'Question can\'t be empty.');
        } elseif(!isset($input['description'])){
        	return redirect()->back()->with('error', 'Answer can\'t be empty.');
        }
        
        FaqQuestion::create([
        	'faq_id'=>$id,
	        'question'=>$input['question'],
	        'description'=>$input['description']
        ]);
        
        return redirect()->back()->with('success', 'FAQ added successfully.');
    }
    
    public function deleteQuestion(Request $request, $id){
	    $input = $request->all();
	    $result = PasswordChecker::checkpass($input['password']);
	
	    if($result == true){
		    $topic = FaqQuestion::where('faq_id', $id)->first();
		    $topic->delete();
		    return redirect()->back()->with('success', 'Question Deleted Successfully.');
	    } else {
		    return redirect()->back()->with('error', 'The password you entered is incorrect.');
	    }
    }
    
    public function showDescription($id){
    	$question = FaqQuestion::where('id', $id)->first();
    	
    	if(is_null($question)){
    		return redirect()->back()->with('error', 'The question you are trying to view doesn\'t exist.');
	    }
	
	    $allTopics = Faq::all();
	
	    return view('admin-panel.faq.showQuestion', compact('question', 'allTopics'));
    }
    
    public function updateQuestion(Request $request, $id){
    	$input = $request->all();
    	
    	$question  = FaqQuestion::where('id', $id)->first();
    	
    	if(is_null($question)){
    		return redirect()->back()->with('error', 'The Question you are trying to update doesn\'t exist.');
	    }
	    
	    $question->question = $input['question'];
    	$question->description = $input['description'];
    	$question->faq_id = $input['topic'];
     	$question->save();
    	
    	$topic_id = $question->topic->id;
    	
    	return redirect('/backend/faq/questions/'.$topic_id)->with('success', 'Question updated successfully.');
    }
}
