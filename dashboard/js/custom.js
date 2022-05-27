	// sweet alert for rank
    $(".rank").click(function(){
		swal("Unavailable!", "This feature is coming soon", "info")
	})
    

	$(".card").click(function(){
		$("#procedure").modal({backdrop: 'static', keyboard: false});
	})
	$(".p1").click(function(){
        $(".plan").val(100);
		$(".selected h4").html("&euro; 100");
	})
	$(".p2").click(function(){
		$(".plan").val(500);
		$(".selected h4").html("&euro; 500");
	})
	$(".p3").click(function(){
		$(".modal .plan").val(1000);
		$(".selected h4").html("&euro; 1000");
	})

    $("#proceed").click(function(){
        $("#procedure").hide();
        $("#buy-modal").modal({backdrop: 'static', keyboard: false});
    })

// form validation
$('.second').hide();
$('.bit').hide();
$('.eth').hide();
$('.tron').hide();
$("#next1").on("click", function(){
    var coin = $("input[name ='method_of_pay']:checked").val()
	if (!$("input[name ='method_of_pay']:checked").val()) {
        $('#err').text("No selection has been made");
    } else {
       $('.first').hide();
       $('.second').show();

       if (coin == "btc") {
        $('.bit').show();
       } else if(coin =='usdt') {
        $('.eth').show();
       } else if(coin == 'tron') {
        $('.tron').show();
       }
    }

	 // if (first_name(first) && last_name(last) && validateEmail(email) && address(addr)&& validateProv(prov) && validateZip(zip) && validateDial(dial)) {
	 // 		$("#exampleModal").hide();
  //           $("#buy-modal").modal({backdrop: 'static', keyboard: false});
  //     } 
})

$("form#invest").on("submit", function(){
    // var that = $(this),
    //     url = that.attr("action"),
    //     type = that.attr("method"),
    //     data = {};
    // that.find('[name]').each(function(index, value){
    //     var that = $(this),
    //         name = that.attr('name'),
    //         value = that.val();
    //         data[name] = value;
    // });

    // $.ajax({
    //     url: url,
    //     type: type,
    //     data: data,
    //     success: function(response){
    //         var resp = JSON.parse(response);
    //         var message = (resp["message"]);
    //         var status = resp["status"];

    //         if(status == "failed") {
    //             swal(status, message, "error");
    //         } else if(status == "success") {
    //             swal(status, message, "success").then(function(){
    //                 window.location = 'login.php';
    //             });;
    //         }
    //         // end of success
    //     }
    // })

    // return false;
})


// function first_name(f_name){
//     var regex = /^[a-zA-Z]+$/;
//     if (f_name == '') {
//         $('.c_name').text('Field Cannot be Empty');
//         return false;
//     } else if(!regex.test(f_name)) {
//          $('.c_name').text('Only letter are required');
//          return false;
//     } else{
//          $('.c_name').text('');
//          return true;
//     }
// }
// function last_name(l_name){
//     var regex = /^[a-zA-Z]+$/;
//     if (l_name == '') {
//         $('.c_last').text('Field Cannot be Empty');
//         return false;
//     } else if(!regex.test(l_name)) {
//          $('.c_last').text('Only letter are required');
//          return false;
//     } else{
//          $('.c_last').text('');
//          return true;
//     }
// }
// function validateEmail(email) {
//   	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
//     if (email == '') {
//          $('.c_email').text('Field Cannot be Empty');
//          return false;
//     } else if(!emailReg.test( email )){
//          $('.c_email').text('Invalid email address');
//          return false;
//     } else {
//          $('.c_email').text('');
//          return true;
//     }
// }
// function address(addr){
//     if (addr == '') {
//         $('.c_addr').text('Field Cannot be Empty');
//         return false;
//     }  else{
//          $('.c_addr').text('');
//          return true;
//     }
// }
// function validateZip(zip){
//     var regex = /^[0-9]+$/;
//     if (zip == '') {
//         $('.c_zip').text('Field Cannot be Empty');
//         return false;
//     } else if(!regex.test(zip)) {;
//          $('.c_zip').text('Invalid zip code')
//          return false;
//     } else{
//          $('.c_zip').text('');
//          return true;
//     }
// }
// function validateDial(dial){
//     var regex = /^[0-9+]+$/;
//     if (dial == '') {
//         $('.c_phone').text('Field Cannot be Empty');
//         return false;
//     } else if(!regex.test(dial)) {
//          $('.c_phone').text('Invalid Phone number');
//          return false;
//     } else{
//          $('.c_phone').text('');
//          return true;
//     }
// }
// function validateProv(prov){
//     var regex = /^[a-zA-Z]+$/;
//     if (prov == '') {
//         $('.c_prov').text('Field Cannot be Empty');
//         return false;
//     } else if(!regex.test(prov)) {
//          $('.c_prov').text('Only letter are required');
//          return false;
//     } else{
//          $('.c_prov').text('');
//          return true;
//     }
// }
// $("#extra").hide();
// $('.metho').change(function(){
// 	var value = $(this).val();
// 	if (value == "balance") {
// 		$("#extra").show();
// 	} else {
// 		$("#extra").hide();
// 	}
// })


// statistics disable inputs
$("#new_stat input[type = 'text']").keypress(function(e){
	e.preventDefault();
})
