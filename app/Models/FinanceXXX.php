<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class AdmFinance extends Model
{
    use HasFactory, Notifiable, HasRoles, LogsActivity, SoftDeletes;

    protected $fillable = [
        "adm_client_id",
        "adm_service_type_id",
        'number',
        'date',
        'value',
        'due',
        'data',
        'paydue',
        'seuNumero',
        'nossoNumero',
        'codigoBarras',
        "linhaDigitavel",
        'processed',
        'pay',
        'pay_discount',
        'pay_plus',
        'tp_baixa',
        'admbank_id',
        "pdf",
        "admsupplier_id",
        "type",
    ];

    public static function newInvoice($billing){ 
        
        $n = 0;
        foreach($billing as $c){
Echo "AdmServiceTypeClient: $c->adm_client_id ";
            
            $client = \App\Models\AdmClient::find($c->adm_client_id);

            // $today = date("Y-m-d", strtotime("2021/10/01")); 
            $today = date("Y-m-d"); 
            
            $serviceType = \App\Models\AdmServiceTypeClient::select(
                    "adm_service_type_clients.id",
                    "adm_service_type_clients.qtde",
                    "adm_service_type_clients.coef",

                    "adm_service_types.id as id_service_type",
                    "adm_service_types.name as service_type",
                    "adm_service_types.day_pay",
                    "adm_service_types.adm_type_invoices_id",

                    "adm_service_type_prices.id as id_price",
                    "adm_service_type_prices.price",
                    "adm_service_type_prices.und", 
                    "adm_service_type_clients.start"
            
                )
                ->join('adm_service_type_prices', 'adm_service_type_clients.adm_price_id', '=', 'adm_service_type_prices.id')
                ->join('adm_service_types'      , 'adm_service_type_clients.adm_service_type_id', '=', 'adm_service_types.id')
                
                ->whereDate('adm_service_type_clients.start', '<=', $today)
                ->whereDate('adm_service_type_clients.end', '>=', $today)
//                ->WhereNull('adm_service_type_clients.end')

                ->whereDate('adm_service_type_prices.start', '<=', $today)
                ->where("adm_service_types.status", true)

                ->where("adm_service_type_clients.adm_client_id", $c->adm_client_id)
                ->get();
    //dd($serviceType);
            $tot = 0;
            $adm_type_invoices_id = 0;
            $reproc = true;
            foreach($serviceType as $st){
                $tot = round( $tot + ((round($st->price*$st->coef,2) ) * $st->qtde *  ( $st['id_service_type'] == 1 ? 0 : 1 ) ) ,2 );
                if($st['id_service_type'] == 2 and $reproc = true){
                    $reproc = false;
                }
                $adm_type_invoices_id = $st->adm_type_invoices_id;

            }

echo "Cliente: $client->id|$adm_type_invoices_id|";
            $numberInvoice = \App\Models\AdmTypeInvoice::select("id","last_number")
                ->where("id", $adm_type_invoices_id )
                ->first();
echo "NF $numberInvoice->last_number| R$ $tot = $st->price x <br>"; 
// continue;

            $number = str_pad(($numberInvoice->last_number+1), 5 , "0", STR_PAD_LEFT);

            if( $adm_type_invoices_id == 3 // Hospedagem
                or $adm_type_invoices_id == 4 // email  adic
            ){
                $number .= " / ".date('Y');
            }

//dd($numberInvoice);
            $dados = [
                "cliente"       => $client,
                "serviceType"   => $serviceType,
                "Cobrança"      =>[
                    "seuNumero"     => $number, //str_pad($numberInvoice->last_number+1, 5 , "0", STR_PAD_LEFT).date('Y'),
                    "nossoNumero"   => null,
                    "codigoBarras"  => null,
                    "linhaDigitavel"=> null,
                ],
                "reproc"        => $reproc,
                "total"         => $reproc == true ? $tot : 0 ,
            ];
            $n++;

            $emissao = $today ; 
            $vencto = date("Y-m-".round($serviceType[0]['day_pay'], strtotime("$today") )) ;
            //date('Y-m-d', strtotime("$today +21days")) ;

            \App\Models\AdmFinance::updateOrCreate([
                    'number'                => $number,
                    "adm_client_id"         => $client->id,
                    "adm_service_type_id"   => $adm_type_invoices_id,
                ],
                [
                    "adm_client_id"         => $client->id,
                    "adm_service_type_id"   => $adm_type_invoices_id,
                    'number'                => $number,
                    'date'                  => $emissao,
                    'value'                 => $tot,
                    'due'                   => $vencto,
                    'data'                  => json_encode($dados),
                ]
            );

            ## Add +1 next invoice
            \App\Models\AdmTypeInvoice::updateOrInsert(
                ['id'           => $numberInvoice->id ],
                ['last_number'  => $numberInvoice->last_number+1]
            );

        }


        // dd($billing, "lala");
    }


    public static function newBoleto(){ 

        $boletos = \App\Models\AdmFinance::select(
            "adm_finances.*",
            "adm_clients.*",
            "adm_finances.id as finances_id",
        )        
        ->where(
            ["adm_finances.processed"   => false ],
            ["adm_finances.type"        => 'Recebimento'],

        )
        ->where("adm_finances.value"        , ">" , 0)
        ->where("adm_finances.updated_at"   , ">=", date("Y-m-d 00:00:00") )
        ->where("adm_finances.updated_at"   , "<=", date("Y-m-d 23:59:59") )
        ->join("adm_clients","adm_finances.adm_client_id","=","adm_clients.id")
//->take(1)
        ->get();
//  dd($boletos, "x");
        $q = 0;
        $ret = [];
        foreach($boletos as $b){

            $ret[$q] = $b->toArray();  
            //gera boleto
            $ret[$q]["message"] = AdmFinance::Connect077("BoletoCreate", $b);
            
            // salva pdf do boleto
            // $ret[$q]["PDFCreate"] = AdmFinance::Connect077("GetPdf", $ret[$q]["message"]["nossoNumero"]);
            // $ret[$q]["PDFCreate"] = AdmFinance::Connect077("GetPdf", "00729582579" );
            $q++;

        }
        dd("Gerados boletos...", $ret );


        // AdmCobrancaBoleto / Gravar o log

    }

    public static function QuitaBoleto(){ 
        echo "Processando baixa boletos <br>";
        $francesa = \App\Models\AdmCobrancaBoleto::Where([
                ["processed"    ,false],
                ["status"       ,true]
            ])
            ->get();

        $seq  = 1;

        foreach($francesa as $f){                
            $data = json_decode($f->data);
            $ret = [];
            
            foreach($data->content as $dc){
                echo "$seq - $dc->nomeSacado, $dc->dataPagtoBaixa <br>";
                $dtFormat = $data = str_replace("/", "-", $dc->dataPagtoBaixa);
                $sql = \App\Models\AdmFinance::updateOrCreate(
                    [
                        //"linhaDigitavel"    => $dc->linhaDigitavel,
                        //"seuNumero"         => $dc->seuNumero,
                        "nossoNumero"       => $dc->nossoNumero,
                    ],[
                        "paydue"            => date('Y-m-d', strtotime($dtFormat)),
                        "seuNumero"         => $dc->seuNumero,
                        "nossoNumero"       => $dc->nossoNumero,
                        "pay"               => $dc->valorTotalRecebimento,
                        "pay_discount"      => $dc->valorAbatimento,
                        "pay_plus"          => $dc->valorJuros+$dc->valorMulta,
                        "tp_baixa"          => "boleto",
                        "admbank_id"        => 2,
                    ]);
                
                $ret[$seq] = [
                    "Seq"               => $seq,
                    "nomeSacado"        => $dc->nomeSacado, 
                    "dataPagtoBaixa"    => $dc->dataPagtoBaixa,
                    "seuNumero"         => $dc->seuNumero,
                    "nossoNumero"       => $dc->nossoNumero,
                    "idBaixado"         => $sql->id,
                    "status"            => $sql ? "Baixado" : "Não localizado",
                ];
                $seq ++;
            }
            $sql = \App\Models\AdmCobrancaBoleto::updateOrCreate( 
                ["id"           => $f->id],
                ["processed"    => true]
            );
            //dd($sql, $f->id);
            return $ret;
        }


    }

    public static function Connect077($type= null, $d)
    {

// dd($d);
        $url = false;
        $nossonumero = 123;

        $filtro = null;
        $filtrarDataPor= null;
        $dataInicial = null;
        $dataFinal = null;
        $ordenarPor = null;
        $page = null;
        $size = null;
        $action = null;
        $tp_baixa = null;
        $method = null;
        $param = null;
        $processed = false;
         
        $keyPassword = "";
        $accountNumber = "14587904";

// dd($type);
        if($type == 'BoletoCreate'){
            $url = 'https://apis.bancointer.com.br/openbanking/v1/certificado/boletos/';

            $param= [
                "pagador" => [
                    "cnpjCpf"       => $d->cpf_cnpj,  //str_pad("26451227870", 14 , "0", STR_PAD_LEFT),
                    "nome"          => $d->name, 
                    "email"         => $d->email, 
                    "telefone"      => substr($d->telefone, 2) ,
                    "cep"           => $d->cep,
                    "numero"        => $d->numero,
                    "complemento"   => $d->complemento,
                    "bairro"        => $d->bairro,
                    "cidade"        => $d->cidade,
                    "uf"            => $d->estado,
                    "endereco"      => $d->endereco,
                    "ddd"           => substr($d->telefone, 0,2) ,
                    "tipoPessoa"    => (strlen($d->cpf_cnpj) == 11) ? "FISICA":"JURIDICA",
                ],
                "dataEmissao"       => DATE("Y-m-d"),
                "seuNumero"         => $d->number,
                "dataVencimento"    => $d->due,
                "mensagem"=>[ 
                    "linha1"    => "",
                    "linha2"    =>"",
                    "linha3"    =>"Faturamento de ".date("m/Y"),
                    "linha4"    =>"Gipsi - Gestão para seu negócio, tudo de forma simples, ",
                    "linha5"    =>"rápida e sem complicações !"
                ],
                "desconto1"=>[
                    "codigoDesconto"=>"NAOTEMDESCONTO",
                    "taxa"          =>0,
                    "valor"         =>0,
                    "data"          =>""
                ],
                "desconto2"=>[
                    "codigoDesconto"=>"NAOTEMDESCONTO",
                    "taxa"          =>0,
                    "valor"         =>0,
                    "data"          =>""
                ],
                "desconto3"=>[ 
                    "codigoDesconto"=>"NAOTEMDESCONTO",
                    "taxa"          =>0,
                    "valor"         =>0,
                    "data"          =>""
                ],
                "valorNominal"      =>$d->value,
                "valorAbatimento"   =>0,
                "multa"=>[ 
                    "codigoMulta"   =>"PERCENTUAL",
                    "valor"         =>0,
                    "taxa"          =>2,
                    "data"          => date('Y-m-d', strtotime("$d->due +1 days")),
                ],
                "mora"=>[
                    "codigoMora"    =>"TAXAMENSAL",
                    "valor"         =>0,
                    "taxa"          =>1,
                    "data"          => date('Y-m-d', strtotime("$d->due +1 days")),
                ],
                "cnpjCPFBeneficiario"=>"30379635000102",
                "numDiasAgenda"     =>"SESSENTA"                
            ];
            $tp_baixa = 'gerar boleto';
            $processed = true;
            $method = "POST";

            $ch = curl_init();

            $data_string = json_encode($param);
            $certificateFile = "/Certificado/BancoInter/Inter_API_Certificado.crt";
            $keyFile = "/Certificado/BancoInter/Inter_API_Chave.key";
            $retry = 5;
            while ($retry>0) {
                                                                                                                                    
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url );
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                    'Content-Type: application/json',                                                                                
                    'Content-Length: ' . strlen($data_string),
                    'x-inter-conta-corrente: '.$accountNumber),
                );  
                curl_setopt($ch, CURLOPT_SSLCERT, getcwd().$certificateFile);
                curl_setopt($ch, CURLOPT_SSLKEY, getcwd().$keyFile );
                if ($keyPassword) {
                    curl_setopt($ch, CURLOPT_KEYPASSWD, $keyPassword);
                }
                $response = curl_exec($ch);
// print_r($response, $data_string);
                 //$response = '{"seuNumero":"000032021","nossoNumero":"00729582579","codigoBarras":"07794885000000010000001112037186200729582579","linhaDigitavel":"07790001161203718620707295825793488500000001000"}';
                /*
                Erros listados ateh 2021-10-01
                $response = '{"message":["pagador.cep: tamanho deve estar entre 8 e 8"]}';
                $response = "Jwt verification fails";
                */

                if ($response == "Jwt verification fails") {                    
                    echo "Erro na API do Banco Jwt verification fails - $retry <br>";
                    sleep(1);
                    $retry--;
                } else {
                    $retry=0;
                }

            }

            if( $response == 'Jwt verification fails' 
                //or !isset($response->seuNumero) 
            ){
                echo "Erro na API do Banco - 5 Tentativas <br>";
                echo print_r($response);
                return [
                    "message"   => "Erro ao acessar a API - Fora do ar !", 
                    "status"    => "error",
                ];
            }
            
            $ret = json_decode($response);
            if(isset($ret->message)){
                return [
                    "message"   => $ret, 
                    "status"    => "error",
                ];
                    
            }

            echo "Atualizado boleto: $d->id  <br>";
            echo print_r($ret, $response);
            $update = \App\Models\AdmFinance::updateOrCreate([
                'id'                => $d->finances_id,
            ],[
                'seuNumero'         => $ret->seuNumero??0,
                'nossoNumero'       => $ret->nossoNumero??0,
                'codigoBarras'      => $ret->codigoBarras??0,
                'linhaDigitavel'    => $ret->linhaDigitavel??0,
                'processed'         => true,
            ]);
            if(!$update){
                dd($update);
                echo "pau boleto: $d->id <br>";
            }

            return [
                "message"       => "PDF gerado com sucesso",
                "status"        => "success",
                "nossoNumero"   => $update->nossoNumero,
            ];

        }elseif($type == 'ExtractBoleto' ){
            $url = "https://apis.bancointer.com.br/openbanking/v1/certificado/boletos";

            $certificateFile = "/Certificado/BancoInter/Inter_API_Certificado.crt";
            $keyFile = "/Certificado/BancoInter/Inter_API_Chave.key";
            $filtro = "PAGOS";
            $filtrarDataPor= "SITUACAO";
            $dataInicial = date('Y-m-d', strtotime("-1 days"));
            $dataFinal = date('Y-m-d', strtotime("-1 days"));
            $ordenarPor = "NOSSONUMERO";
            $page = 0;
            $size = 20;
            $tp_baixa = 'quitação boleto';
            $method = 'GET';
            
            $url .= "?filtrarPor=".$filtro;
            $url .= "&filtrarDataPor=".$filtrarDataPor;
            $url .= "&dataInicial=".$dataInicial;
            $url .= "&dataFinal=".$dataFinal;
            $url .= "&ordenarPor=".$ordenarPor;
            $url .= "&page=".$page;
            $url .= "&size=".$size;

            $retry = 5;
            while ($retry>0) {

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url );
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                                  
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                    // 'Content-Type: application/json',                                                                                
                    // 'Content-Length: ' . strlen($data_string),
                    'x-inter-conta-corrente: '.$accountNumber),
                );  

                curl_setopt($ch, CURLOPT_SSLCERT, getcwd().$certificateFile);
                curl_setopt($ch, CURLOPT_SSLKEY, getcwd().$keyFile );
                if ($keyPassword) {
                    curl_setopt($ch, CURLOPT_KEYPASSWD, $keyPassword);
                }
                $response = curl_exec($ch);

                if ($response == "Jwt verification fails") {                    
                    sleep(1);
                    $retry--;
                } else {
                    $retry=0;
                }

            }

            $dt = date('Y-m-d H:i:s');
            $JsonResponse = json_decode($response);
            
            if ( !isset($JsonResponse) ){
                echo "Sistema do banco Inter indisponível"; 
                // print_r($response, $param, $url, $JsonResponse);
                return false;
            }
            if( $JsonResponse->numberOfElements == 0 ) {
                $processed = true;
            }
            $data = \App\Models\AdmCobrancaBoleto::updateOrCreate([
                    'date' => $dt ,
                ],[
                    'date'          => $dt,
                    'bank'          => '077',
                    'type'          => $tp_baixa,
                    'data'          => $response,
                    'processed'     => $processed,
                    'admbank_id'    => 2, // banco inter
                ]);

            # Executa Acao apos recebe informacoes da API 
#dd($type, $JsonResponse->numberOfElements, $JsonResponse );
            if( ($type == 'ExtractBoleto') and ($JsonResponse->numberOfElements > 0 ) 
                ){
                echo "Baixando movimento de $dataInicial \n";
                $ret = \App\Models\AdmFinance::QuitaBoleto();
                return $ret;

            }else{
echo "qtde: $JsonResponse->numberOfElements";
                echo "Sem movimento em $dataInicial \n";
                return false;

            }

        }elseif($type == 'GetPdf' ){
            $url = 'https://apis.bancointer.com.br/openbanking/v1/certificado/boletos/'.$d.'/pdf';
            // GET
            // $param= [
            //     "nossoNumero" => $d,
            // ];
            $certificateFile = "/Certificado/BancoInter/Inter_API_Certificado.crt";
            $keyFile = "/Certificado/BancoInter/Inter_API_Chave.key";

            $retry = 5;
            while ($retry>0) {

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url );
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                                  
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                    'Content-Type: application/json',
                    'Content-Type: application/base64',                    
                    // 'Content-Length: ' . strlen($data_string),
                    'x-inter-conta-corrente: '.$accountNumber),
                );  

                curl_setopt($ch, CURLOPT_SSLCERT, getcwd().$certificateFile);
                curl_setopt($ch, CURLOPT_SSLKEY, getcwd().$keyFile );
                if ($keyPassword) {
                    curl_setopt($ch, CURLOPT_KEYPASSWD, $keyPassword);
                }
                $response = curl_exec($ch);

                if ($response == "Jwt verification fails") {                    
                    sleep(1);
                    $retry--;
                } else {
                    $retry=0;
                }

            }

            $dt = date('Y-m-d H:i:s');
            $JsonResponse = json_decode($response);
// dd($JsonResponse, $response);

            echo "Atualizado PDF do boleto: $d <br>";
            $update = \App\Models\AdmFinance::updateOrCreate([
                'nossoNumero'   => $d,
            ],[
                'pdf'           => $response,
            ]);

            if(!$update){
                dd($update);
                echo "pau boleto: $d->id <br>";
                return false;
            }

            return [
                "message"       => "PDF gerado com sucesso",
                "status"        => "success",
                "nossoNumero"   => $update->nossoNumero,
            ];

            
        }elseif($type == 'Baixa' ){
            $url = 'https://apis.bancointer.com.br/openbanking/v1/certificado/boletos/'.$nossonumero.'/baixas';            
            // POST
            $param= [
                "codigoBaixa" => '0000'
            ];
            /*
            OPTs
                Domínio que descreve o tipo de baixa sendo solicitado.
                ACERTOS - Baixa por acertos
                PROTESTADO - Baixado por ter sido protestado
                DEVOLUCAO - Baixado para devolução
                PROTESTOAPOSBAIXA - Baixado por protesto após baixa
                PAGODIRETOAOCLIENTE - Baixado, pago direto ao cliente
                SUBISTITUICAO - Baixado por substituição
                FALTADESOLUCAO - Baixado por falta de solução
                APEDIDODOCLIENTE - Baixado a pedido do cliente
            */
        }elseif($type == 'BoletoConsulta' ){
            $url = 'https://apis.bancointer.com.br/openbanking/v1/certificado/boletos/nossoNumero';
            // GET
            $param= [
                "nossoNumero" => '0000'
            ];
            /*
            OPTs
                Domínio que descreve o tipo de baixa sendo solicitado.
                ACERTOS - Baixa por acertos
                PROTESTADO - Baixado por ter sido protestado
                DEVOLUCAO - Baixado para devolução
                PROTESTOAPOSBAIXA - Baixado por protesto após baixa
                PAGODIRETOAOCLIENTE - Baixado, pago direto ao cliente
                SUBISTITUICAO - Baixado por substituição
                FALTADESOLUCAO - Baixado por falta de solução
                APEDIDODOCLIENTE - Baixado a pedido do cliente
            */
        }else{
            echo "erro ao configurar chave...";
            abort(404);
        }


    }

    public static function getCashflow($finance){


        $dados = \App\Models\AdmFinance::select([
                \DB::raw("due as date"),
                \DB::raw("DATE_FORMAT(due, '%d-%m-%Y') as month"),
                \DB::raw("sum(case 
                    when type = 'Recebimento' then value
                    else 0
                END) as receitas"), 
                \DB::raw("sum(case 
                    when type = 'Pagamento' then value
                    else 0
                END) as despesas"), 
            ])
            ->whereBetween('due', [ $finance->dt_ini, $finance->dt_fim ])
            ->whereNull("pay")
            ->where([
                ['status', '=', true]
            ])
            ->groupBy('due')
            ->get();

        $i = 0;
        $sd = $finance->sd_ini;
        $sd_fmt = number_format($finance->sd_ini, 2, ',', '.');
        $saldo = [
            "seq"       => 0,
            "date"      => $finance->dt_ini, 
            "month"     => $finance->dt_ini, 
            "receitas"  => 0, 
            "despesas"  => 0, 
            "saldo"     => ($finance->sd_ini > 0 ? $finance->sd_ini : "0,00"), 
        ];

        $totais = [
            "seq"       => "Total",
            "date"      => $finance->dt_fim,
            "month"     => $finance->dt_fim,
            "receitas"  => number_format($dados->pluck("receitas")->sum(), 2, ',', '.'),
            "despesas"  => number_format($dados->pluck("despesas")->sum(), 2, ',', '.'),
            "saldo"     => ""
        ];

        ## Ajustes para retorno das informacoes
        foreach( $dados as $d){            
            $sd = $sd + $d->receitas - $d-> despesas ;
            $dados[$i]["seq"]   = $i+1;
            $dados[$i]["despesas"] = number_format($d->despesas, 2, ',', '.');
            $dados[$i]["receitas"] = number_format($d->receitas, 2, ',', '.');
            $dados[$i]["saldo"] = number_format($sd, 2, ',', '.');
            $i ++;
        }
        $dados->prepend($saldo);
        $dados->push($totais);

        return $dados;

    }
    
    public static function getCashflowDetail($finance){


        $dados = \App\Models\AdmFinance::select([
                "adm_finances.id",
                \DB::raw("due as date"),
                \DB::raw("DATE_FORMAT(due, '%d-%m-%Y') as month"),
                \DB::raw("
                FORMAT(
                    case 
                        when type = 'Recebimento' then value
                        else ''
                    END
                , 2,'de_DE')
                 as receitas"), 
                \DB::raw("
                FORMAT(
                    case 
                        when type = 'Pagamento' then value
                        else ''
                    END 
                , 2,'de_DE')
                as despesas"), 
                \DB::raw("concat(IFNULL(adm_clients.name, ''), IFNULL(adm_suppliers.name, '') ) as favorecido")
                ])
            ->leftjoin('adm_suppliers'  , 'adm_finances.admsupplier_id' , '=', 'adm_suppliers.id')
            ->leftjoin('adm_clients'    , 'adm_finances.adm_client_id'  , '=', 'adm_clients.id')
            ->whereDate("due", $finance->due )
            ->whereNull("pay")
            ->where([
                ['adm_finances.status', '=', true]
            ])
            ->orderBy("receitas")
            ->get();

        return $dados;

    } 

    public static function getConciliacion($finance){


        $dados = \App\Models\AdmFinance::select([
                "adm_finances.id",
                \DB::raw("due as date"),
                \DB::raw("DATE_FORMAT(due, '%d-%m-%Y') as month"),
                \DB::raw("
                    case 
                        when type = 'Recebimento' then value
                        else ''
                    END as receitas"), 
                \DB::raw("
                    case 
                        when type = 'Pagamento' then value
                        else ''
                    END as despesas"), 
                \DB::raw("concat(IFNULL(adm_clients.name, ''), IFNULL(adm_suppliers.name, '') ) as favorecido")
                ])
            ->leftjoin('adm_suppliers'  , 'adm_finances.admsupplier_id' , '=', 'adm_suppliers.id')
            ->leftjoin('adm_clients'    , 'adm_finances.adm_client_id'  , '=', 'adm_clients.id')
            ->whereBetween('due', [ $finance->dt_ini, $finance->dt_fim ])
            ->whereNull("pay")
            ->where([
                ['adm_finances.status', '=', true]
            ])
            ->orderBy("receitas")
            ->get();

        return $dados;

    }

    public static function getBalance($finance){


        $dados = \App\Models\AdmFinance::select([
                "adm_finances.id", 
                "number as historico",
                \DB::raw("paydue as date"),
                \DB::raw("DATE_FORMAT(paydue, '%d-%m-%Y') as month"),
                \DB::raw("case 
                    when type = 'Recebimento' then pay
                    else 0
                END as receitas"), 
                \DB::raw("case 
                    when type = 'Pagamento' then pay
                    else 0
                END as despesas"), 
                \DB::raw("concat(IFNULL(adm_clients.name, ''), IFNULL(adm_suppliers.name, '') ) as favorecido")
            ])
            ->leftjoin('adm_suppliers'  , 'adm_finances.admsupplier_id' , '=', 'adm_suppliers.id')
            ->leftjoin('adm_clients'    , 'adm_finances.adm_client_id'  , '=', 'adm_clients.id')
            ->whereBetween('paydue', [ $finance->dt_ini, $finance->dt_fim ])
            ->whereNotNull("pay")
            ->where([
                ['adm_finances.status', '=', true],
                ["adm_finances.admbank_id", "=", $finance->bank]
            ])
            ->orderBy("paydue")
            ->orderby("receitas", "DESC" )
            ->orderby("despesas")
            ->orderby("pay")
            ->get();

        $i = 0;
        $sd_ini = \App\Models\AdmFinance::selectRaw(
                "admbank_id, adm_banks.name, sum(pay*
                CASE 
                    WHEN type = 'Pagamento' THEN -1 else 1 
                END
                ) as saldo"
            )
            ->join("adm_banks", "adm_finances.admbank_id" ,"adm_banks.id")
            ->whereNotNull("pay")
            ->whereNotNull("paydue")
            ->whereBetween('paydue', [ "1900-01-01", date('Y-m-d',strtotime("$finance->dt_ini - 1 day " )) ])            
            ->where([
                ["adm_banks.status", "=", true],
                ["adm_banks.id", "=", $finance->bank]
            ])
            ->groupBy("admbank_id")
            ->groupBy("adm_banks.name")
            ->first();
            
        $sd = $sd_ini->saldo ?? 0 ;
//dd($sd);
        $sd_fmt = number_format($sd, 2, ',', '.');

        $saldo = [
            "seq"       => 0,
            "favorecido"=> "Saldo Anterior",
            "historico" => "",
            "date"      => $finance->dt_ini, 
            "month"     => $finance->dt_ini, 
            "receitas"  => 0, 
            "despesas"  => 0, 
            "saldo"     => ($sd > 0 ? number_format($sd, 2, ',', '.') : "0,00"), 
        ];

        $totais = [
            "seq"       => "Total",
            "favorecido"=> "",
            "historico" => "",
            "date"      => $finance->dt_fim,
            "month"     => $finance->dt_fim,
            "receitas"  => number_format($dados->pluck("receitas")->sum(), 2, ',', '.'),
            "despesas"  => number_format($dados->pluck("despesas")->sum(), 2, ',', '.'),
            "saldo"     => ""
        ];

        ## Ajustes para retorno das informacoes        
        foreach( $dados as $d){            
            $sd = $sd + $d->receitas - $d-> despesas ;
            $dados[$i]["seq"]   = $d->id;
            $dados[$i]["despesas"] = number_format($d->despesas, 2, ',', '.');
            $dados[$i]["receitas"] = number_format($d->receitas, 2, ',', '.');
            $dados[$i]["saldo"] = number_format($sd, 2, ',', '.');
            $i ++;
        }
    

        $dados->prepend($saldo);
        $dados->push($totais);

        return $dados;

    }

}
