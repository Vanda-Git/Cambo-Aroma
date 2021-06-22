$(document).ready(function(){
    $('.btn_add').click(function(){
        var pro = $('.txt_product').val();
        if(pro==""){
            return;
        }
            $.ajax({url: "ajx_pro.php?id="+pro, success: function(result){
                
                $('.tbl_sale').append(result);
                // alert($('.txt_product option[value="'+pro+'"]').val());
                $('.txt_product option[value="'+pro+'"]').each(function() {
                    var tmp = '<option value="'+$(this).val()+'">'+$(this).html()+'</option>';
                    $('tr').last().find('#lbl_tmp_option').html(tmp);
                    setTimeout(function(){
                    },30);
                    $(this).remove();   
                    grand_total();             
                });
            
            }});
            
        count_row();
    });

    $('.btn_sell').click(function(){
    var rkhmer = parseFloat($('#recievekhmer').val())/4000;
    var dkhmer = parseFloat($('#recievedollar').val());
    var rt = rkhmer+dkhmer;
    var total = parseFloat($('#totaldollar').val());
        if(rt>=total){
            
        }
        else{
            event.preventDefault();
            alert("Sell Unseccefull")
        }
    
    
    
    
    
    // if((($('#recievekhmer').val()/4000)+$('#recievedollar').val())>=$('#totaldollar').val()){
    //     alert("hello");
    // }
    // else{
    //     alert("bye")
    // }
    });
});

function grand_total(){
    setTimeout(function(){
        var sum = 0;
        $('.lbl_amount').each(function(){
            sum +=parseFloat($(this).html());
        });
        $('.txt_total_usd').val(sum);
        $('.txt_total_khr').val(sum*4000);
        
        calculate_return();
    },50);

}

function calculate_return(){

    var rc_usd = parseFloat($('#recievedollar').val());
    var rc_khr = parseFloat($('#recievekhmer').val());
    var total_rc_usd = rc_usd + (rc_khr/4000);
    var grand_total = parseFloat($('.txt_total_usd').val());
    var cashback_usd = total_rc_usd - grand_total;

    $('.exchangedollar').val(cashback_usd);
    $('.exchangekhmer').val(cashback_usd*4000);
}

function count_row(){
    setTimeout(function(){
        var i = 1;
        $('table .lbl_no').each(function(){
            $(this).html(i++);
        });
    },50);
}

function calculate_qty(e){
    if($(e).val() < 1){
        $(e).val(1);
    }
    var unit_price = $(e).parents("tr").find('.lbl_price').html();
    var amount = parseFloat(unit_price)*parseInt($(e).val());
    $(e).parents("tr").find('.lbl_amount').html(amount);
    grand_total();
}

function remove_row(e){
    // alert($(e).parents("tr").find('#lbl_tmp_option').html());
    $('.txt_product').append($(e).parents("tr").find('#lbl_tmp_option').html());
    $(e).parents("tr").remove();
    count_row();
    grand_total();
}