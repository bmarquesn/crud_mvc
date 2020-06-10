<?php
require_once('main/MainController.php');

class UsuarioController extends Controller {
    private $model1;
    private $model2;
    
    public function __construct() {
        session_start();

        if(!isset($_SESSION['id_user']) || empty($_SESSION['id_user'])) {
            header('Location:?controller=login&method=logout&message=Preciso-Estar-Logado');
        } else {
            require_once('model/UsuarioModel.php');
            $this->model1 = new UsuarioModel;
            require_once('model/EnderecoModel.php');
            $this->model2 = new EnderecoModel;
        }
    }

    public function index() {
        $filtro_1 = isset($_GET['filtro_1'])&&!empty($_GET['filtro_1'])?$_GET['filtro_1']:0;
        $filtro_2 = isset($_GET['filtro_2'])&&!empty($_GET['filtro_2'])?$_GET['filtro_2']:0;
        $ativo = 1;
        
        if(!empty($filtro_1) || !empty($filtro_2)) {
            $array_filtro[] = ['nome', $filtro_1];
            $array_filtro[] = ['email', $filtro_2];
            $registros = $this->model1->all_filter($array_filtro, 'OR', 'LIKE', $ativo);
        } else {
            $registros = $this->model1->all($ativo);
        }
        
        return $this->view('usuario', [
            'registros' => $registros
            ,'script_pages' => 'usuario.js'
        ], 'pagina_interna');
    }

    public function inserir() {
        return $this->view('usuario_inserir', [
            'registros' => null
            ,'script_pages' => 'usuario.js'
        ], 'pagina_interna');
    }

    public function salvar() {
        $dados_salvar = $_POST;
        $id_usuario = NULL;

        foreach($dados_salvar as $key => $value) {
            $novo_usuario = true;

            if(!empty($value)) {
                if($key == 'id_usuario' && !empty($value)) {
                    $novo_usuario = false;
                    $this->model1->__set('id', 'id-'.(int)$value);
                    /** chave estrangeira - na tabela endereco tem o id_usuario */
                    $this->model2->__set('id', 'id_usuario-'.(int)$value);
                }

                if($key == 'nome' || $key == 'email' || $key == 'usuario' || $key == 'senha') {
                    if($key == 'senha') {
                        $this->model1->__set($key, md5($value.$this->hash_senha));
                    } else {
                        $this->model1->__set($key, $value);
                    }
                } else if($key == 'cep' || $key == 'logradouro' || $key == 'numero_endereco' || $key == 'complemento_endereco' || $key == 'bairro' || $key == 'cidade' || $key == 'uf') {
                    if($key == 'cep') {
                        $this->model2->__set($key, preg_replace("/[^0-9]/", "", $value));
                    } else {
                        $this->model2->__set($key, $value);
                    }
                }
            }
        }

        $id_usuario = $this->model1->save(0);

        if($novo_usuario) {
            $this->model2->__set('id_usuario', (int)$id_usuario);
        }
        
        $this->model2->save(0);
        
        echo "salvou";
        die;
    }

    public function editar() {
        if(isset($_GET['identifier']) && !empty($_GET['identifier'])) {
            $id_usuario = (int)$_GET['identifier'];
        }

        $dados_usuario = $this->model1->trazer_dados_usuario($id_usuario, 0);

        return $this->view('usuario_inserir', [
            'registros' => $dados_usuario[0]
            ,'script_pages' => 'usuario.js'
        ], 'pagina_interna');
    }

    public function excluir() {
        $dados_salvar = $_POST;
        
        $this->model1->destroy(array_keys($dados_salvar)[0], array_values($dados_salvar)[0], 0);
        $this->model2->destroy('id_usuario', array_values($dados_salvar)[0], 1);

        echo "salvou";
        die;
    }
}