<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SubjectService;
use App\Services\QuestionService;
use App\Services\AnswerService;


class QuestionController extends Controller
{

    private $subjectService;
    private $questionService;
    private $answerService;

    public function __construct(SubjectService $subjectService,QuestionService $questionService,AnswerService $answerService)
    {
        $this->subjectService = $subjectService;
        $this->questionService = $questionService;
        $this->answerService = $answerService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjectList = $this->subjectService->list();
        return view('admin.createQuestion',compact('subjectList'));
    }

    public function chooseType(){
        return view('admin.questionType');
    }

    public function showWrittenQuestion(){
        $subjectList = $this->subjectService->list();
        return view('admin.createWrittenQuestion',compact('subjectList'));
    }

    public function createWritten(Request $request){
        $validatedData = $request->validate([
            'question'=>'required',
            'subject_id'=>'required',
            'difficulty'=>'required',
        ]);

        $question = $this->questionService->createWritten(
            $request->input('question'),
            $request->input('subject_id'),
            $request->input('difficulty')
        );
        return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'question'=>'required',
            'subject_id'=>'required',
            'difficulty'=>'required',
            'correct_answer'=>'required',
            'option_one'=>'required',
            'option_two'=>'required',
            'option_three'=>'required',
        ]);

        $question = $this->questionService->create(
            $request->input('question'),
            $request->input('subject_id'),
            $request->input('difficulty')
        );

        $correctAnswer = $this->answerService->create(
            $question->id,
            $validatedData['correct_answer'],
            true
        );

        $optionOne = $this->answerService->create(
            $question->id,
            $validatedData['option_one'],
            false
        );

        $optionTwo = $this->answerService->create(
            $question->id,
            $validatedData['option_two'],
            false
        );

        $optionThree = $this->answerService->create(
            $question->id,
            $validatedData['option_three'],
            false
        );
        return redirect('/')->with('success', $question->question.' has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
