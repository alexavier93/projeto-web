@extends('admin.layouts.app')

@section('content')

    <!-- Page Heading -->
    <div class="page-header-content py-3">

        <div class="d-sm-flex align-items-center justify-content-between">
            <h1 class="h3 mb-0 text-gray-800">Usuários</h1>
            <a href="{{ route('admin.users.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus text-white-50"></i> Novo Usuário
            </a>
        </div>

        <ol class="breadcrumb mb-0 mt-4">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Usuários</li>
        </ol>

    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            @include('flash::message')

            <!-- Project Card Example -->
            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <span class="m-0 font-weight-bold text-primary">Usuários</span>

                    <a href="{{ route('admin.users.create') }}"
                        class="btn btn-sm btn-primary float-right d-block d-sm-none">Novo Usuário</a>
                </div>

                <div class="card-body">

                    <div class="table-users d-none d-sm-block">

                        <table class="table table-bordered">

                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($users as $user)

                                    <tr>
                                        <td>{{ $user->id }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->status == 1)
                                                <span class="badge badge-success">Ativo</span>
                                            @else
                                                <span class="badge badge-danger">Inativo</span>
                                            @endif
                                        </td>
                                        <td width="15%">
                                            <div class="btn-group">
                                                <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}"
                                                    class="btn btn-sm btn-primary">Editar</a>
                                                <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}" method="post">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>

                    </div>

                    <div class="list-users">

                        <ul class="list-group d-block d-sm-none">

                            <li class="list-group-item">

                                <div class="row">

                                    <div class="col-xs-12 col-sm-6">
                                        <h6>José Maria <span class="badge badge-success">Ativo</span></h6>
                                        <small class="text-muted">email@email.com</small>
                                        <small class="text-muted"></small>
                                    </div>

                                    <div class="col-xs-12 col-sm-6">

                                        <div class="btn-group mt-3" role="group">
                                            <a href="#" class="btn btn-sm btn-primary">Editar</a>
                                            <a href="#" class="btn btn-sm btn-danger">Excluir</a>
                                        </div>

                                    </div>
                                </div>

                            </li>

                            <li class="list-group-item">

                                <div class="row">

                                    <div class="col-xs-12 col-sm-6">
                                        <h6>Alexandre Xavier <span class="badge badge-success">Ativo</span></h6>
                                        <small class="text-muted">email@email.com</small>
                                        <small class="text-muted"></small>
                                    </div>

                                    <div class="col-xs-12 col-sm-6">

                                        <div class="btn-group mt-3" role="group">
                                            <a href="#" class="btn btn-sm btn-primary">Editar</a>
                                            <a href="#" class="btn btn-sm btn-danger">Excluir</a>
                                        </div>

                                    </div>
                                </div>

                            </li>

                        </ul>

                    </div>


                </div>

            </div>

        </div>

    </div>


@endsection
