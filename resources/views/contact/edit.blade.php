@extends('layouts.index')
   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
  @section('content')
  <main class="main-content position-relative border-radius-lg ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header mt 2" ><h2 align="center">{{ __('แก้ไขข้อมูล') }}</h2></div>
                        <div class="card-body">
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
                            
                        </div>
                    {!! Form::close() !!}
                    </div>
                        </div>

                        <div class="card-footer">
                            <div>
                                <input type="submit" value="บันทึก" class="btn btn-success">
                                <a href="/contact" class="btn btn-success my-2"> กลับ </a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
  </main>
  @endsection
</body>