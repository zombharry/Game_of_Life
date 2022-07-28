$(document).ready(function () {
    $('#next').on('click', function () {
        rownum=$("#rownum").val();
        colnum=$("#colnum").val();
        
        $.ajax({
            type: "GET",
            url: "display.php",
            cache:false,
            data: {rownum:rownum,colnum:colnum},
            success: function (result) {
                $('#display_table').html(result);
                rownum=undefined;
                
                console.log(rownum);
                
            }
        });    
    });
    
});