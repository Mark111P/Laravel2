<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Nette\Utils\Random;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login.index');
    }

    public function code(Request $request){
        $email = $request->email;
        $code = Random::generate(6, '0-9');

        $list = Login::all()->where('email', $email);
        if (count($list) > 0) {
            $login = $list->first()->update(['code' => $code]);
        }
        else{
            $login = new Login();
            $login->email = $email;
            $login->code = $code;
            $login->save();
        }
        return view('login.code', compact('code', 'email'));
    }

    public function verify(Request $request){
        $email = $request->email;
        $code = $request->code;

        $userCode = Login::all()->where('email', $email)->value('code');
        if ($code == $userCode) {
            setcookie('email', $email, time() + 86400, "/");
            return redirect()->route('news.index');
        }
        else{
            return redirect()->back();
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
