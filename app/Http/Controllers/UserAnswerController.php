<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAnswer;
use Illuminate\Support\Facades\Auth;
use App\Models\Mock;
use App\Models\User;

class UserAnswerController extends Controller
{
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
        //
    }

    public function check(){
        $userAnswers = UserAnswer::get();
        $userAnswerData = [];

        foreach ($userAnswers as $userAnswer) {
            $userId = $userAnswer->user_id;
            $mockId = $userAnswer->mock_id;

            if (!isset($userAnswerData[$userId][$mockId])) {
                $userAnswerData[$userId][$mockId] = [
                    'mock_title' => $userAnswer->mock->title,
                    'username' => $userAnswer->user->email,
                    'id' => $userAnswer->id,
                    'questions' => [],
                ];
            }
            $userAnswerData[$userId][$mockId]['questions'][] = [
                'question' => $userAnswer->question->question,
                'answer' => $userAnswer->answer,
                'question_id' => $userAnswer->question_id,
                'id' => $userAnswer->id
            ];
        }        
        return view('admin.checkResult',compact('userAnswerData'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function scoreAns(Request $request){
        $totalScore = 0;
        foreach($request->input('score') as $score){
            $totalScore += intval($score); 
        }

        $mock = Mock::findOrFail(intval($request->input('mockId')));
        $user = User::findOrFail($request->input('userId'));
        $user->mocks()->syncWithoutDetaching([$mock->id => ['score' => $totalScore, 'score_status' => 'MARKED']]);

        foreach($request->input('ids') as $id){
            $delete = UserAnswer::find($id);
            $delete->delete();
        }

        dd($user);
        
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
