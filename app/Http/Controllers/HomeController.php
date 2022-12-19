<?php

namespace App\Http\Controllers;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;
use App\Models\Results; 
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function welcome()
    {
        $dados = \App\Models\Dashboard::home();
        return view('Dashboard.welcome', ['dados' => $dados])->with('no', 1);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getResultEvent()
    {
        $dados = 0;
        \App\Models\Results::getResultEvent($dados);        
        return redirect('home');
    }

    
    public function getResultEventReproc($id)
    {

        \App\Models\Results::getResultEventReproc($id);        
        return redirect('home');
    }


    public function index(){

        $dados = \App\Models\Dashboard::home();
        
        return view('Dashboard.index', ['dados' => $dados])->with('no', 1);

    }

    public function geraCategoriaDrivers(){

        $categoria = \App\Models\Results::geraCategoriaDrivers();
        return redirect('home');

    }

    public function openEvent($id){

        $categoria = \App\Models\Results::openEvent($id);
        return redirect('home');

    }


    static public function kartRaffle(Request $request){

        $set = [
            "module"    => "cpt",
            "prefix"    => "kartRaffle",
            "title"     => "Karts para etapa",
        ];

        if($request->ajax()){                 

            $dados = \App\Models\Results::kartRaffle($request);

            if( isset($request->randon) ){
                sleep(5);
                return view($set['module'].".".$set['prefix'].'.timeline', ['drivers' => $dados ])->with('no', 1)->render();
            }else{                
                return response()->json(["data"=>$dados],Response::HTTP_OK) ;
            }

            
        } 

        $dados = \App\Models\Results::kartRaffle( $set );
        
        return View($set['module'].".".$set['prefix'].'.index', compact('set', 'dados' ));
        
    }

}