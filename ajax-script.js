$('#next').on('click', function () {
    //rownum=$("#rownum").val();
    //colnum=$("#colnum").val();
    var coords=$("#coords").val()
    $.ajax({
        type: "GET",
        url: "display.php",
        cache:false,
        data: {ajax:'ajax',coords: coords},
        success: function (result) {
            
            $('#display_table').html(result);
        },
        error: function()
        {
            console.log('problem');
        }
    });
});
