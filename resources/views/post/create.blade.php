@extends('layouts.index')

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">สร้างโพส</div>
                <div class="card-body">

                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    
                    <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                        <div class="form-group">
                            @csrf
                            <label class="label">หัวข้อ: </label>
                            <input type="text" name="title"  placeholder="เพิ่มหัวข้อ ..." class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label class="label">เนื้อหา: </label>
                            <textarea name="body" rows="10" cols="30" class="form-control"  placeholder="เพิ่มเนื้อหา ..." required ></textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" name="images"  id="images" > 
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success col-2" value="โพส"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 