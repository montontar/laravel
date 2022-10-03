$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){
    $('.del').click(function(evt){

        var name=$(this).data("name");
        var form=$(this).closest("form");
        evt.preventDefault();
        
        swal({
            title: `คุณต้องการลบ " ${name} " ใช่หรือไม่ ? `,
            text: "กรุณาตรวจสอบข้อมูลของคุณอีกครั้ง",
            icon: "warning",
            buttons: true,
            dangerMode:true
        }).then((willDelete)=>{
            if(willDelete){
                form.submit();
            }
        })
    });
});

$(document).ready(function(){
    $('.followwing').click(function(evt){

        var name=$(this).data("name");
        var form=$(this).closest("form");
        evt.preventDefault();
        
        swal({
            title: `ยกเลิกติดตามคุณ " ${name} " ใช่หรือไม่ ? `,
            text: "กรุณาตรวจสอบข้อมูลของคุณอีกครั้ง",
            icon: "warning",
            buttons: true,
            dangerMode:true
        }).then((willDelete)=>{
            if(willDelete){
                form.submit();
            }
        })
    });
});


// Modal_Save
$(document).ready(function(){
    $('.open_modal_add_contact').click(function(evt){
        evt.preventDefault();
        $('#btn-contact-add').val("บันทึก");
        $('#myModal_addcontact').modal('show');
    });
});

$(document).on('click','.open_modal_friendlist',function(){

    var url = "friendlist";
    var id=$(this).data("id");
    
    $.get(url + '/' + id, function (val) {
        //success data
        console.log(id);
        $('#id').val(val.id);
        $("input[name='username']").val(val.username);
        $("input[name='name']").val(val.name);
        $("input[name='email']").val(val.email);    
        // $("input[name='path']").val(data.path);
        $('#myModal_friendlist').modal('show');
    }) 
    $('#frmfriendlist').attr('action', url + '/' + id);
});

// Modal_Edit

$(document).on('click','.open_modalcontact_edit',function(evt){

    var url = "contact";
    var id=$(this).data("id");
    evt.preventDefault();
    $.get(url + '/' + id, function (data) {
        //success data
        console.log(id);
        $('#id').val(data.id);
        $("input[name='name']").val(data.name);
        $("input[name='email']").val(data.email);
        $("input[name='tel']").val(data.tel);
        $('#btn-contact-edit').val("บันทึก");
        $('#myModalContactEdit').modal('show');

    }) 
    $('#frmContact').attr('action', url + '/' + id);
});

$(document).on('click','.open_modaltodo_edit',function(){

    var url = "todolist";
    var id=$(this).data("id");
    $.get(url + '/' + id, function (data) {
        //success data
        console.log(id);
        $('#id').val(data.id);
        $("input[name='detail']").val(data.detail);
        // $("input[name='is_status']").val(data.is_status);
        $('#btn-todo-edit').val("บันทึก");
        $('#myModalTodoEdit').modal('show');
        
    }) 
    $('#frmTodolist').attr('action', url + '/' + id);
});

$(document).on('click','.open_modal_profile_edit',function(){
    var url = "profile";
    var id=$(this).data("id");
    $.get(url + '/' + id, function (data) {
        //success data
        console.log(id);
        $('#id').val(data.id);
        $("input[name='username']").val(data.username);
        $("input[name='name']").val(data.name);
        $("input[name='email']").val(data.email);
        // $("input[name='images']").val(data.images);
        $('#btn-edit-profile').val("บันทึก");
        $('#myModal_Profile_edit').modal('show');
    }) 
    $('#frmProfile').attr('action', url + '/' + id);
});






