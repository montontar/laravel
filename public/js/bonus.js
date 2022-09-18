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

