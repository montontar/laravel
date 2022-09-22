@extends('layouts.index')
   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
  @section('content')
  <main class="main-content position-relative border-radius-lg ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                        <div class="card-header mt 2" ><h2 align="center">{{ __('Profile') }}</h2></div>
                            <div class="card-body">
                                <div class="card-body col-12 "style="border: 1px solid;" align="center">
                                    <h4 align="center">{{ __('img') }}</h4>
                                </div>
                            </div>

                        <div class="card-footer">
                            <div>
                                <h4 >{{ __('Name ::') }}{{ Auth :: user()->name }}</h4>
                                <h4 >{{ __('Username ::') }}{{ Auth :: user()->username }}</h4>
                                <h4 >{{ __('E-Mail ::') }}{{ Auth :: user()->email }}</h4>
                            </div>
                            @csrf
                            <div align="right"><input class="btn btn-warning btn-detail open_modal" type="submit" value="edit" ></input></div>
                        </div>
                </div>
            </div>
        </div>
    </div>
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="font-weight-bolder">แก้ไข</h4>
                                </div>

                                
                                <div class="modal-body">
                                    <form action="{{route('profile.update',Auth :: user()->id)}}" id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="" method="put">
                                        <div class="form-group error">
                                            <div class="col-sm-12">
                                            <h4 >{{ __('Name : ') }}<input type="text" class="form-control has-error " id="name" name="name" placeholder="กรอกรายละเอียด" value="{{ Auth :: user()->name }}">
                                            <h4 >{{ __('Username : ') }}<input type="text" class="form-control has-error" id="username" name="username" placeholder="กรอกรายละเอียด" value="{{ Auth :: user()->username }}">
                                            <h4 >{{ __('E-Mail : ') }}<input type="text" class="form-control has-error" id="email" name="email" placeholder="กรอกรายละเอียด" value="{{ Auth :: user()->email }}">
                                            <div align="right"><h4 align="left">{{ __('รูปภาพ : ') }}<input class="btn" type="file" value="Upload" id="images" name="images"></input></div>
                                        </div>
                                        </div>
                                            <div class="modal-footer">
                                            @csrf
                                                <input type="submit" class="btn btn-detail btn-success" id="btn-save"></input>
                                                <a href="{{url('/profile')}}" class="btn btn-detail btn-danger"> ยกเลิก </a>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
  </main>
  @endsection





