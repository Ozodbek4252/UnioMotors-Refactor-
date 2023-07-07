@extends('layouts.dashboard.main')

@section('content')

        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Form</h5>
                </div>
                <form class="form theme-form">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Input</label>
                                <input class="form-control" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Select Option</label>
                                <select class="form-select btn-square digits" id="exampleFormControlSelect12">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Textarea</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">CK Editor</label>
                                <textarea class="ckeditor" id="exampleFormControlTextarea4" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Table CRUD</h5>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Alexander</td>
                            <td>Orton</td>
                            <td>
                                <a href="/edit"><button class="btn btn-xs btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenterEdit" ><i data-feather="edit-2"></i></button></a>
                                <button class="btn btn-xs btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenterEdit" ><i data-feather="edit-2"></i></button>
                                <div class="modal fade" id="exampleModalCenterEdit" tabindex="-1" aria-labelledby="exampleModalCenter" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Изменить</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    {{ method_field('put') }}

                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-primary" type="button" data-bs-original-title="" title="">Изменить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-xs btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenterDelete" ><i data-feather="trash"></i></button>
                                <div class="modal fade" id="exampleModalCenterDelete" tabindex="-1" aria-labelledby="exampleModalCenter" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Удалить?</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="" method="post">
                                                    @csrf
                                                    {{ method_field('delete') }}
                                                    <button class="btn btn-primary" type="button" data-bs-original-title="" title="">Да</button>
                                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" data-bs-original-title="" title="">Нет</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
{{--    Analytics--}}
    <div>
    </div>

@endsection

@section('scripts')
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>
@endsection
