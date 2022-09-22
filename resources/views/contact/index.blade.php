@extends('layouts.index')

<body class="g-sidenav-show   bg-gray-100">
  @section('content')

  <main class="main-content position-relative border-radius-lg">
  
    <!-- End Navbar -->
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
            <h4 class="text-uppercase  font-weight-bolder opacity-8">ตารางแสดงข้อมูล</h4>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
              
            <div class="container">
                <h2 style="text-align: center;" class="mt-3"> ตารางแสดงข้อมูล </h2>
                <div align="right"><a  class="btn btn-primary btn-detail open_modal"> เพิ่มข้อมูล </a> </div>
                
                <table class="table table-hover">
                    <thead>
                        <tr align="center">
                            <th scope="col"></th>
                            <th scope="col">Name</th>
                            <th scope="col">E-Mail</th>
                            <th scope="col">Tel</th>
                            <th scope="col"></th>
                            <th scope="col"></th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php $number = 1; ?>
                        @foreach($data as $row)
                        <tr align="center"> 
                            <th scope="row">{{$number}}</th>
                            <td>{{$row->name}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->tel}}</td>
                            <td align="right">
                                <input type="submit" value="แก้ไข" class="btn btn-warning open_modal_edit"></input>
                            </td>
                            <td align="left">
                                <form action="{{route('contact.destroy',$row->id)}}" method="post">
                                    @csrf @method('DELETE')
                                    <input type="submit" value="ลบ" data-name="{{$row->name}}" class="btn btn-danger del"></input>
                                </form>
                            </td>
                        </tr>
                        <?php $number++; ?>
                        @endforeach
                        
                    </tbody>
                </table>
                            <div class="col"></div>
                            <div class="col-auto">
                                {{ $data->links() }}
                            </div>
            </div>

            <!-- Modal Add Data-->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="font-weight-bolder">เพิ่มข้อมูล</h4>
                        </div>

                        <div class="container" align="center">
                                @if ($errors->all())
                                    <ul class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <li>
                                                {{$error}}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            {!! Form::open(['action' => 'ContactController@store','method' =>'POST']) !!}
                                <div class="col-md-10" >
                                    <div class="form-group">
                                        {!! Form::label('NAME')!!}
                                        {!! Form::text('name',null,["class"=>"form-control"])!!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('EMAIL')!!}
                                        {!! Form::text('email',null,["class"=>"form-control"])!!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('TEL')!!}
                                        {!! Form::text('tel',null,["class"=>"form-control"])!!}
                                    </div>
                                    <div class="modal-footer" align="right" >
                                        <input type="submit" class="btn btn-success" id="btn-save"></input>
                                        <a href="{{url('/contact')}}" class="btn btn-danger"> ยกเลิก </a>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Data-->
            <div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="font-weight-bolder">แก้ไขข้อมูล</h4>
                        </div>

                            @if ($errors->all())
                                    <ul class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <li>
                                                {{$error}}
                                            </li>
                                        @endforeach
                                    </ul>
                            @endif

                        {!! Form::open(['action' => ['ContactController@update',$row->id],'method' =>'PUT']) !!}
                                <div class="modal-body">
                                    <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                        <div class="form-group error">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    {!! Form::label('NAME')!!}
                                                    {!! Form::text('name',$row->name,["class"=>"form-control"])!!}
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::label('EMAIL')!!}
                                                    {!! Form::text('email',$row->email,["class"=>"form-control"])!!}
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::label('TEL')!!}
                                                    {!! Form::text('tel',$row->tel,["class"=>"form-control"])!!}
                                                </div>
                                                <div class="modal-footer" align="right" >
                                                    <input type="submit" class="btn btn-success" id="btn-save" value="บันทึก"></input>
                                                    <a href="{{url('/contact')}}" class="btn btn-danger"> ยกเลิก </a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>

            @section('script')
                        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
                        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
                        <script>
                            $(document).ready( function () {
                                $('#table').DataTable(
                                    pageLength: 5, //จำนวนต่อหน้า
                                    lengthChange: false, //ไม่ต้องแสดงตัวเลือกจำนวนตรายการ่อหน้า
                                    bFilter: true, //แสดงกล่องค้นหา
                                    bInfo: true,   //แสดงข้อความ แสดง x ถึง x จาก x แถว
                                );
                            } );
                        </script>
            @endsection
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  @endsection
</body>

