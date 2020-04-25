$(document).ready(function(e) {
    fetch_user();
    setInterval(function(){
        update_last_activity();
        fetch_user();
        update_chat_history_data();
    }, 3000);
    function fetch_user() {
        $.ajax({
            url:"../parts/fetch_user.php",
            method:"POST",
            success:function(data) {
                $('#user_details').html(data);
            }
        })
    }
    function update_last_activity() {
        $.ajax({
            url:"../parts/update_last_activity.php",
            success:function() {

            }
        })
    }
    function make_chat_dialog_box(to_user_id, to_user_name) {
        var modal_content ='<div class="card" id="user_dialog_'+to_user_id+'">' +
            '<div class="card-header">' +
                '<h4>Chat with '+to_user_name+'</h4>' +
            '</div>' +
            '<div class="card-body">' +
                '<div style="min-height:100px; max-height:400px; overflow-y: scroll;" class="chat_history mb-3" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">'+fetch_user_chat_history(to_user_id)+'</div>' +
                '<div class="form-group">' +
                    '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control chat_message"></textarea>' +
                '</div>' +
                '<div class="form-group" align="right">' +
                    '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Send message</button>' +
                '</div>' +
            '</div>' +
        '</div>';
        $('#user_model_details').html(modal_content);
    }
    $(document).on('click', '.start_chat', function() {
        var to_user_id = $(this).data('touserid');
        var to_user_name = $(this).data('tousername');
        make_chat_dialog_box(to_user_id, to_user_name);
        $('#chat_message_'+to_user_id).emojioneArea({
            pickerPosition: "top",
            toneStyle: "bullet"
        });
    });
    function send_message() {
        var to_user_id = $(this).attr('id');
        var chat_message = $('#chat_message_'+to_user_id).val();
        $.ajax({
            url:"../parts/insert_chat.php",
            method:"POST",
            data:{to_user_id:to_user_id, chat_message:chat_message},
            success:function(data) {
                var element = $('#chat_message_'+to_user_id).emojioneArea();
                element[0].emojioneArea.setText('');
                $('#chat_history_'+to_user_id).html(data);
            }
        });
    }
    $(document).on('click', '.send_chat', send_message);
    function fetch_user_chat_history(to_user_id) {
        $.ajax({
            url:"../parts/fetch_user_chat_history.php",
            method:"POST",
            data:{to_user_id:to_user_id},
            success:function(data) {
                $('#chat_history_'+to_user_id).html(data);
            }
        })
    }
    function update_chat_history_data() {
        $('.chat_history').each(function() {
            var to_user_id = $(this).data('touserid');
            fetch_user_chat_history(to_user_id);
        });
    }
    $(document).on('focus', '.chat_message', function() {
        var is_type = 'yes';
        $.ajax({
            url:"../parts/update_is_type_status.php",
            method:"POST",
            data:{is_type:is_type},
            success:function() {
            }
        })
    });
    $(document).on('blur', '.chat_message', function() {
        var is_type = 'no';
        $.ajax({
            url:"../parts/update_is_type_status.php",
            method:"POST",
            data:{is_type:is_type},
            success:function() {
            }
        })
    });
    $(document).on('click', '.remove_chat', function() {
        var chat_message_id = $(this).attr('id');
        if(confirm("Are you sure you want to remove this chat?")) {
            $.ajax({
                url:"../parts/remove_chat.php",
                method:"POST",
                data:{chat_message_id:chat_message_id},
                success:function(data) {
                    update_chat_history_data();
                }
            })
        }
    });
});