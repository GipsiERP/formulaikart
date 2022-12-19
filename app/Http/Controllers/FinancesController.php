<?php

namespace App\Http\Controllers;

use App\Models\Finances;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FinancesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        $this->set = [
            "title"     => "Financeiro - Contas a pagar e receber",
            "prefix"    => 'Finances',
            "module"    => 'cpt',
         ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->ajax()){                 
            $dados = \App\Models\Finances::
            selectRaw("finances.id, number, 
                FORMAT(value, 2,'de_DE') as value,
                FORMAT(value_pay, 2,'de_DE') as value_pay,

                DATE_FORMAT(due_pay, '%d-%m-%Y') as due_pay, 
                DATE_FORMAT(due, '%d-%m-%Y') as due ,
                DATE_FORMAT(data, '%d-%m-%Y') as data,
                CASE 
                    WHEN ( date(DATE_FORMAT(now(),'%Y-%m-%d')) < date(DATE_ADD(due, INTERVAL 1 day)) and due_pay is null) THEN 'A vencer'
                    WHEN (due_pay is null) THEN 'atrasado'
                    ELSE 'pago'
                END AS status,
                concat(IFNULL(drivers.name, ''), IFNULL(suppliers.name, '') ) as name"
            )
            ->leftjoin('suppliers'  , 'finances.supplier_id' , '=', 'suppliers.id')
            ->leftjoin('drivers'    , 'finances.driver_id' , '=', 'drivers.id')
            ->get();
            return response()->json(["data"=>$dados],Response::HTTP_OK) ;
            
        } 

        $set = $this->set;
        $dados = \App\Models\Banks::selectRaw("id, CONCAT(name,'-',agencia) as name")
            ->where('status', 1 )
            ->get();

        return View($set['module'].".".$set['prefix'].'.index', compact('set', 'dados' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return abort(403);
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
        $this->validate($request, [
            'action'            => 'required'
        ], [
            'action.required'   => 'Revise.'
        ]);

        if ( $request->action === "pay" ){
            
            $this->validate($request, [    
                'ids'           => 'required|array',
                'ids.*'         => 'exists:finances,id',
                'pay_date'      => 'required|date',
                'qtde_pay'      => 'required|numeric',
                'bank_id'       => 'required|exists:banks,id',
            ],[ 
                'ids.required'       => 'Revise.',
                'ids.array'          => 'Erro ao processar.',
                'ids.exists'         => 'Erro ao processar item :process.',
                'pay_date.required' => 'Revise a data de pagamento(s).',
                'qtde_pay.required' => 'revise a qtde de pagamento(s)',
                'bank_id.required'  => 'revise o banco para pagamento',
            ]); 
            // dd("passou",$request->ids);

            foreach($request->ids as $i){
// dd($i["id"]);
                $dados = \App\Models\Finances::updateOrCreate([
                    'id'                => $i["id"]
                ],[
                    'due_pay'           => $request->pay_date,
                    'value_pay'         => $i["valor"],
                    'bank_id'           => $request->bank_id
                ]);
            }
            return response()->json(["data"=>"Salvo com sucesso !"],Response::HTTP_OK) ;


        }

        $this->validate($request, [
            'id'            => 'required',
            // 'number'        => 'required',
            'due'           => 'required|date_format:Y-m-d',
            // 'name'          => 'required',
            // 'date'          => 'required|date_format:Y-m-d',
            // 'due'           => 'nullable|date_format:Y-m-d',
            // 'value'         => 'required|min:0'
        ], [
            'id.required'       => 'Revise.',
            'name.required'     => 'Revise apelido do Piloto / Fornecedor.',
            'data.required'     => 'Revise a data da realização.',
            'horario.required'  => 'Revise o horário da realização',
            'fee_value.required'=> 'Revise o valor da inscrição.',
            'track_id.required' => 'Revise a Etapa / Corrida.',
            'due.required'      => 'Revise a data de vencimento.',
        ]);
        
        $dados = \App\Models\Finances::updateOrCreate([
                'id'            => $request->id
            ],[
                'due'           => $request->due,
                // 'number'        => $request->number,
                //'name'          => $request->name
                // 'date'          => $request->date,
                // 'value'         => $request->value
            ]);

        return response()->json(["data"=>"Salvo com sucesso !"],Response::HTTP_OK) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Finances  $finances
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $dados = \App\Models\Finances::
            selectRaw("finances.id, number, 
                value,
                due ,
                concat(IFNULL(drivers.name, ''), IFNULL(suppliers.name, '') ) as name"
            )
            ->leftjoin('suppliers'  , 'finances.supplier_id' , '=', 'suppliers.id')
            ->leftjoin('drivers'    , 'finances.driver_id' , '=', 'drivers.id')
            ->findorfail($id);
        
        return response()->json(["data"=>$dados],Response::HTTP_OK) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Finances  $finances
     * @return \Illuminate\Http\Response
     */
    public function edit(Finances $finances)
    {
        //
        return abort(403);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Finances  $finances
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdmFinance $admFinance)
    {
        //
        return abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Finances  $finances
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Finances $finances)
    {
        //
        $this->validate($request, [
            'id'            => 'required|numeric'
        ]);
        $dados = \App\Models\Finances::findorfail($request->id)
            ->delete();

        return response()->json(["data"=>"Excluído com sucesso !"],Response::HTTP_OK) ;
    }
}
