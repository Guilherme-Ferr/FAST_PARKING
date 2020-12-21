<?php 

    function listarValores($id)
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

            $sql = "select * from tblvalores";
        
            //Validação para filtrar pelo ID
            if($id > 0)
                $sql = $sql . " where idValor=".$id;
   
                $sql = $sql . " order by tblvalores.valor asc";
                  

            $select = mysqli_query($conex, $sql);
        
            

            while($rsContatos = mysqli_fetch_assoc($select))
            {
                
                $dados [] = array (
                
                        "idValor"            => $rsContatos['idValor'],
                        "valor"        => $rsContatos['valor']
                
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

    function inserirValores($dadosValor)
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
        $valor = (double) null;
        
        //Converte o formato JSON para um Array de dados
        //$dadosContato = convertArray($dados);

        /*Recebe todos os dados da API*/
        $valor = $dadosValor['valor'];

        $sql = "insert into tblvalores 
                    (
                        valor
                    )
                    values
                    (
                        ". $valor ."
                    )
                ";

        //Executa no BD o Script SQL

        if (mysqli_query($conex, $sql))
        {
            $dados = convertJSON($dadosValor);
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
    function deletarValores($id)
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

        
      $sql = "delete from tblvalores 
              where tblvalores.idValor = " . $id;

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

    function atualizarValores($dadosValores, $id)
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
        $valor = $dadosValores['valor'];

        

        $sql = "update tblvalores set 
                valor = '".$valor."'

                where idValor = ".$id;
        

        if (mysqli_query($conex, $sql))
        {
            $dados = convertJSON($dadosValores);
            return $dados;
        }
        else
            return false;
    }

?>