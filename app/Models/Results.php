<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\LicencesHistory;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\SoftDeletes;

class Results extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'posicao',
        'numero_kart',
        'nome',
        'categoria',
        'comentarios',
        'qtde_voltas',
        'total_tempo',
        'melhor_tempo',
        'diff',
        'event_id',
        'espaco',
        'titulo_evento',
        'driver_id',
    ];   


    public static function getResultEventReproc($id){
        
        $dados = \App\Models\EventLinks::selectRaw("id, Folhas, Titulo, event_id")
            ->where([
                [ "event_id", $id ]
            ])
            ->get();

        foreach( $dados as $c ){ 
            // Results::getResult([
            //     "link"          => "http://kartodromogranjaviana.com.br/resultados/folha/?uid=".$c["Folhas"]."&parte=prova",
            //     "event_id"      => $c["event_id"],
            //     "titulo_evento" => $c["Titulo"],
            // ]);

            Results::updateDriverEvent($c);

        }

    }

    public static function getResultEvent($post)
    {
        // $post = [
        //     "event_id"  => 1,
        //     "data"      => "09/04",
        //     "horario"   => "17:30",
        //     "duracao"   => 30,
        //     "qtde_categorias"   => 4,
        // ];
        // Ajuste dos horarios
        $duracao = 30;
        $horarios = [];

        $qtdeBaterias = \App\Models\Categories::select("id","name")
            ->where("status", true )
            ->get()->count();

        $event = \App\Models\Events::selectRaw("id, DATE_FORMAT(data, '%d-%m') as data, horario")
            ->where("status", true )
            ->first();

        for($i=0; $i< $qtdeBaterias ; $i++){
            $t = $duracao*$i ;
            $horarios[] = date('H:i', strtotime($event->horario."+ $t minutes"));
        }

        // // Processa a realizacao do evento
        $html_evento = file_get_contents("http://kartodromogranjaviana.com.br/resultados/");        
        $eventos = Results::parseTableEvento($html_evento);
        $dia = $eventos->where("Dia",$event->data );
        $corrida = $dia->whereIn("Horario", $horarios);

// dd($event, $dia, $corrida, $eventos);
// dd($corrida->toArray() );
        $corrida = [

            ["Folhas" => "ca1bb29755eb5399a6ecc393f6e56507", "event_id" => 1, "categoria_id" => 4 , "Titulo" => "FÓRMULA I - LIGHT / PROVA 9 - 17:30" ], // LIGHT
            ["Folhas" => "9a2b277ed7da5f92d8d82220ad29526b", "event_id" => 1, "categoria_id" => 3 , "Titulo" => "FÓRMULA I - ELITE / PROVA 9 - 17:30" ], // ELITE
            ["Folhas" => "0a6ed8a71195d6aaa0e1ad00fa11d7f3", "event_id" => 1, "categoria_id" => 1 , "Titulo" => "FÓRMULA I - stars / PROVA 9 - 17:30"], // stars
            ["Folhas" => "5c2f6a77e9174685c76a0f2f2e055c7d", "event_id" => 1, "categoria_id" => 2 , "Titulo" => "FÓRMULA I - PRÓ / PROVA 9 - 17:30" ], // PRO

            ["Folhas" => "652b92ef08d74f9cfee2dc80fe0cfc09", "event_id" => 2, "categoria_id" => 4 , "Titulo" => "FÓRMULA I - LIGHT / PROVA 5 - 17:30"  ], // LIGHT
            ["Folhas" => "4f40a9b808144cb35aed5b8ce55521f1", "event_id" => 2, "categoria_id" => 3 , "Titulo" => "FÓRMULA I - ELITE / PROVA 5 - 17:30"  ], // ELITE
            ["Folhas" => "da1368fa00a1a5a36804138452c00d05", "event_id" => 2, "categoria_id" => 1 , "Titulo" => "FÓRMULA I - stars / PROVA 5 - 17:30" ], // stars
            ["Folhas" => "16c312bf3812ea7f11a2b27bfeee4fed", "event_id" => 2, "categoria_id" => 2 , "Titulo" => "FÓRMULA I - PRO / PROVA 5 - 17:30" ], // PRO

        ];

        foreach( $corrida as $c){
// dd("entrou...", $corrida->toArray() , $c , $post );
            Results::getResult([
                "link"          => "http://kartodromogranjaviana.com.br/resultados/folha/?uid=".$c["Folhas"]."&parte=prova",
                "event_id"      => $c["event_id"],
                "titulo_evento" => $c["Titulo"],
            ]);

            Results::updateDriverEvent($c);
            Results::updateDriverLicense($c);
            Results::updateEventLink($c);

            \App\Models\Events::updateOrCreate(
                ["id" => $c["event_id"]],
                ["finished" => 1 ]
            );

        }

        Log::INFO("Terminou o processamento.");

    }

    public static function getResult($dados){
        
        Log::INFO("Consultando evento [".$dados["link"]."] do dia [".$dados["link"]." Evento [".$dados["titulo_evento"]." ] .");

        $html_resultado_etapa = file_get_contents($dados["link"]);
        $resultado = Results::parseTableResult($html_resultado_etapa, $dados);

        foreach ($resultado->toArray()  as $r ) {
 
            Results::updateOrCreate(
                [
                    "event_id"      => $r["event_id"],
                    "posicao"       => $r["posicao"],
                    "categoria"     => $r["categoria"],
                    "titulo_evento" => $r["titulo_evento"],
                ],
                $r
            );

        }

        return ;
    }

    public static function parseTableResult($html, $dados){
      // Find the table      
      preg_match("/<table.*?>.*?<\/[\s]*table>/s", $html, $table_html);
    
      // Get title for each row
      preg_match_all("/<th.*?>(.*?)<\/[\s]*th>/", $table_html[0], $matches);
      $row_headers = $matches[1];
      $row_headers[] = "tomada";
      $row_headers[] = "voltaavolta";

      // ajuste nomes colunas
      $row_headers[array_search('pos', $row_headers)] = "posicao"; 
      $row_headers[array_search('No.', $row_headers)] = "numero_kart"; 
      $row_headers[array_search('Nome', $row_headers)] = "nome"; 
      $row_headers[array_search('Classe', $row_headers)] = "categoria"; 
      $row_headers[array_search('Comentários', $row_headers)] = "comentarios"; 
      $row_headers[array_search('Voltas', $row_headers)] = "qtde_voltas"; 
      $row_headers[array_search('Total Tempo', $row_headers)] = "total_tempo"; 
      $row_headers[array_search('Melhor Tempo', $row_headers)] = "melhor_tempo"; 
      $row_headers[array_search('Diff', $row_headers)] = "diff"; 
      $row_headers[array_search('Espaço', $row_headers)] = "espaco"; 

      // Iterate each row
      preg_match_all("/<tr.*?>(.*?)<\/[\s]*tr>/s", $table_html[0], $matches);
   
      $table = array();
    
      foreach($matches[1] as $row_html)
      {
    
        preg_match_all("/<td.*?>(.*?)<\/[\s]*td>/", $row_html, $td_matches);

        $row = array();
        for($i=0; $i<count($td_matches[1]); $i++)        
        {
          $td = strip_tags(html_entity_decode($td_matches[1][$i]));
          $row[$row_headers[$i]] = $td;
          $row['event_id'] = $dados["event_id"];
        }

        // ajuste pug tag aberta no site
        if(count($row) === 10 || count($row) === 11){
            // Sem adv
            $new = [
                "posicao"       => $row["posicao"],
                "event_id"      => $row["event_id"],
                "numero_kart"   => $row["numero_kart"],
                "nome"          => $row["nome"],
                "categoria"     => $row["categoria"],
                "comentarios"   => is_numeric($row["comentarios"]) ? "" : $row["comentarios"],
                "qtde_voltas"   => $row["comentarios"],
                "total_tempo"   => $row["qtde_voltas"],
                "melhor_tempo"  => $row["total_tempo"],
                "diff"          => $row["melhor_tempo"]??"",
                "espaco"        => $row["diff"]??"",
                "titulo_evento" => $dados["titulo_evento"],
            ];

            $row = $new;
        }

        if(count($row) === 8 || count($row) === 9 ){
            // Sem adv e 1 colocado            
            $new = [
                "posicao"       => $row["posicao"],
                "event_id"      => $row["event_id"],
                "numero_kart"   => $row["numero_kart"],
                "nome"          => $row["nome"],
                "categoria"     => $row["categoria"],
                "comentarios"   => "", 
                "qtde_voltas"   => $row["comentarios"],
                "total_tempo"   => $row["qtde_voltas"],
                "melhor_tempo"  => $row["total_tempo"],
                "diff"          => 0,
                "espaco"        => 0,
                "Pontos"        => $row["Ponto"]??0,
                "titulo_evento" => $dados["titulo_evento"],
            ];
            $row = $new;
        }

        if( str_contains( $row["comentarios"]??"", 'ADV') ){
            // Com adv 
            $new = [
                "posicao"       => $row["posicao"],
                "event_id"      => $row["event_id"],
                "numero_kart"   => $row["numero_kart"],
                "nome"          => $row["nome"],
                "categoria"     => $row["categoria"],
                "comentarios"   => $row["comentarios"],
                "qtde_voltas"   => $row["total_tempo"],
                "total_tempo"   => $row["melhor_tempo"],
                "melhor_tempo"  => $row["diff"],
                "diff"          => $row["espaco"],
                "espaco"        => "verificar",
                "Pontos"        => $row["Ponto"]??0,
                "titulo_evento" => $dados["titulo_evento"],
            ];
            
            $row = $new;
        }

        

        if(count($row) > 0) 
            $table[] = $row;
        
        }

      return collect($table);
    }

    
    public static function parseTableEvento($html){

        // Find the table
        preg_match("/<table.*?>.*?<\/[\s]*table>/s", $html, $table_html);

        // Get title for each row
        preg_match_all("/<th.*?>(.*?)<\/[\s]*th>/", $table_html[0], $matches);
        $row_headers = $matches[1];
        $row_headers[] = "tomada";
        $row_headers[] = "voltaavolta";

        // Iterate each row
        preg_match_all("/<tr.*?>(.*?)<\/[\s]*tr>/s", $table_html[0], $matches);

        $table = array();

        foreach($matches[1] as $row_html)
        {
            preg_match_all("/<td.*?>(.*?)<\/[\s]*td>/", $row_html, $td_matches);

               preg_match_all('~<a(.*?)\<i class="([^"]+)"(.*?)>~', $row_html, $td_matchesA);

            $row = array();
            for($i=0; $i<count($td_matches[1]); $i++) {
                $td = strip_tags(html_entity_decode($td_matches[1][$i]));
                // Actionsss
                $row[$row_headers[$i]] = $td;
            }

            for($i=2; $i<(count($td_matchesA[1])+2); $i++) {
                $a = strip_tags(html_entity_decode($td_matchesA[1][($i-2)]));
                // Actionsss
                $mystring = $a;
                $findme   = 'uid=';
                $pos = strpos($mystring, $findme);
                $found = substr($a, ($pos+4), 32);

                $row[$row_headers[$i+2]] = $found;
            }

            if(count($row) > 0)
            $table[] = $row;
        }        

        return collect($table);
    }

    public static function updateDriverEvent($dados){
        
        // identificacao do piloto
        $drivers = \App\Models\Drivers::select("id","nickname_math", "name")
            ->get();


        $result =  Results::selectRaw("
                results.id, results.nome as piloto, results.nome as nome_kartodromo,
                drivers.id as driver_id
            ")
            ->join("drivers","results.nome","=","drivers.apelido")
            ->where([
                ["event_id", $dados["event_id"] ],
                ["driver_id", null ],
                ["drivers.deleted_at", null ],
            ])
            ->get();

        foreach($result as $r){

            Results::find($r->id)->update([
                "driver_id"   => $r->driver_id
            ]);

        }

        // pilotos nao localizados

        $result =  Results::selectRaw("
                results.id, results.nome as piloto, results.nome as nome_kartodromo
            ")
            ->whereNUll("driver_id")
            ->get();

        if( $result ){

            foreach($result as $c ){

                $drivers = drivers::selectRaw("id, nickname_math")
                    ->where('nickname_math', 'LIKE', "%$c->piloto%")
                    ->first();

                if( $drivers ){
                    Results::find($c->id)->update([
                            "driver_id"   => $drivers->id
                        ]);
                }

            }

        }

    }

    public static function updateDriverLicense($dados){
        
        // identificacao do piloto
        $drivers = \App\Models\Drivers::select("id","nickname_math", "name")
            ->get();


        $result =  Results::select("id as result_id", 
                "driver_id", "event_id", "comentarios" ,
                \DB::Raw("
                    CASE 
                        WHEN REPLACE( `comentarios` , \" ADV\", \"\") THEN 2
                        ELSE 1
                    END AS qtde
                ")
            )
            ->where([
                ["event_id", $dados["event_id"] ],
                ["comentarios", "like", "%ADV%" ],
            ])
            ->orderBy("event_id","DESC")
            ->get();

        foreach($result as $r){

            LicenseHistories::updateOrCreate([
                "driver_id"   => $r->driver_id,
                "event_id"   => $r->event_id
            ],$r->toArray()
            );

        }
    }

    public static function geraCategoriaDrivers(){
        
        $championship = \App\Models\Championships::select()->get()->max("id");
        $categoria = \App\Models\Categories::select("id","name")
            ->get();
        $qtdeTeam = 2;
        $teams = [];
        $teamDrivers = [];

        foreach( $categoria as $c ){

            $drivers["driveCategories".strtoupper($c->name)] = \App\Models\Results::selectRaw("
                        drivers.name , drivers.id
                ")
                ->join("drivers","drivers.name","=","results.nome")
                ->where("results.categoria", $c->name )
                ->get(); 

            $n = $drivers["driveCategories".strtoupper($c->name)]->count(); 
            
            $qtde = round( $n/$qtdeTeam/$qtdeTeam ,2)*$qtdeTeam; // deixa numero par

            
            
            for($i=0; $i< $qtde ; $i++){
                $teams["$c->name"][] = 
                \App\Models\Teams::updateOrCreate([
                    "name"              => "Team - ".($i+1) ,
                    "championship_id"   => $championship ,
                    "categoria_id"      => $c->id ,
                ],[
                    "name"              => "Team - ".($i+1) ,
                    "championship_id"   => $championship ,
                    "categoria_id"      => $c->id ,
                ]);
            }

            $id_teams = -1;
            $i = 0;
            foreach($drivers["driveCategories".strtoupper($c->name)] as $dr){

                if( $i % $qtdeTeam == 0 ){
                    $id_teams ++;
                    $i = 0;
                }

                \App\Models\TeamDrivers::updateOrCreate(
                    [
                        "team_id"           => $teams["$c->name"][$id_teams]->id ,
                        "driver_id"         => $dr->id ,
                        "championships_id"  => $championship,
                    ],
                    [
                        "team_id"           => $teams["$c->name"][$id_teams]->id ,
                        "driver_id"         => $dr->id ,
                        "championships_id"  => $championship,
                    ]);
                $i ++;

            }
            
        }

    }

    public static function updateEventLink($dados){
        
        
        // unset($dados["categoria_id"]);
        
        \App\Models\EventLinks::updateOrCreate(
            $dados,
            $dados
        );

    }

    public static function openEvent($dados){

        $days = 2; // dias antes do evento
        
        $drivers = \App\Models\Drivers::select("id","name", "email")
            ->get();

        $event = \App\Models\Events::Where([
                ["id",$dados],
                ["fee_value", ">", 0 ]
            ])
            ->first();

        if( !isset($event->id)  ){
            return back()->with('error', 'Valor da inscrição inválido.');
        }

        $payment = [];
        $mail =[];

        $due = date('Y-m-d H:i:s ', strtotime("$event->data -$days days" ));
        $date = date('Y-m-d H:i:s');

        foreach($drivers as $d){
            $payment[] = [
                "data"      => $date, 
                "number"    => "Etapa $event->name",
                "driver_id" => $d->id,
                "event_id"  => $dados,
                "due"       => $due, 
                "value"     => $event->fee_value,
                "descricao" => "Inscrição de $d->name na etapa $event->name ",
                "created_at" => $date,
                "updated_at" => $date,
            ];

            $mail[] = [
                'template_id'   => 1,
                "driver_id"     => $d->id,
                "event_id"      => $dados,
                'mailto'        => $d->email,
                'subject'       => "Formula i - Inscrição Etapa - $event->name",
                'finished'      => false,
                "created_at"    => $date,
                "updated_at"    => $date,
            ];
            
        }

        // dd($payment);
        \App\Models\Finances::insert($payment);     // Pagto
        \App\Models\Sendmails::insert($mail);       // envio de email

        \App\Models\Events::updateOrCreate(
            ["id" => $dados],
            ["finished" => 0 ]
        );

    }

    public static function kartRaffle( $dados ){
// 
        if( isset($dados->event_id) and isset($dados->categoria_id) ) {

            $drivers = \App\Models\Finances::selectRaw("drivers.id, drivers.name")
                
                ->join("drivers","drivers.id","=","finances.driver_id")
                ->join("events","events.id","=","finances.event_id")
                ->join("team_drivers","drivers.id","=","team_drivers.driver_id")
                ->join("teams","team_drivers.team_id","=","teams.id")
                ->where([
                    ["value_pay"    , ">", 0 ] ,
                    ["event_id"     , $dados->event_id ] ,
                    ["categoria_id" , $dados->categoria_id ] 
                ])
                ->get();


                if( isset($dados->randon) ){
// dd( count($drivers->toArray()) );
                
                $drivers->shuffle();
                $drivers->shuffle();
                $drivers->shuffle();
                $ret = $drivers->shuffle();


                $a =0;
                foreach($ret as $r){
                    $a ++;
                    \App\Models\EventRaffles::updateOrCreate([
                        'posicao'       => $a,
                        // 'driver_id'     => $r->id,
                        'event_id'      => $dados->event_id,                        
                        'categoria_id'  => $dados->categoria_id,
                    ],[
                        'posicao'       => $a,
                        'driver_id'     => $r->id,
                        'event_id'      => $dados->event_id,                        
                        'categoria_id'  => $dados->categoria_id,
                    ]);
                }

                return  $ret;
            }

            return $drivers;
        }

        $events = \App\Models\Events::selectRaw("id, name")
            ->where([
                ["finished", false ] 
            ])
            ->get();

        $categoria = \App\Models\Categories::selectRaw("id, name")
            ->get(); 


// dd("drivers", $drivers);
        return [
            "events"    => $events,
            "categoria" => $categoria,
        ];

    }

    public static function GetReportsKartRaffles( $dados = null ){

        $eventos = \App\Models\Events::selectRaw("id, name")
            ->where([
                ["finished", "false"],
            ])
            ->get();

        $categoria = \App\Models\Categories::selectRaw("id, name")
            ->get();

        $drivers = [];

        if( isset($dados->event_id) and isset($dados->categoria_id) ){

            $drivers = \App\Models\Events::selectRaw("id, name")
                ->where([
                    ["status", "true"],
                ])
                ->get();

        }

        return [
            "events"    => $eventos,
            "categoria" => $categoria,
            "drivers"   => $drivers,
        ];
    }

}
