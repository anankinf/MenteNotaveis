@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5>Módulos</h5>
                            </div>
                            <div class="col  text-right">
                                <a href="{{ route('modules.create')}}" class="btn btn-sm btn-outline-success">Novo Módulo</a>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
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
                                @forelse($modules as $module)
                                    <tr>
                                        <th scope="row">{{ $module->id }}</th>
                                        <td>{{ $module->title }}</td>
                                        <td>{{ $module->status }}</td>
                                        <td><a href="{{ route('modules.edit', ['module' => $module->id]) }}" class="btn btn-sm btn-primary">Editar</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <h6 class="text-center">Ainda não existem Módulos cadastrados.</h6>
                                    </tr>
                                @endforelse
                                </tbody>

                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
