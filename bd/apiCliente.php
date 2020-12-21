<?php 

    function listarCliente($id)
    {
        
        /*Abre a conexão com o BD*/

        //Import do arquivo de Variaveis e Constantes
        require_once('../modulo/config.php');

        //Import do arquivo de função para conectar no BD
        require_once('conexaoMysql.php');

        //chama a função que vai estabelecer a conexão com o BD
        if(!$conex = conexaoMysql())
        {
            echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
            //die; //Finaliza a interpretação da página
        }

            $sql = "select * from tblentradaSaidaCliente";
        
            //Validação para filtrar pelo ID
            if($id > 0)
                $sql = $sql . " where idEntradaSaidaCliente=".$id;
   
                $sql = $sql . " order by tblentradaSaidaCliente.idEntradaSaidaCliente desc";
                  

            $select = mysqli_query($conex, $sql);
        
            

            while($rsContatos = mysqli_fetch_assoc($select))
            {
                if ($rsContatos['diferenca'] == 0) {
                    $rsContatos['idValor'] = "R$15,00";
                }
                else
                    $rsContatos['idValor'] = "R$30,00";

                if ($rsContatos['idVaga'] == 1) {
                    $rsContatos['idVaga'] = "Sim";
                }
                else
                    $rsContatos['idVaga'] = "Não";
                
                $dados [] = array (
                
                        "idEntradaSaidaCliente" => $rsContatos['idEntradaSaidaCliente'],
                        "nomeCliente"           => $rsContatos['nomeCliente'],
                        "numeroPlacaVeiculo"    => $rsContatos['numeroPlacaVeiculo'],
                        "dataHorarioEntrada"    => $rsContatos['dataHorarioEntrada'],
                        "horarioSaida"          => $rsContatos['horarioSaida'],
                        "idVaga"                => $rsContatos['idVaga'],
                        "idValor"               => $rsContatos['idValor']
                
                    );
                

            }
        /*
            $headerDados = array (
                "status"    => "success",
                "data"      => "2020-11-25",
                "contatos"  => $dados
            
            ); 
            */
            
        if(isset($dados))
            $listVagasJSON = convertJSON($dados);
        else
            return false;
        
                
        
        //Verifica se foi gerado um arquivo JSON 
        if(isset($listVagasJSON))
            return $listVagasJSON;
        else
            return false;
     
    }

    function inserirCliente($dadosCliente)
    {
     
        //Import do arquivo de Variaveis e Constantes
        require_once('../modulo/config.php');

        //Import do arquivo de função para conectar no BD
        require_once('conexaoMysql.php');


        //chama a função que vai estabelecer a conexão com o BD
        if(!$conex = conexaoMysql())
        {
            echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
            //die; //Finaliza a interpretação da página
        }

        /*Variaveis*/
        $nomeCliente = (string) null;
        $numeroPlacaVeiculo = (string) null;
        $dataHorarioEntrada = (string) null;
        $idVaga = (integer) null;
        $idValor = (integer) 1;

        
        //Converte o formato JSON para um Array de dados
        //$dadosContato = convertArray($dados);

        /*Recebe todos os dados da API*/
        $nomeCliente = $dadosCliente['nomeCliente'];
        $numeroPlacaVeiculo = $dadosCliente['numeroPlacaVeiculo'];
        $dataHorarioEntrada = $dadosCliente['dataHorarioEntrada'];
        $idVaga = $dadosCliente['idVaga'];


        $sql = "insert into tblentradaSaidaCliente
                    (
                        nomeCliente, 
                        numeroPlacaVeiculo, 
                        dataHorarioEntrada, 
                        idVaga, 
                        idValor
                    ) 
                    values
                    (
                        '". $nomeCliente ."',
                        '". $numeroPlacaVeiculo ."',
                        current_timestamp(),
                        '". $idVaga ."',
                        '". $idValor ."'
                    )
                ";

        //Executa no BD o Script SQL

        if (mysqli_query($conex, $sql))
        {
            $dados = convertJSON($dadosCliente);
            return $dados;
        }
        else
            return false;
    }

    //Converte um Array em JSON
    function convertJSON($objeto)
    {
        //forçamos o cabeçalho do arquivo a ser aplicação do tipo JSON
        header("content-type:application/json");

        //Converte a array de dados em JSON
        $listJSON = json_encode($objeto);
        
        return $listJSON;
    }

    //Converte um JSON em Array
    function convertArray($objeto)
    {
        var_dump($objeto);
        die;
        //Converte JSON em ARRAY
        $listArray = json_decode($objeto, true);
        
        return $listArray;
    }

    //Converte um Array em JSON
    function deletarCliente($id)
    { 

        //Import do arquivo de Variaveis e Constantes
        require_once('../modulo/config.php');

        //Import do arquivo de função para conectar no BD
        require_once('conexaoMysql.php');


        //chama a função que vai estabelecer a conexão com o BD
        if(!$conex = conexaoMysql())
        {
            echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
            //die; //Finaliza a interpretação da página
        }

        
      $sql = "delete from tblentradaSaidaCliente 
              where tblentradaSaidaCliente.idEntradaSaidaCliente = " . $id;

        //echo($sql);
        //die;

        //Executa no BD o Script SQL

        if (mysqli_query($conex, $sql))
        {
            return true;
        }
        else
            return false;
    }

    function atualizarCliente($id)
    {
       /*Abre a conexão com o BD*/

        //Import do arquivo de Variaveis e Constantes
        require_once('../modulo/config.php');

        //Import do arquivo de função para conectar no BD
        require_once('conexaoMysql.php');


        //chama a função que vai estabelecer a conexão com o BD
        if(!$conex = conexaoMysql())
        {
            echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
            //die; //Finaliza a interpretação da página
        }
        

        /*Recebe todos os dados da API*/
        // $diferenca = $dadosSaida['diferenca'];
        // $vaga = $dadosSaida['idVaga'];
        // $valor = $dadosSaida['idValor'];

        

        $sql = "call procSaidaCliente('".$id."')";
        

        if (mysqli_query($conex, $sql))
        {
            return true;
        }
        else
            return false;
    }

?>