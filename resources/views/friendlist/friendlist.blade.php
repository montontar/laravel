@extends('layouts.index')

<body class="g-sidenav-show   bg-gray-100">
  @section('content')

  <main class="main-content position-relative border-radius-lg">
  
    <!-- End Navbar -->
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card mb-6">
          
            <div class="card-header pb-0">
              <h4 class="text-uppercase  font-weight-bolder opacity-8">รายการที่ต้องทำ</h4>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
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
                    @csrf
                                <div class="form-group mt-3" align="right">
                                    <input  type="text" name="detail"  class="form-control col-6"  placeholder="กรอกรายละเอียด">
                                </div>
                                <div class="form-group" align="right">
                                <input  type="submit" value="เพิ่ม" class="btn btn-primary col-2 mb-3">
                                </div>
                    {!! Form::close() !!}

                    <div>
                        <h5 style="text-align: left;"> รายการทั้งหมด {{ $data -> count() }} รายการ</h5>
                        <table class="table table-hover">
                            <thead>
                                <tr align="center">
                                    <th scope="col">ลำดับ</th>
                                    <th scope="col">รายละเอียด</th>
                                    <th scope="col">สถานะ</th>
                                    <th scope="col" colspan="2" align="center">จัดการ</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $number = 1; ?>
                                @foreach($data as $row)
                                <tr align="center">
                                    <th scope="row">{{($number)}}</th>
                                    <td align="center">{{$row->detail}}</td>
                                    <td align="center">
                                        @if ($row->is_status == "on")
                                            <p style="background-color:lime; border-radius: 100px; width: 100px;" align="center"> สำเร็จแล้ว </p>
                                        @endif
                                    </td>
                                    <td align="right">
                                            <input type="submit" value="แก้ไข" class="btn btn-warning btn-detail open_modal"></input>
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

                        <!-- <div class="card-footer py-4"> -->
                            <div class="col"></div>
                            <div class="col-auto">
                                {{ $data->links() }}
                            </div>
                        <!-- </div> -->
                    </div>

                    
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="font-weight-bolder">แก้ไข</h4>
                                </div>

                                {!! Form::open(['action' => ['TodoListController@update',$row->id],'method' =>'PUT']) !!}
                                @csrf
                                <div class="modal-body">
                                    <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                        <div class="form-group error">
                                            <div class="col-sm-8">
                                            {!! Form::text('detail',$row->detail,["class"=>"form-control"])!!}
                                                <!-- <input type="text" class="form-control has-error" id="detail" name="detail" placeholder="กรอกรายละเอียด" value=""> -->
                                                <h3 class="ml-2">
                                                <input type="hidden"  name="is_status" value="0" >
                                                <input type="checkbox"  name="is_status" style="width: 1.2rem; height: 1.2rem;"
                                                @if (old('is_status',$row->is_status)) checked @endif />
                                                สำเร็จ </h3>
                                            </div>
                                        </div>
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-detail btn-success" id="btn-save"></input>
                                                <a href="{{url('/todolist')}}" class="btn btn-detail btn-danger"> ยกเลิก </a>
                                            </div>
                                    </form>
                                </div>
                                {!! Form::close() !!}

                            </div>
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
