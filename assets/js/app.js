$(document).ready(function(){
        $('.account').hide();
        $('.billing').hide(); 

        // validation input pick up
        $("#next_1").click(function(){
            var first = $("[name = 'name']").val();
            var last = $("[name = 'l_name']").val();
            var email = $("[name = 'email']").val();
            var dob = $("[name = 'dob']").val();
            var addr = $("[name = 'addr1']").val();
            var city = $("[name = 'city']").val();
            var prov = $("[name = 'prov']").val();
            var zip = $("[name = 'zip']").val();
            var dial = $("[name = 'phone']").val();
            
            first_name(first);
            last_name(last) ;
            validateEmail(email) ;
            validateDob(dob);
            address(addr);
            validateCity(city) ;
            validateProv(prov);
            validateZip(zip);
            validateDial(dial);
            

            if (first_name(first) && last_name(last) && validateEmail(email) && validateDob(dob) && address(addr) && validateCity(city) && validateProv(prov) && validateZip(zip) && validateDial(dial)) {
                show_next('account','bar1', 'icon2');
            } 
        })



        $("#next_2").click(function(){
            var user = $("[name = 'username']").val();
            var pass = $("[name = 'password']").val();
            var c_pass = $("[name = 'c_password']").val();
            var comp = $("[name = 'company']").val();
            var doc_numb = $("[name = 'doc_numb']").val();


            username(user)
            password(pass) ;
            c_password(c_pass, pass) ;
            company(comp);
            doc_number(doc_numb) ; 

             if (username(user) && password(pass) && c_password(c_pass, pass) && company(comp) && doc_number(doc_numb) ) {
                show_next('billing','bar2','icon3');
            } 
        })

        /****************************************Forms********************************/
$("form#register").on("submit",function(){
    var that = $(this),
        url = that.attr("action"),
        type = that.attr("method"),
        data = {};
    that.find('[name]').each(function(index, value){
        var that = $(this),
            name = that.attr('name'),
            value = that.val();
            data[name] = value;
    });

    $.ajax({
        url: url,
        type: type,
        data: data,
        success: function(response){
            var resp = JSON.parse(response);
            var message = (resp["message"]);
            var status = resp["status"];
            alert(response);
            // if(status == "failed") {
            //     swal(status, message, "error");
            // } else if(status == "success") {
            //     swal(status, message, "success").then(function(){
            //         window.location = 'login.php';
            //     });
            // }
            // end of success
        }
    })

    return false;
})

$("form#login").on("submit",function(){
    var that = $(this),
        url = that.attr("action"),
        type = that.attr("method"),
        data = {};
    that.find('[name]').each(function(index, value){
        var that = $(this),
            name = that.attr('name'),
            value = that.val();
            data[name] = value;
    });

    $.ajax({
        url: url,
        type: type,
        data: data,
        success: function(response){
            var resp = JSON.parse(response);
            var message = (resp["message"]);
            var status = resp["status"];
            // alert(response)
            // console.log(message);
            if(status == 0) {
                swal("",message, "error");
            } else if(status == 1) {
                swal("", message, "success").then(function(){
                    window.location = '../dashboard/pages/index.php';
                });
            }
            // end of success
        }
    })

    return false;
})




        //  document ends
})



function show_next(next_class,bar, baricon)
{
    $('.personal').hide();
    $('.account').hide();
    $('.billing').hide();
    $("."+next_class).fadeIn();
    $("#"+bar).addClass('next');
    $('.'+baricon).addClass('active');
}

function show_prev(prev_class,bar, baricon)
{
   $('.personal').hide();
    $('.account').hide();
    $('.billing').hide();
    $("."+prev_class).fadeIn();
    $("#"+bar).removeClass('next');
    $('.'+baricon).removeClass('active');
}

//   form validation

function first_name(f_name){
    var regex = /^[a-zA-Z]+$/;
    if (f_name == '') {
        $('.c_name').text('Field Cannot be Empty');
        return false;
    } else if(!regex.test(f_name)) {
         $('.c_name').text('Only letter are required');
         return false;
    } else{
         $('.c_name').text('');
         return true;
    }
}

function last_name(l_name){
    var regex = /^[a-zA-Z]+$/;
    if (l_name == '') {
        $('.c_last').text('Field Cannot be Empty');
        return false;
    } else if(!regex.test(l_name)) {
         $('.c_last').text('Only letter are required');
         return false;
    } else{
         $('.c_last').text('');
         return true;
    }
}

 function validateEmail(email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if (email == '') {
         $('.c_email').text('Field Cannot be Empty');
         return false;
    } else if(!emailReg.test( email )){
         $('.c_email').text('Invalid email address');
         return false;
    } else {
         $('.c_email').text('');
         return true;
    }
}

function validateDob(dob) {
    if (dob == "") {
        $('.c_dob').text('choose  date of birth');
        return false;
    } else {
        $('.c_dob').text('');
        return true;
    }
}

function address(addr){
    if (addr == '') {
        $('.c_addr').text('Field Cannot be Empty');
        return false;
    }  else{
         $('.c_addr').text('');
         return true;
    }
}

function validateCity(city){
    var regex = /^[a-zA-Z]+$/;
    if (city == '') {
        $('.c_city').text('Field Cannot be Empty');
        return false;
    } else if(!regex.test(city)) {
         $('.c_city').text('Only letter are required');
         return false;
    } else{
         $('.c_city').text('');
         return true;
    }
}

function validateProv(prov){
    var regex = /^[a-zA-Z]+$/;
    if (prov == '') {
        $('.c_prov').text('Field Cannot be Empty');
        return false;
    } else if(!regex.test(prov)) {
         $('.c_prov').text('Only letter are required');
         return false;
    } else{
         $('.c_prov').text('');
         return true;
    }
}
function validateZip(zip){
    var regex = /^[0-9]+$/;
    if (zip == '') {
        $('.c_zip').text('Field Cannot be Empty');
        return false;
    } else if(!regex.test(zip)) {
         $('.c_zip').text('Invalid zip code');
         return false;
    } else{
         $('.c_zip').text('');
         return true;
    }
}
function validateDial(dial){
    var regex = /^[0-9+]+$/;
    if (dial == '') {
        $('.c_phone').text('Field Cannot be Empty');
        return false;
    } else if(!regex.test(dial)) {
         $('.c_phone').text('Invalid Phone number');
         return false;
    } else{
         $('.c_phone').text('');
         return true;
    }
}

function username(user){
    var regex = /^[a-zA-Z0-9_]+$/;
    if (user == '') {
        $('.c_username').text('Field Cannot be Empty');
        return false;
    } else if(!regex.test(user)) {
         $('.c_username').text('Only letters, digits and underscore are allowed');
         return false;
    } else{
         $('.c_username').text('');
         return true;
    }
    
}

function password(pass){
    if (pass == '') {
        $('.c_pass').text('Field Cannot be Empty');
        return false;
    }  else{
         $('.c_pass').text('');
         return true;
    }
}

function c_password(pass1, pass2){
    if (pass1 == '') {
        $('.c_cpass').text('Field Cannot be Empty');
        return false;
    } else if(pass1 != pass2){
        $('.c_cpass').text('password does not match');
        return false;
    }  else{
         $('.c_cpass').text('');
         return true;
    }
}

function company(com){
    if (com == '') {
        $('.c_com').text('Field Cannot be Empty');
        return false;
    }  else{
         $('.c_com').text('');
         return true;
    }
}

function doc_number(num){
    var regex = /^[a-zA-Z0-9]+$/;
    if (num == '') {
        $('.c_num').text('Field Cannot be Empty');
        return false;
    } else if(!regex.test(num)) {
         $('.c_num').text('Invalid entry');
         return false;
    } else{
         $('.c_num').text('');
         return true;
    }
}

function bill_address(addr){
    if (addr == '') {
        $('.c_baddr').text('Field Cannot be Empty');
        return false;
    }  else{
         $('.c_baddr').text('');
         return true;
    }
}

function bill_zip(zip){
    var regex = /^[0-9]+$/;
    if (zip == '') {
        $('.c_bcode').text('Field Cannot be Empty');
        return false;
    } 
    // else if(!regex.test(zip)) {
    //      $('.c_bcode').text('Invalid poster code');
    //      return false;
    // } 
    else{
         $('.c_bcode').text('');
         return true;
    }
}
function bill_prov(prov){
    var regex = /^[a-zA-Z]+$/;
    if (prov == '') {
        $('.c_bprov').text('Field Cannot be Empty');
        return false;
    } else if(!regex.test(prov)) {
         $('.c_bprov').text('Only letter are required');
         return false;
    } else{
         $('.c_bprov').text('');
         return true;
    }
}
function bill_city(city){
    var regex = /^[a-zA-Z]+$/;
    if (city == '') {
        $('.c_bcity').text('Field Cannot be Empty');
        return false;
    } else if(!regex.test(city)) {
         $('.c_bcity').text('Only letter are required');
         return false;
    } else{
         $('.c_bcity').text('');
         return true;
    }
}
