<?php

namespace App\Http\Controllers;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function welcome()
    {

        $dados = \App\Models\Dashboard::home();
        return view('welcome.welcome', ['dados' => $dados])->with('no', 1);
    }


}
