$(document).ready(function() {
    $('.nav-link.active .sub-menu').slideDown();
    // $("p").slideUp();
    $('#sidebar-menu .arrow').click(function() {
        $(this).parents('li').children('.sub-menu').slideToggle();
        $(this).toggleClass('fa-angle-right fa-angle-down');
    });
    $("input[name='checkall']").click(function() {
        var checked = $(this).is(':checked');
        $('.table-checkall tbody tr td input:checkbox').prop('checked', checked);
    });
    $('#sidebar-menu li').click(function(){
        // $(this).children('.sub-menu').slideToggle();
        // $(this).addClass('active');
    })
        $("tr td span.status:contains('Hoàn thành')").css({'background-color':'#82CD47','color':'#FFFFFF','padding':'15px 5px'});
        $("tr td span.status:contains('Đơn hủy')").css({'background-color':'#434242','color':'#FFFFFF','padding':'15px'});
        $("tr td span.status:contains('Đang xử lí')").css({'padding':'15px 7px'});
        $("tr td span.status:contains('Công khai')").css({'background-color':'#82CD47','color':'#FFFFFF','padding':'10px 5px'});
        $("tr td span.status:contains('Không công khai')").css({'background-color':'#ffc107','color':'#181D31','padding':'10px 5px'});
    $('.fimlName').change(function(e){
        e.preventDefault();
        // alert('ok');
        let value = $(this).val();
        var current = $(this).parents('tr');
        // console.log(value);
        let id = $(this).attr('id');
        // console.log(id);
        var data = {value:value,id:id};
        let url  = "?mod=post&controller=index&action=updateAjax";
        $.ajax({
            type:"GET",
            url:url,
            data:data,
            dataType:"text",
            success: function(data){
                // alert('ok');
            //    console.log(data);
            // alert('ok');
            current.notify("Cập nhật thành công");
            }
        })
    });
});