@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create Student
    </div>

    <div class="card-body">
        <form action="{{ route("admin.students.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('student_id') ? 'has-error' : '' }}">
                <label for="name">Student ID*</label>
                <input type="text" id="id" name="student_id" class="form-control" required>
                @if($errors->has('student_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('student_id') }}
                    </em>
                @endif
                
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Student Name*</label>
                <input type="text" id="name" name="name" class="form-control" required>
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="name">Email*</label>
                <input type="text" id="email" name="email" class="form-control" required>
                @if($errors->has('email'))
                    <em class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </em>
                @endif
                
            </div>
            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                <label for="name">Phone*</label>
                <input type="text" id="phone" name="phone" class="form-control" required>
                @if($errors->has('phone'))
                    <em class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </em>
                @endif
                
            </div>
            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                <label for="name">Address*</label>
                <input type="text" id="address" name="address" class="form-control" required>
                @if($errors->has('address'))
                    <em class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </em>
                @endif
                
            </div>
            <div class="form-group {{ $errors->has('education') ? 'has-error' : '' }}">
                <label for="name">Education*</label>
                <input type="text" id="education" name="education" class="form-control" required>
                @if($errors->has('education'))
                    <em class="invalid-feedback">
                        {{ $errors->first('education') }}
                    </em>
                @endif
                
            </div>
            
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection