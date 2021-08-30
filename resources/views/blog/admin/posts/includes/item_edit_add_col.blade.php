<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </div>
</div>
<br>
@if($item->exists)
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="">
                            ID: {{ $item->id }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="" class="">Созданно</label>
                        <input type="text" disabled value="{{ $item->created_at }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="">Изменено</label>
                        <input type="text" disabled value="{{ $item->updated_at }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="">Опубликовано</label>
                        <input type="text" disabled value="{{ $item->published_at }}" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
