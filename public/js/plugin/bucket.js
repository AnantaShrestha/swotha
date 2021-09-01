console.log("wishList js loaded")

$(document).on('click', '.wsh', (function (e) {
    if (e.originalEvent.defaultPrevented) return;
    var id = $(this).attr('id');
    var active = $(this).attr('data-name');
    $.ajax({
        type: 'post',
        url: '/addwish',
        data: {
            '_token': $('input[name=_token]').val(),
            'id': id
//                    'name': $('input[name=name]').val()
        },
        success: function (data) {
            // alert(data);
            console.log(data)
            // $('#count').html(data[0]);
            // if (data.message) {
            // swal(
            //     'Warning',
            //     data.message,
            //     'warning'
            // )
            // }
            if(data.message){
                swal('Warning',data.message,'warning');
            }
            $('#' + data[1]).removeClass('wsh');
            $('#' + data[1]).removeClass('teal');
            $('#' + data[1]).addClass('rmv');
            $('#' + data[1]).addClass('red');

            var anchorElement = $('#' + data[1]);
            anchorElement.attr('data-title', data[2]);
            //anchorElement.tooltip();
        }
    });

}));
$(document).on('click', '.red', (function (e) {
//            alert("Hey there");
    console.log('hello remove');
    var id = $(this).attr('id');
    if (e.originalEvent.defaultPrevented) return;
    $.ajax({

        type: 'post',
        url: '/remove',
        data: {
//                    '_method': 'post',
            '_token': $('input[name=_token]').val(),
            'id': id
//                    'name': $('input[name=name]').val()
        },
        success: function (data) {
            // alert(data.join(' '));
            // $('#count').html(data[0]);
            $('#' + data[1]).removeClass('rmv');
            $('#' + data[1]).removeClass('red');
            $('#' + data[1]).addClass('wsh');
            $('#' + data[1]).addClass('teal');

            var anchorElement = $('#' + data[1]);
            anchorElement.attr('data-title', data[2]);
            //anchorElement.tooltip();
            // alert('mohaanaaa');
        }
    });
}));

