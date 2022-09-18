@extends('layouts.app')
@section('content')
    <div class="container" align="center">
    <h2 style="text-align: center;"> เพิ่มข้อมูล </h2>
        @if ($errors->all())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        @endif
    {!! Form::open(['action' => ['ContactController@update',$data->id],'method' =>'PUT']) !!}
        <div class="col-md-6" >
            <div class="form-group">
                {!! Form::label('NAME')!!}
                {!! Form::text('name',$data->name,["class"=>"form-control"])!!}
            </div>
            <div class="form-group">
                {!! Form::label('EMAIL')!!}
                {!! Form::text('email',$data->email,["class"=>"form-control"])!!}
            </div>
            <div class="form-group">
                {!! Form::label('TEL')!!}
                {!! Form::text('tel',$data->tel,["class"=>"form-control"])!!}
            </div>
            <input type="submit" value="บันทึก" class="btn btn-warning">
            <a href="/contact" class="btn btn-success my-2"> กลับ </a>
        </div>
    {!! Form::close() !!}

        


    </div>
@endsection