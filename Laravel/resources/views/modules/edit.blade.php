@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5>Edição de Módulo #ID: {{ $module->id }} </h5>
                            </div>
                            <div class="col  text-right">
                                <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#deleteModule">
                                    Deletar Módulo
                                </button>

                                <div class="modal fade" id="deleteModule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Confirmação de exclusão</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <h4 class="text-danger">Tem certeza que deseja excluir este módulo?</h4>
                                                <p>Esta ação excluirá todas as atividades vinculadas ao módulo.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <form action="{{ route('modules.destroy', ['module' => $module->id]) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input name="id" value="{{ $module->id }}" hidden>
                                                    <button type="submit" class="btn btn-danger">Deletar Módulo</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('modules.update', ['module' => $module->id]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-6">Cadastrado: {{ $module->created_at }}</div>
                                <div class="col-6">Última atualização: {{ $module->updated_at }}</div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="title">Título</label>
                                <input type="text" class="form-control" id="title" name="title" aria-describedby="titleHelp" value="{{ $module->title }}">
                                <small id="titleHelp" class="form-text text-muted">Capriche no título para que todos saibam do que se trata.</small>
                            </div>

                            <div class="form-group">
                                <label for="description">Descrição</label>
                                <textarea class="form-control" id="description" name="description" rows="2">{{ $module->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="Pendente" @if($module->status == "Pendente") selected @endif>Pendente</option>
                                    <option value="Aprovado" @if($module->status == "Aprovado") selected @endif>Aprovado</option>
                                    <option value="Cancelado" @if($module->status == "Cancelado") selected @endif>Cancelado</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-secondary btn-block">Salvar Alterações</button>
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
                                        @forelse($module->activity as $activity)
                                            <tr>
                                                <th scope="row">{{ $activity->id }}</th>
                                                <td>{{ $activity->title }}</td>
                                                <td>{{ $activity->status }}</td>
                                                <td><a href="{{ route('activities.edit', ['activity' => $activity->id]) }}" class="btn btn-sm btn-primary">Editar</a></td>
                                            </tr>
                                        @empty
                                                <h6 class="text-center"> Não encontramos atividades para este módulo</h6>
                                        @endforelse
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
                            <form action="{{ route('activities.store') }}" method="POST">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Nova atividade</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-left">
                                    @csrf
                                    <div class="form-group">
                                        <label for="title">Módulo</label>
                                        <input type="text" class="form-control" id="module_id" name="module_id" value="{{ $module->id }}" hidden>
                                        <input type="text" class="form-control" value="{{ $module->title }}" disabled> {{--Campo usado somente para apresentar o titulo do módulo--}}
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
        </div>
    </div>
@endsection
