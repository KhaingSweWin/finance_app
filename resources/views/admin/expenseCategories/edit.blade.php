@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.expenseCategory.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.expense-categories.update", [$expenseCategory->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.expenseCategory.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($expenseCategory) ? $expenseCategory->name : '') }}" required>
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.expenseCategory.fields.name_helper') }}
                </p>
            </div>
            <div class="form-groupd">
                <select name="parent" id="" class="form-control">
                    <option value="0">No Parent</option>
                    @foreach($parent_categories as $parent)
                        @if($parent->id==$expenseCategory->parent)
                            <option value="{{$parent->id}}" selected>{{ $parent->name}}</option>
                        @else
                            <option value="{{$parent->id}}">{{$parent->name}}</option>
                        @endif
                        
                    @endforeach
                    

                </select>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection