<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReportsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');

        $this->set = [
            "title"     => "Relatórios",
            "prefix"    => 'Reports',
            "module"    => 'cpt',
         ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kartRaffle( Request $request )
    {
       
        //
        if($request->ajax()){                 

            $dados = \App\Models\EventRaffles::selectRaw("id")
                ->get();

            return response()->json(["data"=>$dados],Response::HTTP_OK) ;
            
        } 

        $set = $this->set;
        $dados =  \App\Models\Results::GetReportsKartRaffles();
        
        return View($set['module'].".".$set['prefix'].'.reports', compact('set', 'dados' ));
        
    }
}
