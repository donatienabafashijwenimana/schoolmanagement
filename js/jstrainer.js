$(document).ready(function(){
    $("#add").click(function(){
        $('.inp').show()
    })
    
    $(".cansel").click(function(){
        $('.inp').hide()
    })

    $("#printt").click(()=>{
        $('img,.inp').hide()
        $("body").html($("#tabm"))
         var x = print();
    })
})