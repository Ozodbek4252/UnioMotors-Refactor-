<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Добавить слово </h5>
                </div>
                    <div class="card-body">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="col-form-label pt-0" for="exampleInputPassword1">Ключ</label>
                                <input class="form-control" id="exampleInputPassword1" type="text" placeholder="..." @if($edit == 0) wire:model="key" @endif>
                                @if($edit == 0) @error('key') <span class="error" style="color: red">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="col-form-label pt-0" for="exampleInputPassword1">Текст RU</label>
                                <input class="form-control" id="exampleInputPassword1" type="text" placeholder="..." wire:model="word_ru">
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label pt-0" for="exampleInputPassword1">Текст UZ</label>
                                <input class="form-control" id="exampleInputPassword1" type="text" placeholder="..." wire:model="word_uz">
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label pt-0" for="exampleInputPassword1">Текст EN</label>
                                <input class="form-control" id="exampleInputPassword1" type="text" placeholder="..." wire:model="word_en">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" type="button" wire:click="store()">Сохранить</button>
                    </div>
            </div>
        </div>
    </div>

    {{--All Categories--}}
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Все слова</h5>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ключ</th>
                            <th scope="col">Текст RU</th>
                            <th scope="col">Текст UZ</th>
                            <th scope="col">Текст EN</th>
                            <th scope="col">Действия </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($k=1)
                        @foreach($words as $word)
                            <tr>
                                <th scope="row">{{ $k }}</th>
                                <td>
                                    @if($edit != $word->id)
                                        {{ $word->key }}
                                    @else
                                        <input class="form-control" type="text" wire:model="key">
                                        @if($edit != 0) @error('key') <span class="error" style="color: red">{{ $message }}</span> @enderror @endif
                                    @endif
                                </td>
                                <td>
                                    @if($edit != $word->id)
                                        {{ $word->word_ru }}
                                    @else
                                        <input class="form-control" type="text" wire:model="word_edit_ru">
                                    @endif
                                </td>
                                <td>
                                    @if($edit != $word->id)
                                        {{ $word->word_uz }}
                                    @else
                                        <input class="form-control" type="text" wire:model="word_edit_uz">
                                    @endif
                                </td>
                                <td>
                                    @if($edit != $word->id)
                                        {{ $word->word_en }}
                                    @else
                                        <input class="form-control" type="text" wire:model="word_edit_en">
                                    @endif
                                </td>
                                <td>
                                    @if($edit != $word->id)
                                        <button class="btn btn-success btn-xs" type="button" wire:click="edit({{ $word->id }})">
                                            изменить
                                        </button>
                                    @else
                                        <button class="btn btn-warning btn-xs" type="button" wire:click="update({{ $word->id }})">
                                            сохранить
                                        </button>
                                    @endif
                                    <button class="btn btn-danger btn-xs" type="button" wire:click="destroy({{ $word->id }})">
                                        удалить
                                    </button>
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
</div> 