@extends('layouts.dashboard.main')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success') != null)
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error') != null)
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Добавить Основной слайдер</h5>
                </div>
                <form action="{{ route('dashboard.slider.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Фото </label>
                                    <div class="col-12 text-center">
                                        {{-- <i data-feather="loader" style="height: 100px; width: 100px"></i> --}}
                                    </div>
                                    <input class="form-control" id="exampleFormControlInput1" type="file" required
                                        name="photo">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Ссылки</label>
                                    <input class="form-control" id="exampleFormControlInput1" required type="text"
                                        name="link">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Название RU</label>
                                    <input class="form-control" id="exampleFormControlInput1" required type="text"
                                        name="name_ru">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Название UZ</label>
                                    <input class="form-control" id="exampleFormControlInput1" required type="text"
                                        name="name_uz">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Название EN</label>
                                    <input class="form-control" id="exampleFormControlInput1" required type="text"
                                        name="name_en">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label">Описание Ru</label>
                                <textarea class="ckeditor" name="discription_ru" id="exampleFormControlTextarea4" rows="3"></textarea>
                            </div>
                            <div class="col-4">
                                <label class="form-label">Описание Uz</label>
                                <textarea class="ckeditor" name="discription_uz" id="exampleFormControlTextarea4" rows="3"></textarea>
                            </div>
                            <div class="col-4">
                                <label class="form-label">Описание En</label>
                                <textarea class="ckeditor" name="discription_en" id="exampleFormControlTextarea4" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <h5>Все Основной слайдер</h5>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Фото</th>
                                <th scope="col">Название</th>
                                <th scope="col" class="text-center">Действия</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($sliders as $key => $slider)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td><img src="{{ $slider->photo }}" alt="" style="height: 100px; width: 100px">
                                    </td>
                                    <td>{{ $slider->name_ru }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-xs btn-success" type="button" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalCenter{{ $slider->id }}Edit"><i
                                                class="bx bx-pencil"></i>Изменить</button>
                                        <div class="modal fade" id="exampleModalCenter{{ $slider->id }}Edit"
                                            tabindex="-1" aria-labelledby="exampleModalCenter" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document"
                                                style="max-width: 50vw">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Изменить</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('dashboard.slider.update', $slider) }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            {{ method_field('put') }}
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="mb-4">
                                                                            <label class="form-label"
                                                                                for="exampleFormControlInput1">Фото
                                                                            </label>
                                                                            <div class="col-12 text-center">
                                                                                <img style="height: 150px; width: 150px"
                                                                                    src="{{ $slider->photo }}">
                                                                            </div>
                                                                            <p>max.20 MB</p>
                                                                        </div>
                                                                        <input class="form-control mt-1"
                                                                            id="exampleFormControlInput1" type="file"
                                                                            name="photo">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <div class="mb-3">
                                                                        <label class="form-label"
                                                                            for="exampleFormControlInput1">Название
                                                                            RU</label>
                                                                        <input class="form-control"
                                                                            id="exampleFormControlInput1" type="text"
                                                                            required name="name_ru"
                                                                            value="{{ $slider->name_ru }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="mb-3">
                                                                        <label class="form-label"
                                                                            for="exampleFormControlInput1">Название
                                                                            UZ</label>
                                                                        <input class="form-control"
                                                                            id="exampleFormControlInput1" type="text"
                                                                            required name="name_uz"
                                                                            value="{{ $slider->name_uz }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="mb-3">
                                                                        <label class="form-label"
                                                                            for="exampleFormControlInput1">Название
                                                                            EN</label>
                                                                        <input class="form-control"
                                                                            id="exampleFormControlInput1" type="text"
                                                                            required name="name_en"
                                                                            value="{{ $slider->name_en }}">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <label class="form-label">Описание Ru</label>
                                                                        <textarea class="ckeditor" name="discription_ru" id="exampleFormControlTextarea4" rows="3">{{ $slider->discription_ru }}</textarea>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label class="form-label">Описание Uz</label>
                                                                        <textarea class="ckeditor" name="discription_uz" id="exampleFormControlTextarea4" rows="3">{{ $slider->discription_uz }}</textarea>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label class="form-label">Описание En</label>
                                                                        <textarea class="ckeditor" name="discription_en" id="exampleFormControlTextarea4" rows="3">{{ $slider->discription_en }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                    </div>
                                                    <div class="card-footer text-end">
                                                        <button class="btn btn-primary" type="submit">Изменить</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                </div>

                <button class="btn btn-xs btn-danger" type="button" data-bs-toggle="modal"
                    data-bs-target="#exampleModalCenter{{ $slider->id }}"><i class="bx bx-trash"></i>Удалить</button>
                <div class="modal fade" id="exampleModalCenter{{ $slider->id }}" tabindex="-1"
                    aria-labelledby="exampleModalCenter" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Удалить?</h5>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('dashboard.slider.destroy', $slider->id) }}" method="post">
                                    @csrf
                                    {{ method_field('delete') }}
                                    <button class="btn btn-primary" type="submit" data-bs-original-title=""
                                        title="">Да</button>
                                </form>
                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal"
                                    data-bs-original-title="" title="">Нет</button>
                            </div>
                        </div>
                    </div>
                </div>
                </td>
                </tr>
                @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection
