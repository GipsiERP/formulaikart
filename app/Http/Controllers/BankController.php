<?php

namespace App\Http\Controllers;

use App\Models\AdmBank;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdmBankController extends Controller
{
    private $set;
    private $notifications;

    public function __construct()
    {

        //
        // $this->middleware('permission:machine-list|machine-create|machine-edit|machine-delete', ['only' => ['index','store']]);
        // $this->middleware('permission:machine-create', ['only' => ['create','store']]);
        // $this->middleware('permission:machine-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:machine-delete', ['only' => ['destroy']]);

        $this->set = [
            "title"         => "Cadastro de Bancos",
            "prefix"        => 'AdmBank',
            "module"        => 'Adm',
            "notifications" => auth()->user()->unreadNotifications ?? [],
         ];


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->ajax()){
             
            $dados = \App\Models\AdmBank:://all();
            select('id', 'name', 'agencia', 'conta', 'contato_name','contato_telefone', 'contato_celular',
            'contato_email', 'codigo', 'adm_client_id', 'status')            
            ->get();
            return response()->json(["data"=>$dados],Response::HTTP_OK) ;
            
        } 

        $set = $this->set;
        return View($set['module'].".".$set['prefix'].'.index', compact('set' ));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdmBank  $admBank
     * @return \Illuminate\Http\Response
     */
    public function show(AdmBank $admBank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdmBank  $admBank
     * @return \Illuminate\Http\Response
     */
    public function edit(AdmBank $admBank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdmBank  $admBank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdmBank $admBank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdmBank  $admBank
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdmBank $admBank)
    {
        //
    }
}
