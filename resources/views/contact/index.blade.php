@extends('layouts.app')
@section('content')

        <div class="container">
            <h2 style="text-align: center;"> ตารางแสดงข้อมูล </h2>
            <a href="/contact/create" class="btn btn-primary my-2"> เพิ่มข้อมูล </a>
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
                    @foreach($data as $row)
                    <tr align="center"> 
                        <th scope="row">{{$row->id}}</th>
                        <td>{{$row->name}}</td>
                        <td>{{$row->email}}</td>
                        <td>{{$row->tel}}</td>
                        <td align="right">
                            <a href="{{route('contact.edit',$row->id)}}" class="btn btn-warning"> แก้ไข </a>
                        </td>
                        <td align="left">
                            <form action="{{route('contact.destroy',$row->id)}}" method="post">
                                @csrf @method('DELETE')
                                <input type="submit" value="ลบ" data-name="{{$row->name}}" class="btn btn-danger del"></input>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

@endsection