
$(function(){
    $("#find_mobile").autocomplete({
        source: "http://localhost/Buy-hatke/find_mobile/get_mob" // path to the find_mobile method
    });
});

    /*$('#find_mobile').keydown(function(e){

        if (e.which == 13 || $(this).val().length < 1){
            $("#result_table").html("");
            var url = "find_mobile/showdata";
            if($("#find_mobile").val().length < 1)
                url = "find_mobile/showdatafull";
            $.ajax({
                url : url,
                type :'POST',
                dataType : 'json',
                data : {'find_mobile' : $("#find_mobile").val()},
                error: function(){
                    $('#result_table').append('<p>goodbye no data</p>');
                },

                success:function(data){
                    $("#data").html("");
//                    data = JSON.parse(data);
                    for(var i = 0; i < data.length; i++){
                        $("#result_table").append("<div class="+'col-sm-4'+"><div class="+'row'+"><div class="+'thumbnail left'+"><a href="+data[i].product_href+" target='_blank' ><img src="+data[i].product_imgsrc+"><div class="+'caption'+"> <h3>"+data[i].product_name+"</h3><p>"+data[i].product_price+".00</p><p>@"+data[i].product_source+"</p></div> </div></div> </div></a>");
                    }
//                    $("#result_table").html(data);
                } // End of success function of ajax form
            });
        }
        // End of ajax call
    });*/

$( document ).ready(function() {
    $("#data").html("");
    $.ajax({
        url : 'http://localhost/Buy-hatke/find_mobile/showdatafull',
        type :'POST',
        dataType : 'json',
        error: function(){
            $('#data').append('<p>goodbye no data</p>');
        },

        success:function(data){
//                    data = JSON.parse(data);
            for(var i = 0; i < 12; i++){
                $("#data").append("<div class="+'col-sm-4'+"><div class="+'row'+"><div class="+'thumbnail left'+"><a href="+data[i].product_href+" target='_blank' ><img src="+data[i].product_imgsrc+"><div class="+'caption'+"> <h4 class="+'text'+">"+data[i].product_name+"</h4><p>"+data[i].product_price+".00</p><p>@"+data[i].product_source+"</p></div> </div></div> </div></a>");
            }
                   $("#result_table").html("<label>Showing "+ i +" items of "+ data.length +"</label>");
        } // End of success function of ajax form
    });
});

$(window).scroll(function() {
    var x = $(window).scrollTop();
    if (x>20){
        $('.navbar-fixed-top').addClass('navbar-shadow');
    }
    else if (x == 0){
        $('.navbar-fixed-top').removeClass('navbar-shadow');
    }

});