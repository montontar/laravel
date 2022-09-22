@section('content')
    <div class="container">
        @if ($errors->all())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        @endif
    {!! Form::open(['action' => ['TodoListController@update',$data->id],'method' =>'PUT']) !!}
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::text('detail',$data->detail,["class"=>"form-control"])!!}
                    <h3 class="ml-2">
                        <input type="hidden"  name="is_status" value="0" >
                        <input class="my-3" type="checkbox"  name="is_status" style="width: 1.2rem; height: 1.2rem;"
                        @if (old('is_status',$data->is_status)) checked @endif />

                    สำเร็จ </h3>
            </div>
            <input type="submit" value="บันทึก" class="btn btn-success">
            <a href="{{url('/todolist')}}" class="btn btn-danger"> ยกเลิก </a>
        </div>
    {!! Form::close() !!}


    </div>
@endsection