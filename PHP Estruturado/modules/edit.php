<?php

require_once("../Module.php");
require_once("../Activity.php");
require_once("../connection.php");

$id = $_GET['id'] ?? null;
$module_id = $id;

$module = new Module($mysqli);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $update = $_POST;

    $module->update($update);

    header('location: /');

    die();
}

$retModule = $module->find($id);

$activity = new Activity($mysqli);

$collection = $activity->list($module_id);


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MentesNotáveis</title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                MentesNotáveis Teste PHP CRUD
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Lista de Módulos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Edição de Módulo </div>

                        <div class="card-body">
                            <form action="create.php" method="POST">

                                <div class="row">
                                    <div class="col-6">Cadastrado: <?php echo utf8_encode($retModule['created_at']) ?></div>
                                    <div class="col-6">Última atualização: <?php echo utf8_encode($retModule['updated_at']) ?></div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="title">Título</label>
                                    <input type="text" class="form-control" id="title" name="title" value="<?php echo utf8_encode($retModule['title']) ?>">
                                    <small id="titleHelp" class="form-text text-muted">Capriche no título para que todos saibam do que se trata.</small>
                                </div>

                                <div class="form-group">
                                    <label for="description">Descrição</label>
                                    <textarea class="form-control" id="description" name="description" rows="4"><?php echo utf8_encode($retModule['description']) ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="<?php echo $retModule['status'] ?>"><?php echo $retModule['status'] ?></option>
                                        <option value="Pendente">Pendente</option>
                                        <option value="Aprovado">Aprovado</option>
                                        <option value="Cancelado">Cancelado</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline-secondary btn-lg btn-block">Atualizar Módulo</button>
                                </div>

                                <hr>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col">
                                            <h5>Atividades</h5>
                                        </div>
                                        <div class="col text-right">
                                            <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#createActivity">
                                                Nova atividade
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th scope="col"  width="2%">#ID</th>
                                                <th scope="col" width="83%">Título</th>
                                                <th scope="col"  width="10%">Status</th>
                                                <th scope="col"  width="5%">Ação</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($collection as $data) : ?>
                                                <tr>
                                                    <th scope="row"><?php echo $data['id']; ?></th>
                                                    <td><?php echo utf8_encode($data['title']); ?></td>
                                                    <td><?php echo $data['status']; ?></td>
                                                    <td><a href="../activities/edit.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-primary">Editar</a></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal fade" id="createActivity" tabindex="-1" role="dialog" aria-labelledby="createActivity" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="../activities/create.php" method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Nova atividade</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-left">
                                        <div class="form-group">
                                            <label for="title">Módulo</label>
                                            <input type="text" class="form-control" id="module_id" name="module_id" value="<?php echo $retModule['id'] ?>" hidden>
                                            <input type="text" class="form-control" value="<?php echo utf8_encode($retModule['title']) ?>" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="title">Título</label>
                                            <input type="text" class="form-control" id="title" name="title" aria-describedby="titleHelp" placeholder="Título">
                                            <small id="titleHelp" class="form-text text-muted">Capriche no título para que todos saibam do que se trata.</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Descrição</label>
                                            <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="Pendente">Pendente</option>
                                                <option value="Aprovado">Aprovado</option>
                                                <option value="Cancelado">Cancelado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-success">Criar atividade Módulo</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div
                </div>
            </div>
        </div>
    </main>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>