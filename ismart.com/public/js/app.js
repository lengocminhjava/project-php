$(document).ready(function () {
  $(".search_price").click(function () {
    var brand = $(".brand_data:checked").val();
    var price = $(".price_data:checked").val();
    $.ajax({
      url: "?mod=product&controller=index&action=ajax",
      method: "POST",
      data: { brand: brand, price: price },
      dataType: "json",
      success: function (data) {
        // $("ul.search").addClass('hiden');
        $("ul.search").html(data.output);
        $(".desc span.num_pr").html(data.num);
        //   console.log(data);
      },

      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
      },
    });
  });
  $("#select-city").change(function () {
    var id = $(this).val();
    console.log(id);
    $.ajax({
      url: "?mod=cart&controller=index&action=updateAjax",
      method: "POST",
      data: { id: id },
      dataType: "json",
      success: function (data) {
        console.log(data);
        $(".district").html(data.output);
      },
    });
  });
  // $(window).scroll(function(){
  //     var menu = $('.scroll_top');
  //     if($(window).scrollTop() == $(document).height - $(window).height()){
  //     }
  //     $.ajax({
  //         url: "?mod=product&controller=index&action=ajax",
  //         method:'POST',
  //         data:data,
  //         dataType:'json',
  //         success: function( data ){
  //             $("ul.search").addClass('hiden');
  //             $ul_product.html(data.output);
  //             $(".desc span.num_pr").html(data.num);
  //         //   console.log(data);
  //         },
  //         error: function (xhr, ajaxOptions,thrownError){
  //             alert(xhr.status);
  //             alert(thrownError)
  //         }
  //     });
  // });
  $(".num-order").change(function () {
    var id = $(this).attr("data-id");
    var qty = $(this).val();
    //    get_update_qty($_POST['qty']);
    var data = { id: id, qty: qty };

    $.ajax({
      url: "?mod=cart&controllers=index&action=update",
      method: "POST",
      data: data,
      dataType: "json",
      success: function (data) {
        $("#sub-total-" + id).text(data.sub_total);
        $("#qty-update-" + id).html(data.qty);
        $("#dest_update span").text(data.decs);
        $("#total-price span").text(data.total);
        $(".price_total span").text(data.total);
        $("span#num").text(data.decs);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
      },
    });
  });
});
