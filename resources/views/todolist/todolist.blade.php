@extends('layouts.app')
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
    {!! Form::open(['action' => 'TodoListController@store','method' =>'POST']) !!}
        <div class="col-12">
            <div class="form-group">
                    <input type="text" name="detail"  class="form-control col-md-6">
                    <input type="submit" value="ADD" class="btn btn-primary col-md-2">
                    <!-- {!! Form::text('detail',null,["class"=>"form-control col-md-6"])!!} -->
                
            </div>
        </div>
    {!! Form::close() !!}

        <div>
            <h2 style="text-align: center;"> รายการที่ต้องทำ {{count($data)}} รายการ</h2>

            <table class="table table-hover">
                <thead>
                    <tr align="center">
                        <th scope="col"></th>
                        <th scope="col">รายละเอียด</th>
                        <th scope="col">สถานะ</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody>
                    <?php $number = 1; ?>
                    @foreach($data as $row)
                    <tr align="center">
                        <th scope="row">{{$number}}</th>
                        <td align="center">{{$row->detail}}</td>
                        <td align="center">
                            @if ($row->is_status == "on")
                                <p class="alert alert-success" align="center"> สำเร็จแล้ว </p>
                            @endif
                            <!-- <input type="checkbox" disable="true" style="width: 1.2rem; height: 1.2rem;" name="is_status" class="switch-input" value="{{$row->is_status}}" {{ $row->is_status == 1 ? 'checked' : null }}/> -->
                        </td>
                        <td align="right">
                            <a href="{{route('todolist.edit',$row->id)}}" class="btn btn-warning"> แก้ไข </a>
                        </td>
                        <td align="left">
                            <form action="{{route('todolist.destroy',$row->id)}}" method="post">
                                @csrf @method('DELETE')
                                <input type="submit" value="ลบ" data-name="{{$row->detail}}" class="btn btn-danger del"></input>
                            </form>
                        </td>
                    </tr>
                    <?php $number++; ?>
                    @endforeach
                </tbody>
            </table>

        </div>


    </div>
@endsection