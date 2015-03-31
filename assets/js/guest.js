/**
 * Created by DELL on 3/30/15.
 */

$(function(){

    var _onPage = 5;
    var validateEmail = function(email) {
        var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        return re.test(email);
    };

    var load_form = function(){
        $.ajax({
            type: "GET",
            url: "index_ajax.php",
            data: {
                faction:'getform'
            },
            complete:function(data){
                response_data = data.responseText;
                if(response_data!=""){
                    $("#gb_addform").html(response_data);
                    rebind_form();
                }else{
                    //console.log(response_data);
                }
            }
        });
    };

    /**
     * For Show result of action
     * @param key
     * @param message
     */
    var reset_form =  function(key,message)
    {
        if (key=='success')
        {
            $("#gb_alert")
                .html('<div class="alert alert-success" role="alert">' + message + '</div>')
                .fadeIn(900);
                cler_form();
        }
        else
        {
            $("#gb_alert")
                .html('<div class="alert alert alert-danger" role="alert">' + message + '</div>')
                .fadeIn(900);
        }

    };

    var cler_form = function()
    {
        $("#gb_addform input#name").val('');
        $("#gb_addform input#email").val('');
        $("#gb_addform textarea#message").val('');
    };

    /**
     * Rebind behaves of form
     *  Send message, reset form
     */
    var rebind_form = function(){
        $("#gb_add_button").unbind("click").bind("click", function(e){
            var error = new Array();

            var name = $("#name").val();
            if(!(name.length > 2))
                error.push('Имя должно быть более 3 символов!');

            var email = $("#email").val();
            if(!validateEmail(email))
                error.push('Э-Почта не правельно!');

            var message = $("#message").val();
            if(!(message.length > 4))
                error.push('Сообщения не может содержать менее 5 символов!');

            if(error.length>0)
            {
                reset_form('error', error.join("<br/>\n"))
            }
            else
            {

                $.ajax({
                    type: "POST",
                    url: "index_ajax.php",
                    data: {
                        name:name,
                        email:email,
                        message:message,
                        faction:'saveform'
                    },
                    complete:function(data){
                        response_data = data.responseText;
                        if(response_data=="success"){
                            reset_form('success','Сообщения оставленно успешно!')
                            build_list();
                        }else{
                            reset_form('error',response_data);
                        }
                    }
                });

            }
        });

        $("#gb_reset_button").unbind("click").bind("click", function(){
            cler_form();
            $("#gb_alert").empty();
        });
    };

    /**
     * Get count of messages and build pagination
     */
    var load_pagination = function(){
        $.ajax({
            type: "GET",
            url: "index_ajax.php",
            data: {
                faction:'getpagecount'
            },
            complete:function(data){
                response_data = data.responseText;
                if(parseInt(response_data / _onPage)>1){
                    var n = parseInt(response_data / _onPage) + ((response_data % _onPage > 0) ? 1 : 0);
                    $('#gb_pagination').empty();
                    $('<ul/>', {'class': 'pagination',id: 'gb_pages'}).appendTo('#gb_pagination');
                    for(i=1;i<=n;i++){
                        $('<li/>', {'class':(i==1?'active':''),id:i, html:'<a href="javascript:void(0);">' + i + '</a>'}).appendTo('#gb_pages');
                    }
                    load_list(1);
                    rebind_pagination();

                }else{
                    load_list(1);
                }
            }
        });

    };

    /**
     * Rebind behaves pagination elements
     */
    var rebind_pagination = function(){
        $("#gb_pages li").bind("click", function(){
            $(this).siblings().removeClass('active');
            $(this).addClass("active");
            load_list(parseInt($(this).attr("id")));
        });
    };

    /**
     * Load message start from $page
     * messages on page can set on top.. to _onPage constant.
     * @param page
     */
    var load_list = function(page){
        $.ajax({
            type: "GET",
            url: "index_ajax.php",
            data: {
                faction:'getlist',
                pid:0,
                page:page,
                onPage:_onPage,
                includeAnswers:0
            },
            complete:function(data){
                var html_message ='';
                var res = JSON.parse(data.responseText);
                if(typeof(res)=='object'){
                    $('#gb_messages').empty();
                    $('<ul/>', {'class': 'messages',id: 'gb_message_list'}).appendTo('#gb_messages');
                    $(res).each(function(index,element){
                        html_message = '<div class="user">' + element.name + '</div>';
                        html_message += '<div class="date">' + element.date + '</div>';
                        html_message += '<div class="text">' + element.message + '</div>';
                        if(parseInt(element.ANSWCNT) > 0)
                            html_message += '<div class="answers">' + element.ANSWCNT + '</div>';
                        $('<li/>', {'class': 'message',id: 'id_' + element.id, html:html_message}).appendTo('#gb_message_list');
                        html_message = '';
                    });

                    rebind_list();
                }
                else
                {
                    reset_form('error',res);
                }
            }
        });


    };

    /**
     * Rebind behaves element in message list
     *  -send private message
     *  -show profile
     *  -reply to message
     */
    var rebind_list = function(){


    };


    /**
     * Will build pagination and list of messages, also rebind events.
     */
    var build_list = function(){
        load_pagination();
        //rebind_pagination();
        //load_list();
        //rebind_list();
    };

    /**
     * Check of html elements and do some actions.
     */
    if($("#gb_gontainer").length > 0)
    {
        if($("#gb_addform").length > 0) {
            load_form();
        }
        if($("#gb_list").length > 0) {
            build_list();
        }

    }

});