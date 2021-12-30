<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários</title>
    <link rel="stylesheet" href="<?=URL?>/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    
</head>

<body>
    <div class="d-flex justify-center flex-column mb-3 mt-2 align-items-center">
        <h1>Cadastro de Usuários </h1>
        <div>
        <a href="<?=URL?>/home"><button type="button" class="btn btn-success">Lista de Usuários <i class="bi bi-list-ul"></i></button></a>

        </div>
    </div>

    <div class="container border border-1 p-2">
        <form method="POST" name="cadastrar" action="<?=URL?>/usuarios/cadastrar">
            <?=Sessao::mensagem('usuario')?>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nome: </label>
                <input type="text" value="<?=$dados['nome']?>" class="form-control <?=$dados['nome_erro'] ? 'is-invalid' : ''?>" name="nome" placeholder="Digite o primeiro nome" >

                <div class="invalid-feedback">
                    <?=$dados['nome_erro']?>
                </div>
            </div>
           
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Sobrenome: </label>
                <input type="text" value="<?=$dados['sobrenome']?>"  class="form-control <?=$dados['sobrenome_erro'] ? 'is-invalid' : ''?>" name="sobrenome" placeholder="Digite seu sobrenome" >
                <div class="invalid-feedback">
                    <?=$dados['sobrenome_erro']?>
                </div>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Endereço: </label>
                <input type="text" value="<?=$dados['endereco']?>"  class="form-control <?=$dados['endereco_erro'] ? 'is-invalid' : ''?>" name="endereco" placeholder="Digite seu endereço" >
                <div class="invalid-feedback">
                    <?=$dados['endereco_erro']?>
                </div>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email: </label>
                <input type="email" value="<?=$dados['email']?>"  class="form-control <?=$dados['email_erro'] ? 'is-invalid' : ''?>" name="email" placeholder="Digite seu email" >
                <div class="invalid-feedback">
                    <?=$dados['email_erro']?>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>

    <footer class="mt-5">
        <h4>Feito por - Gabriel Gomes</h4>
    </footer>



    <script src="<?=URL?>/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="<?=URL?>/bootstrap/js/bootstrap.js"></script>
</body>

</html>