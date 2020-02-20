@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5>Edição de Atividade #ID: {{ $activity->id }} </h5>
                                <h6>Módulo: {{ $activity->module->title }} </h6>
                            </div>
                            <div class="col  text-right">
                                <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#deleteActivity">
                                    Deletar Atividade
                                </button>

                                <div class="modal fade" id="deleteActivity" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Confirmação de exclusão</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <h4 class="text-danger">Tem certeza que deseja excluir esta Atividade?</h4>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <form action=" {{ route('activities.destroy', ['activity' => $activity->id]) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Deletar Atividade</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('activities.update', ['activity' => $activity->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="text" class="form-control" id="module_id" name="module_id" value="{{ $activity->module_id }}" required hidden>

                            <div class="row">
                                <div class="col-6">Cadastrado: {{ $activity->created_at }}</div>
                                <div class="col-6">Última atualização: {{ $activity->updated_at }}</div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="title">Título</label>
                                <input type="text" class="form-control" id="title" name="title"  value="{{ $activity->title }}" required>
                                <small id="titleHelp" class="form-text text-muted">Capriche no título para que todos saibam do que se trata.</small>
                            </div>

                            <div class="form-group">
                                <label for="description">Descrição</label>
                                <textarea class="form-control" id="description" name="description" rows="2">{{ $activity->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="Pendente" @if($activity->status == "Pendente") selected @endif>Pendente</option>
                                    <option value="Aprovado" @if($activity->status == "Aprovado") selected @endif>Aprovado</option>
                                    <option value="Cancelado" @if($activity->status == "Cancelado") selected @endif>Cancelado</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-secondary btn-block">Salvar Alterações</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
