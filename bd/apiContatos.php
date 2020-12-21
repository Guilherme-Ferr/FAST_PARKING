<?php 

    function listarVagas($id)
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

            $sql = "select * from tblvagas";
        
            //Validação para filtrar pelo ID
            if($id > 0)
                $sql = $sql . " where idVaga=".$id;
   
                $sql = $sql . " order by tblvagas.idVaga asc";
                  

            $select = mysqli_query($conex, $sql);
        
            

            while($rsContatos = mysqli_fetch_assoc($select))
            {
                
                $dados [] = array (
                
                        "idVaga"            => $rsContatos['idVaga'],
                        "disponibilidade"   => $rsContatos['disponibilidade']
                
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

    function inserirVaga($dadosContato)
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
        $codigoVaga = (string) null;
        $disponibilidade = (integer) 0;
        
        //Converte o formato JSON para um Array de dados
        //$dadosContato = convertArray($dados);

        /*Recebe todos os dados da API*/
        $codigoVaga = $dadosContato['codigoVaga'];

        $sql = "insert into tblvagas 
                    (
                        disponibilidade
                    )
                    values
                    (
                        '". $disponibilidade ."'

                    )
                ";

        //Executa no BD o Script SQL

        if (mysqli_query($conex, $sql))
        {
            $dados = convertJSON($dadosContato);
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
    function deletarVaga($id)
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

        
      $sql = "delete from tblvagas 
              where tblvagas.idVaga = " . $id;

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






    function atualizarVagas($dadosVaga, $id)
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
        $disponibilidade = $dadosVaga['disponibilidade'];

        

        $sql = "update tblvagas set 
                disponibilidade = '".$disponibilidade."'

                where idVaga = ".$id;
        

        if (mysqli_query($conex, $sql))
        {
            $dados = convertJSON($dadosVaga);
            return $dados;
        }
        else
            return false;
    }

?>