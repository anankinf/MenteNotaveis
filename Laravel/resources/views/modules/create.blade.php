@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Novo Módulo </div>

                    <div class="card-body">
                        <form action="{{ route('modules.store') }}" method="POST">
                            @csrf

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

                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-secondary btn-lg btn-block">Cadastrar Módulo</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
