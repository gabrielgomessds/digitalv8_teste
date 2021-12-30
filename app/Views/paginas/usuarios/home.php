<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Usuários</title>
    <link rel="stylesheet" href="<?= URL ?>/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>

<body>
    <div class="d-flex justify-center flex-column mb-3 mt-2 align-items-center">
        <h1>Usuários Cadastrados - <?=$dados['quantUsuarios'];?></h1>
        <div>
            <a href="<?= URL ?>/usuarios/cadastrar"><button type="button" class="btn btn-success">Adicionar Cliente <i class="bi bi-person-plus-fill"></i></button></a>
        </div>

    </div>
   
    <?=Sessao::mensagem('usuario')?>
    
    <div class="container">
        <table class="table table-striped ">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Sobrenome</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Email</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dados['usuarios'] as $usuario) : ?>
                    <tr>
                        <td><?= $usuario->id ?></td>
                        <td><?= $usuario->nome ?></td>
                        <td><?= $usuario->sobrenome ?></td>
                        <td><?= $usuario->endereco ?></td>
                        <td><?= $usuario->email ?></td>
                        <td><a href="<?= URL ?>/usuarios/alterar/<?= $usuario->id ?>"><button type="button" class="btn btn-primary">Editar <i class="bi bi-pencil-fill"></i></button></a></td>
                        <td><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#excluirCliente<?= $usuario->id ?>">Excluir <i class="bi bi-trash-fill"></i></button></td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
        <?=$dados['quantUsuarios'] == 0 ? '<h1 class="text-center">Nenhum usuário cadastrado</h1>' : '' ?>
    </div>


    <footer>
        <h4>Feito por - Gabriel Gomes</h4>
    </footer>

    <!-- ============================ MODAL PARA EXCLUIR O USUARIO ============================= -->
    <?php foreach ($dados['usuarios'] as $usuario) : ?>
        <div class="modal fade" id="excluirCliente<?=$usuario->id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Excluir Usuário</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4>Tem certeza que deseja excluir <?=$usuario->nome?> <?=$usuario->sobrenome?>?</h4>
                    </div>
                    <div class="modal-footer">
                        <a href="<?=URL?>/usuarios/deletar&id=<?=$usuario->id?>"><button type="button" class="btn btn-success">Sim</button></a>
                       
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Não</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>



    <script src="<?= URL ?>/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="<?= URL ?>/bootstrap/js/bootstrap.js"></script>
</body>

</html>