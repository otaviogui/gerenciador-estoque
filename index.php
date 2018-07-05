<?php    
    header('Access-Control-Allow-Origin: *'); 
    header("Access-Control-Allow-Credentials: false");
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
    header('Access-Control-Allow-Headers: Authorization, content-type');
    header("Content-type:text/html; charset=utf-8");
    require_once('./vendor/autoload.php');
    session_start();
    use app\server\Router;
    use app\server\Login;
    use app\server\Cadastro;
    use app\server\Fisica;
    use app\server\Juridica;
    use app\server\Produto;
    use app\server\Abertura;
    use app\server\Fechamento;
    use app\server\Venda;
    Router::dev();

    /* New Register user , Novo registro de Usuario */
    Router::get('/register', function(){
        Router::View("./app/client/cadastro.html", ["#{title}#"=>"Cadastro - Seja Bem Vindo"]);
    });
    Router::post('/register', function(){
       $cadastro = new Cadastro(); 
       $ret = $cadastro->save( Router::getJson() );
       if($ret)
            echo "Usuario cadastrado com Sucesso!"; 
        else
            echo "Erro ao cadastrar Usuário";

    });
    /* login in the system, logando no sistema */
    Router::get('/login', function(){
        if(!isset($_SESSION['login']) && !isset($_SESSION['senha'])){
            Router::View("./app/client/login.html", ["#{title}#"=>"Login - Seja Bem Vindo"
            ]);
        }else{
            header("location: ../");
        }
    });
    Router::post('/login', function(){
        $login = new Login();
        $res= $login->logar($user, $senha);
        if($res){
            Router::View("./app/client/index.html", ["#{title}#"=>"Inicio - Seja Bem Vindo",
                "#{test}#"=>"test de h1"
            ]);
        }
    });
    Router::get('/', function() {
        if(isset($_SESSION['login']) && isset($_SESSION['senha'])){
            Router::View("./app/client/index.html", ["#{title}#"=>"Inicio - Seja Bem Vindo",
                "#{test}#"=>"test de h1"
            ]);
        }else{
           header("location: login");
        }
    });
    

    
/* Modulo Pessoa Fisica */
    Router::get('/cliente/fisica', function() {
        Router::View("./app/client/fisica.html", ["#{title}#"=>"Cliente - Pessoa Fisíca", "#{nome}#"=>"Pessoa Fisíca"
        ]);
        /* $fisica = new Fisica();
        echo $fisica->getAll(); */
    });
    Router::get('/cliente/fisica/dados', function() {
         $fisica = new Fisica();
        echo $fisica->getAll();
    });
 
    Router::get('/cliente/fisica/{id}', function($param) {
        $fisica = new Fisica();
        echo $fisica->find( $param->id );
    });

    Router::post('/cliente/fisica', function() {
        $fisica = new Fisica();
        
        if( $fisica->save( Router::getJson() ) )
            echo "cadastrado!";
        else
            echo "erro";
    });

    Router::put('/cliente/fisica', function() {
        $fisica = new Fisica();

        if( $fisica->update( Router::getJson() ) )
            echo "alterado!";
        else
            echo "erro";
    });

    Router::delete('/cliente/fisica/{id}', function($param) {
        $fisica = new Fisica();
        echo $fisica->trash( $param->id )."Deletado o dado";
    });

    /* Final do Modulo Pessoa Juridica */

    Router::get('/cliente/juridica', function() {
        Router::View("./app/client/juridica.html", ["#{title}#"=>"titlulo escolhido"
        ]);
       /* $juridica = new Juridica();
        echo $juridica->getAll();*/
    });
     Router::get('/cliente/juridica/dados', function() {
        $juridica = new Juridica();
        echo $juridica->getAll();
    });
 
    Router::get('/cliente/juridica/{id}', function($param) {
        $juridica = new Juridica();
        echo $juridica->find( $param->id );
    });

    Router::post('/cliente/juridica', function() {
        $juridica = new Juridica();

        if( $juridica->save( Router::getJson() ) )
            echo "cadastrado!";
        else
            echo "erro";
    });

    Router::put('/cliente/juridica', function() {
        $juridica = new Juridica();

        if( $juridica->update( Router::getJson() ) )
            echo "alterado!";
        else
            echo "erro";
    });

    Router::delete('/cliente/juridica/{id}', function($param) {
        $fisica = new Juridica();
        echo $fisica->trash( $param->id )."Deletado o dado";
    });





    /* Modulo Produto */

    Router::get('/produto', function() {
       Router::View("./app/client/produto.html", ["#{title}#"=>"titlulo escolhido", "#{nome}#"=>"Produto"
        ]);
    });
 
    Router::get('/produto/{id}', function($param) {
        $produto = new Produto();
        echo $produto->find( $param->id );
    });

    Router::post('/produto', function() {
        $produto = new Produto();

        if( $produto->save( Router::getJson() ) )
            echo "cadastrado!";
        else
            echo "erro";
    });

    Router::put('/produto', function() {
        $produto = new Produto();

        if( $produto->update( Router::getJson() ) )
            echo "alterado!";
        else
            echo "erro";
    });

    Router::delete('/produto/{id}', function($param) {
        $produto = new Produto();
        echo $produto->trash( $param->id )."Deletado o dado";
    });


/* Final do Modulo Produto */



/* Modulo Caixa Abertura */

    Router::get('/caixa/abertura', function() {
        Router::View("./app/client/abertura.html", ["#{title}#"=>"titlulo escolhido", "#{nome}#"=>"Abertura do Caixa"
        ]);
    });

    Router::get('/caixa/abertura/{id}', function($param) {
        $abertura = new Abertura();
        echo $abertura->find( $param->id );
    });

    Router::post('/caixa/abertura', function() {
        $abertura = new Abertura();

        if( $abertura->save( Router::getJson() ) )
            echo "cadastrado!";
        else
            echo "erro";
    });

    Router::delete('/caixa/abertura/{id}', function($param) {
        $abertura = new Abertura();
        echo $abertura->trash( $param->id )."Deletado o dado";
    });


/* Final do Modulo Caixa Abertura*/


/* Modulo Caixa Fechamento */

    Router::get('/caixa/fechamento', function() {
        Router::View("./app/client/fechamento.html", ["#{title}#"=>"titlulo escolhido", "#{nome}#"=>"Fechamento do Caixa"
        ]);
    });

    Router::get('/caixa/fechamento/{id}', function($param) {
        $fechamento = new Fechamento();
        echo $fechamento->find( $param->id );
    });

    Router::post('/caixa/fechamento', function() {
        $fechamento = new Fechamento();

        if( $fechamento->save( Router::getJson() ) )
            echo "cadastrado!";
        else
            echo "erro";
    });

    Router::delete('/caixa/fechamento/{id}', function($param) {
        $fechamento = new Fechamento();
        echo $fechamento->trash( $param->id )."Deletado o dado";
    });


/* Final do Modulo Caixa Fechamento*/

    /* Modulo Venda */

    Router::get('/venda', function() {
        $venda = new Venda();
        echo $venda->getAll();
    });
 
    Router::get('/venda/{id}', function($param) {
        $venda = new Venda();
        echo $venda->find( $param->id );
    });

    Router::post('/venda', function() {
        $venda = new Venda();
        $itens = json_encode();
        if( $venda->save( Router::getJson() ) )
            echo "cadastrado!";
        else
            echo "erro";
    });

    Router::put('/venda', function() {
        $venda = new Venda();

        if( $venda->update( Router::getJson() ) )
            echo "alterado!";
        else
            echo "erro";
    });

    Router::delete('/venda/{id}', function($param) {
        $venda = new Venda();
        echo $venda->trash( $param->id )."Deletado o dado";
    });


/* Final do Modulo Produto */


    Router::notFound("./app/client/notFound.html");
