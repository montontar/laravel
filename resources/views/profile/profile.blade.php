@extends('layouts.index')
   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
  @section('content')
  <main class="main-content position-relative border-radius-lg ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header mt 2" ><h2 align="center">{{ __('Profile') }}</h2></div>
                        <div class="card-body">
                            <div class="card-body col-12 " align="center">
                                <img src="{{ Auth::user()->getprofile() }}" class="col-10 img-thumbnail img-responsive" style="display: cover; max-width: 60%; max-height: 40%;">
                            </div>
                        </div>

                        <div class="card-footer">
                            <div>
                                <h4 >{{ __('Username ::') }}{{ Auth :: user()->username }}</h4>
                                <h4 >{{ __('Name ::') }}{{ Auth :: user()->name }}</h4>
                                <h4 >{{ __('E-Mail ::') }}{{ Auth :: user()->email }}</h4>
                            </div>
                            @csrf
                            <div align="right"><input class="btn btn-warning open_modal_profile_edit" type="submit" value="edit" data-id="{{ Auth :: user()->id }}"></input></div>
                        </div>
                </div>
            </div>
        </div>
    </div>
        <div class="modal fade" id="myModal_Profile_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="col-form-label font-weight-bolder">แก้ไข</h4>
                    </div>

                    {!! Form::open(['action' => ['ProfileController@update', Auth :: user()->id],'method' =>'PUT', 'id' =>'frmProfile','name' =>'frmProfile', 'enctype' => 'multipart/form-data']) !!}
                    <div class="modal-body">
                    <form id="frmProfile" name="frmProfile" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group error">
                                <div>
                                    <h4 class="col-sm-12 col-form-label ">{{ __('Username : ') }}<input type="text" class="form-control has-error" id="username" name="username" placeholder="กรอกรายละเอียด" value="{{ Auth :: user()->username }}">
                                    <h4 class="col-sm-12 col-form-label ">{{ __('Name : ') }}<input type="text" class="form-control has-error " id="name" name="name" placeholder="กรอกรายละเอียด" value="{{ Auth :: user()->name }}">
                                    <h4 class="col-sm-12 col-form-label ">{{ __('E-Mail : ') }}<input type="text" class="form-control has-error" id="email" name="email" placeholder="กรอกรายละเอียด" value="{{ Auth :: user()->email }}">
                                    <h4 class="col-sm-12 col-form-label " align="left">{{ __('รูปภาพ : ') }}
                                   
                                    <div>
                                        <input type="file" name="images"  id="images" > 
                                    </div>
                                </div>
                            </div>
                                <div class="modal-footer">
                                @csrf
                                    <input type="submit" class="btn btn-success" id="btn-edit-profile"  data-id="{{ Auth :: user()->id }}"></input>
                                    <a href="{{url('/profile')}}" class="btn btn-detail btn-danger"> ยกเลิก </a>
                                </div>
                    </form>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
  </main>
  @endsection
