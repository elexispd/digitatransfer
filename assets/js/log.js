$(document).ready(function(){

	  refresh();
	  random_numbers();

	 //makes the refresh spin
     function refresh(){
     	 $(".fa-refresh").click(function(){
            $(this).addClass('rotate');

            setTimeout(function() { 
                $('.rotate').removeClass('rotate');
            }, 2000);

            //clear out the answer input
            $('[name = "ans"]').val('');
        })
     }
    //generate numbers for answer
    function random_numbers(){
    	$(".fa-refresh").click(function(){
	     	var num1 = Math.random() * 9;
	     	var num2 =  Math.random() * 9;

	     	//inject the number to html
	     	$('.num1').text(Math.floor(num1));
	     	$('.num2').text(Math.floor(num2));

	    })
    }
     


})