@extends('layouts.index')

<meta name="csrf-token" content="{{ csrf_token() }}">

<body class="g-sidenav-show   bg-gray-100">
  @section('content')

  <main class="main-content position-relative border-radius-lg">
  
    <!-- End Navbar -->
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card mb-6">
          
            <div class="card-header pb-0">
              <h4 class="text-uppercase  font-weight-bolder opacity-8">POST</h4>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
              <div class="container">
                    <div>
                        <table class="table table-hover">
                            <thead>
                                <tr align="center">
                                    <th scope="col">ลำดับ</th>
                                    <th scope="col">หัวข้อ</th>
                                    <th scope="col" colspan="2" align="center">จัดการ</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $number = 1; ?>
                                @foreach($posts as $post)
                                <tr align="center">
                                    <th scope="row">{{($number)}}</th>
                                    <td align="center">{{$post->title}}</td>
                                    <td align="center">
                                        <a href="{{ route('post.show', $post->id) }}" class="btn btn-outline-primary col-6">ดูโพส</a>
                                    </td>
                                </tr>
                                <?php $number++; ?>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- <div class="card-footer py-4"> -->
                            <div class="col"></div>
                            <div class="col-auto">
                                {{ $posts->links() }}
                            </div>
                        <!-- </div> -->
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

