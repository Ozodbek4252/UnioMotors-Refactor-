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
                <div class="card-header">
                    <h5>Все Продукты</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Фото</th>
                                <th scope="col">Название</th>
                                <th scope="col">Бренды</th>
                                <th scope="col">Категория</th>
                                <th scope="col">Характеристики</th>
                                <th scope="col">Данные</th>
                                <th scope="col" class="text-center">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($k = 1)
                            @foreach ($products as $product)
                                <tr>
                                    <th scope="row">{{ $k }}</th>
                                    <td><img src="{{ $product->photos[0] }}" alt=""
                                            style="height: 100px; width: 200px">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    @if ($product->brends != null)
                                        <td>{{ $product->brends->name }}</td>
                                    @endif
                                    @if ($product->brends == null)
                                        <td>
                                            <h3>Null</h3>
                                        </td>
                                    @endif
                                    @if ($product->categories != null)
                                        <td>{{ $product->categories->name_ru }}</td>
                                    @endif
                                    @if ($product->categories == null)
                                        <td>
                                            <h3>Null</h3>
                                        </td>
                                    @endif
                                    <td class="text-center"><a
                                            href="{{ route('dashboard.charactric.index', $product) }}"><button
                                                class="btn btn-primary">+</button></a></td>
                                    <td class="text-center"><a
                                        href="{{ route('dashboard.data.index', $product) }}"><button
                                            class="btn btn-primary">+</button></a></td>
                                    <td class="text-center">

                                    <a href="{{ route('dashboard.product.edit', $product->slug) }}">
                                        <button class="btn btn-xs btn-success mb-1">Изменить
                                            <i class="bx bx-pencil"></i>
                                        </button>
                                    </a>
                                    <button class="btn btn-xs btn-danger" type="button" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalCenter{{ $product->id }}"><i
                                            class="bx bx-trash"></i>Удалить</button>
                                    <div class="modal fade" id="exampleModalCenter{{ $product->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalCenter" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Удалить?</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('dashboard.product.destroy', $product) }}"
                                                        method="post">
                                                        @csrf
                                                        {{ method_field('delete') }}
                                                        <button class="btn btn-primary" type="submit"
                                                            data-bs-original-title="" title="">Да</button>
                                                    </form>
                                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal"
                                                        data-bs-original-title="" title="">Нет</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                                @php($k++)
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
