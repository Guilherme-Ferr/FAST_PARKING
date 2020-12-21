<?php

function listarRelatorioDiario()
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

            $sql = "call procRendimentoDiario()";   
            

            $select = mysqli_query($conex, $sql);

            $retornoDiario = mysqli_fetch_assoc($select);
            
            $dados [] = array (
                "RendimentoDiario" => $retornoDiario['RendimentoDiario']
            );
                
            
        if(isset($dados))
            $listRelatorioDiarioJSON = convertJSON($dados);
        else
            return false;
        
                
        
        //Verifica se foi gerado um arquivo JSON 
        if(isset($listRelatorioDiarioJSON))
            return $listRelatorioDiarioJSON;
        else
            return false;
     
    }

    function listarRelatorioMensal()
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

            $sql = "call procRendimentoMensal()";
            
                  

            $select = mysqli_query($conex, $sql);
        
            

            $retornoMensal = mysqli_fetch_assoc($select);

                
            $dados [] = array (
                "RendimentoMensal" => $retornoMensal['RendimentoMensal']
            );
                
            
        if(isset($dados))
            $listRelatorioMensalJSON = convertJSON($dados);
        else
            return false;
        
                
        
        //Verifica se foi gerado um arquivo JSON 
        if(isset($listRelatorioMensalJSON))
            return $listRelatorioMensalJSON;
        else
            return false;
     
    }

    function listarRelatorioAnual()
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

            $sql = "call procRendimentoAnual()";
            
                  

            $select = mysqli_query($conex, $sql);
        
            

            $retornoAnual = mysqli_fetch_assoc($select);

                
            $dados [] = array (
                "RendimentoAnual" => $retornoAnual['RendimentoAnual']
            );
                
            
        if(isset($dados))
            $listRelatorioAnualJSON = convertJSON($dados);
        else
            return false;
        
                
        
        //Verifica se foi gerado um arquivo JSON 
        if(isset($listRelatorioAnualJSON))
            return $listRelatorioAnualJSON;
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