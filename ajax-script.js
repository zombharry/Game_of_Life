function nextcoords(){

    //rownum=$("#rownum").val();
    //colnum=$("#colnum").val();
    $.ajax({
        type: "GET",
        url: "display.php",
        cache:false,
        data: {ajax:'ajax'},
        success: function (result) {
            
            $('#display_table').html(result);
            
        },
        error: function(xhr)
        {
            console.log(xhr.status);
        }
    });

}