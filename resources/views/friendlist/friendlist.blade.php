@extends('layouts.index')
            <link rel="stylesheet" href=
            "https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
                    integrity=
            "sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
                    crossorigin="anonymous">
    <style>
                    /* Content of modal div is center aligned */
                    /**THE SAME CSS IS USED IN ALL 3 DEMOS**/    
            /**gallery margins**/  
            ul.gallery{    
            margin-left: 3vw;     
            margin-right:3vw;  
            }    

            .zoom {      
            -webkit-transition: all 0.35s ease-in-out;    
            -moz-transition: all 0.35s ease-in-out;    
            transition: all 0.35s ease-in-out;     
            cursor: -webkit-zoom-in;      
            cursor: -moz-zoom-in;      
            cursor: zoom-in;  
            }     

            .zoom:hover,  
            .zoom:active,   
            .zoom:focus {
            /**adjust scale to desired size, 
            add browser prefixes**/
            -ms-transform: scale(3.0);    
            -moz-transform: scale(3.0);  
            -webkit-transform: scale(3.0);  
            -o-transform: scale(3.0);  
            transform: scale(3.0);    
            /* position:relative;       */
            z-index:100;  
            }

            /**To keep upscaled images visible on mobile, 
            increase left & right margins a bit**/  
            @media only screen and (max-width: 1000px) {   
            ul.gallery {      
            margin-left: 15vw;       
            margin-right: 15vw;
            }

            /**TIP: Easy escape for touch screens,
            give gallery's parent container a cursor: pointer.**/
            .DivName {cursor: pointer}
            }
    </style>

<body class="g-sidenav-show   bg-gray-100">
  @section('content')

  <main class="main-content position-relative border-radius-lg">
  
    <!-- End Navbar -->
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card mb-6">
          
            <div class="card-header pb-0">
              <h4 class="text-uppercase  font-weight-bolder opacity-8">User List</h4>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
              <div class="container">
                    
                    <div>
                        <!-- <h5 style="text-align: left;"> รายการทั้งหมด {{ $data -> count() }} รายการ</h5> -->
                        <table class="table table-hover">
                            <thead>
                                <tr align="center">
                                    <th scope="col">ลำดับ</th>
                                    <th scope="col">Profile</th>
                                    <th scope="col">UserName</th>
                                    <th scope="col">E-Mail</th>
                                    <th scope="col" colspan="3" align="center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $number = 1; ?>
                                @foreach($data as $row)
                                <tr align="center">
                                    
                                    @if(Auth :: user()->id == $row->id) 
                                        <th scope="row" style="color: red; font-weight: bold;">{{($number)}}</th>
                                        <td align="" > 
                                            <a href="{{ Auth :: user()->getprofile() }}">
                                                <img src="{{ Auth :: user()->getprofile() }}" class="img-rounded zoom img-thumbnail img-responsive" style="display: cover; max-width: 25%; max-height: 25%;">
                                            </a>
                                        </td>
                                        <td align="center" style="color: red; font-weight: bold;" >{{$row->username}}</td>
                                        <td align="center" style="color: red; font-weight: bold;">{{$row->email}}</td>
                                        <td align="center">
                                            <button type="button"  class="btn btn-secondary" disabled="disabled">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                                    </svg>
                                                Follow
                                            </button>
                                        </td>
                                    @else 
                                        <th scope="row">{{($number)}}</th>
                                        <td align="" > 
                                            <a href="{{ $row->getprofile() }}">
                                                <img src="{{ $row->getprofile() }}" class="img-rounded zoom img-thumbnail img-responsive" style="display: cover; max-width: 25%; max-height: 25%;">
                                            </a>
                                        </td>
                                        <td align="center">{{$row->username}}</td>
                                        <td align="center">{{$row->email}}</td>
                                        <td align="center"> 
                                         
                                        @if( $row->Follows->isEmpty() )

                                       
                                            {!! Form::open(['action' => ['FriendListController@store',$row->id],'id' =>'frmfriendlist','name' =>'frmfriendlist','method' =>'POST', 'enctype' => 'multipart/form-data']) !!}
                                            @csrf
                                            
                                                <button type="submit"  class="btn btn-primary followw" id="follow" name="follow" value="{{$row->id}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                                                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                                        </svg>
                                                    Follow
                                                </button>
                                                {!! Form::close() !!}  
                                        @else   
                                            <form action="{{route('friendlist.destroy',$row->checkFollow($row->id)->id)}}" method="post">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-success followwing" data-id=" {{ $row->checkFollow($row->id)->id }}" data-name="{{$row->username}}" id="following" name="following" value="0">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-all" viewBox="0 0 16 16">
                                                            <path d="M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992a.252.252 0 0 1 .02-.022zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486-.943 1.179z"></path>
                                                        </svg>
                                                    Following
                                                </button> 
                                            </form>
                                                
                                        @endif 
                                                
                                         
                                        </td>
                                    @endif
                                    <td align="right">
                                            <input data-id="{{$row->id}}" type="submit" value="View" class="btn btn-warning btn-detail open_modal_friendlist"></input>
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

                    
                    <div class="modal fade" id="myModal_friendlist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="font-weight-bolder" align="center">{{ __('View Profile ') }}</h4>
                                </div>
                            {!! Form::open(['action' => ['FriendListController@update',Auth :: user()->id],'method' =>'PUT','id' =>'frmfriendlist','name' =>'frmfriendlist' , 'enctype' => 'multipart/form-data']) !!}
                            @csrf
                                <form id="frmfriendlist" name="frmfriendlist" class="form-horizontal" novalidate="">
                                    <div class="card-body">
                                        <div class="card-body col-12 "style="max-heigh: auto; border: 1px solid;" align="center">
                                            <h4 align="left">{{ __('Username ::') }} <input  type="text" name="username" style="border: none;" disabled="disabled"> </input></h4>
                                            <h4 align="left">{{ __('Name ::') }} <input  type="text" name="name" style="border: none;" disabled="disabled"> </input></h4>
                                            <h4 align="left">{{ __('E-Mail ::') }} <input  type="text" name="email" style="border: none;" disabled="disabled"></input></h4>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{url('/friendlist')}}" class="btn btn-detail btn-danger col-4"> ปิด </a>
                                    </div>
                                </form>
                            {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
              </div>

              @section('script')
                        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
                        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
                        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"crossorigin="anonymous"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"crossorigin="anonymous"></script>
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"crossorigin="anonymous"></script>

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
  </main>
  @endsection
</body>
