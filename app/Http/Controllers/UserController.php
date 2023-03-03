<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user(); 
        $scores = User::findOrFail($user->id);
        $userScores = $scores->mocks()->select('score','score_status','mocks.title')->get();
        return view('users.profile',compact('userScores','user'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'password' => 'required',
            'confirm' => 'required',
            'email' => 'required|email|unique:users,email',
            'username'=>'required|unique:users,username',
        ]);
        if($validateData['password'] !== $validateData['confirm']){
            dd("Password not matching.");
        }
        else{
            $newUser = $this->userService->create($validateData['email'],$validateData['password'],$validateData['username']);
            $newUser->roles()->attach(2);
            Mail::to($newUser->email)->send(new VerifyEmail($newUser));
            return redirect('/login')->with('success', $newUser->email.'has been created. Verify to login.');
        }
    }

    public function login(Request $request){
        $validateData = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $userValid = $this->userService->verifyUser($validateData['email'],$validateData['password']);
        if($userValid === true){
            return redirect('/home')->with('success','You are logged in');
        }
        else{
            return back()->withErrors(['email' => 'Invalid login credentials']);
        }
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
        $user = User::findOrFail($id);
        $validateData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);
        //dd($validateData);
        $user->update($validateData);
        return redirect('/profile');
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
