@extends('base')

@section('content')
    <div class="container">
    <form action="{{ $action }}" method="POST">
        {{csrf_field()}}
        @isset ($manInfo->id)
            <input type="hidden" name="id" value="{{$manInfo->id}}"/>
        @endif
        <div class="form-group">
            <label for="type">Название производителя</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') ? old('name') : isset($manInfo->name) ? $manInfo->name : ''}}" id="type" placeholder="Введите производителя">
            @if($errors->has('name')) <div class="text-danger">{{$errors->first('name')}}</div> @endif
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
    </div>
@endsection