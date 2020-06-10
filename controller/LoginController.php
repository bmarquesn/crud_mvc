<?php
require_once('model/UsuarioModel.php');
require_once('main/MainController.php');

class LoginController extends Controller {
    private $model1;
    
    public function __construct() {
        if(isset($_POST['usuario']) && !empty($_POST['usuario'])) {
            $this->request = $_POST;
        }

        $this->model1 = new UsuarioModel;
        $this->index();
    }

    public function index() {
        $message = isset($_GET['message'])&&!empty($_GET['message'])?$_GET['message']:0;

        return $this->view('login', [
            'script_pages' => 'login.js'
            ,'hash_login' => $this->hash_login()
            ,'message' => isset($_GET['message'])&&!empty($_GET['message'])?$_GET['message']:0
        ]);
    }

    public function logar() {
        /** fazer toda a validação de login */
        if($this->__get('usuario') && $this->__get('senha')) {
            $usuario = $this->model1->escapar($this->__get('usuario'));
            $senha = $this->model1->escapar(md5($this->__get('senha').$this->hash_senha));
            /** 'all_filter' = nome do campo na tabela e o valor que deseja buscar */
            $dados_usuario = $this->model1->all_filter([['usuario', $usuario], ['senha', $senha]]);

            if($dados_usuario !== false) {
                /** cria-se a sessão do usuário com o ID deste */
                session_start();
                $_SESSION['id_user'] = base64_encode($dados_usuario[0]['id'].$this->hash_senha);
                unset($dados_usuario);

                header("Location:?controller=usuario"); 
            } else {
                header("Location:?controller=login&message=Dados-De-Login-Invalidos");
            }
        } else {
            header("Location:?controller=login&message=Os-Campos-Nao-Foram-Prenchidos-Corretamente");
        }
        exit();
    }

    public function logout() {
        session_start();

        if(isset($_SESSION['id_user'])) {
            unset($_SESSION['id_user']);
            session_destroy();
        }

        return $this->index();
    }

    public function hash_login($qtd_caracteres = 5) {
        $upper = implode('', range('A', 'Z'));
        $lower = implode('', range('a', 'z'));
        $nums = implode('', range(0, 9));

        $alphaNumeric = $upper.$lower.$nums;
        $string = '';
        $len = $qtd_caracteres;

        for($i = 0; $i < $len; $i++) {
            $string .= $alphaNumeric[rand(0, strlen($alphaNumeric) - 1)];
        }

        return $string;
    }
}