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

$(document).on('click','.open_modal',function(){
    var url = "todolist";
    var id= $(this).val();
    $.get(url + '/' + id, function (data) {
        //success data
        console.log(data);
        $('#id').val(data.id);
        $('#detail').val(data.detail);
        $('#btn-save').val("บันทึก");
        $('#myModal').modal('show');
    }) 
});

$(document).on('click','.open_modal_edit',function(){
    var url = "contact";
    var id= $(this).val();
    $.get(url + '/' + id, function (data) {
        //success data
        console.log(data);
        $('#id').val(data.id);
        $('#name').val(data.name);
        $('#email').val(data.email);
        $('#tel').val(data.tel);
        $('#btn-edit').val("แก้ไข");
        $('#myModalEdit').modal('show');
    }) 
});

