<?php

class Usuarios extends Controller
{

    public function __construct()
    {
        //Instanciando o modelo na classe usuaio
        $this->usuarioModel = $this->model('Usuario');
    }

    /* ===================== PAGINA INICIAL COM OS DADOS ===================== */
    public function index()
    {
        $dados = [
            'usuarios' => $this->usuarioModel->lerUsuarios(),
            'quantUsuarios' => $this->usuarioModel->quantUsuario()
        ];


        $this->view('paginas/usuarios/home', $dados);
    }

    //Função para cadastrar
    public function cadastrar()
    {
        //Validando formulario
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) :
            $dados = [
                'nome' => trim($formulario['nome']),
                'sobrenome' => trim($formulario['sobrenome']),
                'email' => trim($formulario['email']),
                'endereco' => trim($formulario['endereco']),
                'email' => trim($formulario['email'])
            ];


            //se o array formulario for vazio verifica cada campo vendo se está preenchido
            if (in_array("", $formulario)) :
                if (empty($formulario['nome'])) :
                    $dados['nome_erro'] = "Preencha o campo nome";
                endif;
                if (empty($formulario['sobrenome'])) :
                    $dados['sobrenome_erro'] = "Preencha o campo sobrenome";
                endif;
                if (empty($formulario['endereco'])) :
                    $dados['endereco_erro'] = "Preencha o campo endereço";
                endif;
                if (empty($formulario['email'])) :
                    $dados['email_erro'] = "Preencha o campo email";
                endif;
            else :
                //Verifica se o nome possui algum caractere ou numero
                if (Checa::checaNome($formulario['nome'])) :
                    $dados['nome_erro'] = 'O nome é invalido!';
                //Verifica o email
                elseif (Checa::checaEmail($formulario['email'])) :
                    $dados['email_erro'] = 'O email é invalido!';
                //Verifica se o email já foi cadastrado
                elseif ($this->usuarioModel->checarEmail($formulario['email'])) :
                    Sessao::mensagem('usuario', 'O email <b>' . $formulario['email'] . '</b> já foi cadastrado', 'alert alert-danger alert-dismissible fade show');
                else :
                    //Se tudo estiver certo cadastra no banco e mostra a mensagem
                    if ($this->usuarioModel->armazenar($dados)) :
                        Sessao::mensagem('usuario', 'Usuário cadastrado com sucesso!');
                        $dados = [
                            'nome' => '',
                            'sobrenome' => '',
                            'endereco' => '',
                            'email' => '',
                        ];
                    else :
                        Sessao::mensagem('usuario', 'Erro ao cadastrar o usuário', 'alert alert-danger alert-dismissible fade show');
                    endif;
                endif;

            endif;


        else :
            $dados = [
                'nome' => '',
                'sobrenome' => '',
                'endereco' => '',
                'email' => '',

                'nome_erro' => '',
                'sobrenome_erro' => '',
                'endereco_erro' => '',
                'email_erro' => '',
            ];
        endif;

        $this->view('paginas/usuarios/cadastrar', $dados);
    }


    /* ============================= ALTERAR DADOS DO USUARIOS ========================= */
    public function alterar($id)
    {

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) :
            $dados = [
                'id' => $id,
                'nome' => trim($formulario['nome']),
                'sobrenome' => trim($formulario['sobrenome']),
                'email' => trim($formulario['email']),
                'endereco' => trim($formulario['endereco']),
                'email' => trim($formulario['email'])
            ];


            if (in_array("", $formulario)) :
                if (empty($formulario['nome'])) :
                    $dados['nome_erro'] = "Preencha o campo nome";
                endif;
                if (empty($formulario['sobrenome'])) :
                    $dados['sobrenome_erro'] = "Preencha o campo sobrenome";
                endif;
                if (empty($formulario['endereco'])) :
                    $dados['endereco_erro'] = "Preencha o campo endereço";
                endif;
                if (empty($formulario['email'])) :
                    $dados['email_erro'] = "Preencha o campo email";
                endif;
            else :

                if (Checa::checaNome($formulario['nome'])) :
                    $dados['nome_erro'] = 'O nome é invalido!';

                elseif (Checa::checaEmail($formulario['email'])) :
                    $dados['email_erro'] = 'O email é invalido!';
                else :

                    if ($this->usuarioModel->alterar($dados)) :
                        Sessao::mensagem('usuario', 'Usuário atualizado com sucesso!');
                    else :
                        Sessao::mensagem('usuario', 'Erro ao atualizar o usuário', 'alert alert-danger alert-dismissible fade show');
                    endif;
                endif;

            endif;


        else :

            $usuario = $this->usuarioModel->lerUsuarioPorId($id);

            $dados = [
                'id' => $usuario->id,
                'nome' => $usuario->nome,
                'sobrenome' => $usuario->sobrenome,
                'endereco' => $usuario->endereco,
                'email' => $usuario->email,

                'nome_erro' => '',
                'sobrenome_erro' => '',
                'endereco_erro' => '',
                'email_erro' => '',
            ];
        endif;

        $this->view('paginas/usuarios/alterar', $dados);
    }

    /* ========================= DELETAR USUARIO ========================= */

    public function deletar()
    {
        $id = $_GET['id'];
        if ($this->usuarioModel->deletar($id)) :
            Sessao::mensagem('usuario', 'Usuário cadastrado com sucesso!');
            URL::redirecionar('home');
        else :
            Sessao::mensagem('usuario', 'Erro ao excluir o usuário', 'alert alert-danger alert-dismissible fade show');
            URL::redirecionar('home');
        endif;
    }
}
