@extends('layouts.index')

  @section('content')
  <main class="main-content position-relative border-radius-lg ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                
                    <div class="card-header" ><h2 align="center">{{ __('เข้าสู่ระบบสำเร็จ') }}</h2></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h4 align="center">{{ __('ยินดีต้อนรับคุณ ::') }}{{ Auth :: user()->username }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </main>
  @endsection





