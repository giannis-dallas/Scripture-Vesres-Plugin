jQuery(document).ready(function ($) {

$('.after-scripture-content input[type="submit"]').on('click',function (e) {
    console.log('start AJAX call');


    let message= $('article.scripture').html();
    let sender = $('#yourName').val();
    let recipient = $('#emailTo').val();
    
    var maildata = {
        'action': 'napsv_send_message',
        'name': sender,
        'email': recipient,
        'message': message
    };
    var ajaxurl = napsv_ajax_object.ajax_url
    console.log(maildata, ajaxurl);
    $.post(ajaxurl, maildata, function(response) {
        var result = $.parseJSON(response);
        if(result[1] === 'success'){
            alert('Message Sent Successfully!');
            $('.after-scripture-content input[type="email"]').val('');
            $('.after-scripture-content input[type="text"]').val('');
        }
    });
})

$('#SMSbutton').on('click',function (e) {

    var url= location.href;
    var title=$('.entry-title').text();
    var BlessedName= $('.blessed-name strong')[0];
    var Name= $(BlessedName).text();

    if (/[?&]myname=/.test(location.search)) {
    location.href="sms:?&body=" + title + ": " + url;
    }
    else
    { location.href="sms:?&body=" + title + ": " + url + encodeURIComponent("?myname=" + Name).replace(/%20/g, "_"); }

})


});