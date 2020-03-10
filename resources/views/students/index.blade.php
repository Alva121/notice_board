@extends('adminlte::page')

@section('title','AdminLTE')

@section('content_header')
    <h1></h1>
@stop
@section('content')
    <a href="{{route('students.create')}}" class="btn btn-success">Create</a>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>SI No.</th>
            <th>USN</th>
            <th>Name</th>
            <th>Ph no.</th>
            <th>Department</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @if(count($students))
            @foreach($students as $student)
                <tr>
                    <td>{{$student->id}}</td>
                    <td>{{$student->usn}}</td>
                    <td>{{$student->name}}</td>
                    <td>{{$student->phone}}</td>
                    <td>{{$student->department->dept}}</td>
                    <td><a href="{{route('students.edit',$student->id)}}" class="btn btn-primary btn-block">Edit</a></td>

                </tr>
            @endforeach
        @endif

        </tbody>
    </table>

@stop

