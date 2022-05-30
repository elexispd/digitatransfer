$("form#withdraw").on("submit", function(){
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

            if(status == 0) {
                swal("", message, "error");
            } else if (status == 1) {
                swal("", message, "success");
            }
            // end of success
        }
    })

    return false;
})
