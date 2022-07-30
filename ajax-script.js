
var myAjax=function () {
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
};

var loopedAjaxHelper=function()
{
    var coords=$("#coords").val()
    if ($('#stop').attr('data-pressed')=='false') {
  
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
            },
            complete:function()
            {
                setTimeout(loopedAjaxHelper,1000)
            }
        });
}
    
}
var loopedAjax=function(){
    $('#stop').attr('data-pressed','false');
    loopedAjaxHelper();
}

$('#next').on('click', myAjax);

$('#auto').on('click', loopedAjax);

$('#stop').on('click', function () {
    
    $('#stop').attr('data-pressed','true')
    
});
