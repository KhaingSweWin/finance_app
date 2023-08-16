@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create Registeration
    </div>

    <div class="card-body">
        <form action="{{ route("admin.registrations.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('student_id') ? 'has-error' : '' }}">
                <label for="name" class='form-label'>Student ID*</label>
                <select name="student_id" id="" class='form-control'>
                    <option value="">Please Select Student</option>
                    @foreach ($students as $student)
                        <option value="{{$student->id}}">{{$student->name}}({{$student->student_id}})</option>
                    @endforeach
                </select>
                
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Program Name*</label>
                <select name="program_id" id="" class='form-control'>
                    <option value="">Please Select Program</option>
                    @foreach ($programs as $program)
                        <option value="{{$program->id}}">{{$program->name}}</option>
                    @endforeach
                </select>
                
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="name">Registeration*</label>
                <input type="date" id="email" name="registered_at" class="form-control" required>
               
                
            </div>
            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                <label for="name">Year*</label>
                <select name="year" id="" class='form-control'>
                    <option value="year1">Year I</option>
                    <option value="year2">Year II</option>
                   
                </select>
                
                
            </div>
            
            
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection