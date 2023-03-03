<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Services\SubjectService;
use App\Services\QuestionService;
use App\Services\AnswerService;
use App\Services\MockService;
use App\Services\UserAnswerService;
use App\Models\Mock;

class MockController extends Controller
{

    private $subjectService;
    private $questionService;
    private $mockService;
    private $userAnswerService;

    public function __construct(SubjectService $subjectService,QuestionService $questionService,MockService $mockService,UserAnswerService $userAnswerService)
    {
        $this->subjectService = $subjectService;
        $this->questionService = $questionService;
        $this->mockService = $mockService;
        $this->userAnswerService = $userAnswerService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mockLists = $this->mockService->list();
        return view('home',compact('mockLists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'subjects'=>'required|array|min:1',
            'subjects.*'=>'numeric|distinct',
        ]);
        $subjects = $validatedData['subjects'];

        $questions = $this->questionService->findFrom($subjects);
        return view('admin.createMock', compact('questions'));
    }

    public function chooseSubjects(){
        $subjectList = $this->subjectService->list();
        return view('admin.selectMockSubject',compact('subjectList'));
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
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'questions'=>'required|array|min:1',
            'questions.*'=>'numeric|distinct',
        ]);

        $newMock = $this->mockService->create($validatedData['name'],$validatedData['start_date'],$validatedData['end_date']);
        $questionIds = array_map('intval', $validatedData['questions']);
        $newMock->questions()->attach($questionIds);
        return redirect('/')->with('success', $newMock->title.' has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mock = Mock::findOrFail($id);
        $questions = $mock->questions()->select('question_id')->get();
        $formattedArray = [];
        foreach($questions as $question){
            $questionTitle = $this->questionService->getTitle($question->question_id);
            $answers = $this->questionService->getAnswers($question->question_id);
            $formattedArray[] = (object)[
                'answers' => $answers,
                'question_id' => $question->question_id,
                'question' => $questionTitle->question,
                'questionType' => $questionTitle->type,
                'mockId' => $id,
            ];
        }
        return view('mock.mock',compact('formattedArray'));
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

    public function adminViewMock(){
        $mockList = $this->mockService->list();
        $mockData = [];
        foreach($mockList as $mock){
            $mockQuestion = Mock::findOrFail($mock->id);
            $questionsList = $mock->questions()->select('question')->get();
            $mockData[$mock->id] = [
                'title' => $mock->title,
                'questions' => $questionsList
            ];
            //dd($questions);
        }
        return view('admin.adminMockList',compact('mockData'));
        //dd($mockList);
    }

    public function checkResult(Request $request){

        $validatedData = $request->validate([
            'question'=>'required|array|min:1',
            'answer'=>'required|array|min:1',
        ]);

        $totalMarks = sizeof($validatedData['question']);
        $totalScore = 0;
        $scoreStats = "NORMAL";
    
        foreach($validatedData['question'] as $question){
            $answerFor =  intval($request->input('answer.'.$question));
            $questionId = intval($question);
            $correctAnswer = $this->questionService->correctAnswer($answerFor,$questionId);
            if($correctAnswer === 1){
                $totalScore++;
            }
        }
        if($request->input('answerWritten')){
            $scoreStats = "PENDING";
        }

        $user = Auth::user();       
        $mock = Mock::findOrFail(intval($request->input('mock_id')));
        if($scoreStats === "PENDING"){
            $user->mocks()->syncWithoutDetaching([$mock->id => ['score' => $totalScore, 'score_status' => 'PENDING']]);
            foreach($request->input('answerWritten') as $questionId => $answer){
                $ansUser = $this->userAnswerService->create($user->id, intval($request->input('mock_id')), $questionId, $answer);
            }
            return redirect('/score')->with('success', 'Your answers has been submitted.');
        }
        else{
            $user->mocks()->syncWithoutDetaching([$mock->id => ['score' => $totalScore, 'score_status' => 'MARKED']]);
            return redirect('/score')->with('success', $totalScore.' scored out of ' .$totalMarks);
        }
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
