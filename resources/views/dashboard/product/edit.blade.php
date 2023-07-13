@extends('layouts.dashboard.main')

@section('content')
    <div class="row">
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
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Добавить Продукты</h5>
                </div>
                {{-- @dd('asd') --}}
                <form action="{{ route('dashboard.product.update', $product) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('put') }}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div>
                                    <span>Бренды:</span>
                                    {{-- <i data-feather="loader" style="height: 100px; width: 100px" ></i> --}}
                                    <select class="" id="brend_id" class="calc__type" name="brend_id" id="calc__type"
                                        style="width: 100%; padding:6px 12px; border-color: #ced4da; border-radius: 5px ">
                                        @foreach ($brends as $brend)
                                            <option value="{{ $brend->id }}">{{ $brend->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div>
                                    <span>Категории :</span>
                                    {{-- <i data-feather="loader" style="height: 100px; width: 100px" ></i> --}}
                                    <select class="" id="category_id" class="calc__type" name="category_id"
                                        id="calc__type"
                                        style="width: 100%; padding:6px 12px; border-color: #ced4da; border-radius: 5px ">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name_ru }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="name">Название</label>
                                <input class="form-control" name="name" id="name" type="text" placeholder="..."
                                    value="{{$product->name}}">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Фото</label>
                                    {{-- <img class="mb-3" src="/issets/size.png" alt="" style="height: 84px; width: 150px"> --}}
                                    <input class="form-control" id="exampleFormControlInput1" type="file" name="photos[]"
                                        multiple>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="engine">Двигатель:</label>
                                <input class="form-control" name="engine" id="engine" type="text" placeholder="..."
                                    value="{{$product->engine}}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="reserve">Запас хода:</label>
                                <div class="input-group">
                                    <input class="form-control" name="reserve" id="reserve" type="text"
                                        placeholder="..." aria-describedby="inputGroupPrepend2" value="{{$product->reserve}}">
                                </div>
                            </div>
                            <div class="col-1">
                                <label class="form-label" for="name_en">Популярный</label>
                                <div class="input-group" style="font-size: 15px">
                                    <input type="checkbox" id="ok" @if ($product->ok == 1) @checked(true) @endif name="ok">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="capacity_uz">Емкость Uz</label>
                                <input class="form-control" name="capacity_uz" id="capacity_uz" type="text"
                                    placeholder="..." value="{{$product->capacity_uz}}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="capacity_ru">Емкость Ru</label>
                                <div class="input-group">
                                    <input class="form-control" name="capacity_ru" id="capacity_ru" type="text"
                                        placeholder="..." aria-describedby="inputGroupPrepend2" value="{{$product->capacity_ru}}">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="capacity_en">Емкость En</label>
                                <div class="input-group">
                                    <input class="form-control" name="capacity_en" id="capacity_en" type="text"
                                        placeholder="..." aria-describedby="inputGroupPrepend2" value="{{$product->capacity_en}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="unit_uz">Привод Uz</label>
                                <input class="form-control" name="unit_uz" id="unit_uz" type="text"
                                    placeholder="..." value="{{$product->unit_uz}}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="unit_ru">Привод Ru</label>
                                <div class="input-group">
                                    <input class="form-control" name="unit_ru" id="unit_ru" type="text"
                                        placeholder="..." aria-describedby="inputGroupPrepend2" value="{{$product->unit_ru}}">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="unit_en">Привод En</label>
                                <div class="input-group">
                                    <input class="form-control" name="unit_en" id="unit_en" type="text"
                                        placeholder="..." aria-describedby="inputGroupPrepend2" value="{{$product->unit_en}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="price_uz">Стоимость: Uz</label>
                                <input class="form-control" name="price_uz" id="price_uz" type="text"
                                    placeholder="..." value="{{$product->price_uz}}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="price_ru">Стоимость: Ru</label>
                                <div class="input-group">
                                    <input class="form-control" name="price_ru" id="price_ru" type="text"
                                        placeholder="..." aria-describedby="inputGroupPrepend2" value="{{$product->price_ru}}">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="price_en">Стоимость: En</label>
                                <div class="input-group">
                                    <input class="form-control" name="price_en" id="price_en" type="text"
                                        placeholder="..." aria-describedby="inputGroupPrepend2" value="{{$product->price_en}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Сохранить</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
@endsection
