<?php
$connect = new PDO("mysql:host=localhost;dbname=luckiejoe_chat;charset=utf8mb4", "luckiejoe_chat", "13Aps&Sa");
function fetch_user_last_activity($user_id, $connect) {
    $query = "SELECT * FROM login_details WHERE user_id = '$user_id' ORDER BY last_activity DESC LIMIT 1";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row) return $row['last_activity'];
}
function count_unseen_message($from_user_id, $to_user_id, $connect) {
    $query = "SELECT * FROM chat_message WHERE from_user_id = '$from_user_id' AND to_user_id = '$to_user_id' AND status = '1'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    $output = '';
    if($count > 0) $output = '<span class="badge badge-primary ml-1">'.$count.'</span>';
    return $output;
}
function fetch_user_chat_history($from_user_id, $to_user_id, $connect) {
    $query = "SELECT * FROM chat_message WHERE (from_user_id = '".$from_user_id."' AND to_user_id = '".$to_user_id."') OR (from_user_id = '".$to_user_id."' AND to_user_id = '".$from_user_id."') ORDER BY timestamp DESC";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '<ul class="list-group">';
    foreach($result as $row) {
        $user_name = '';
        $dynamic_class='';
        $chat_message='';
        if($row["from_user_id"] == $from_user_id) {
            if($row["status"] == '2') {
                $chat_message = '<em>This message has been removed</em>';
                $dynamic_class = 'list-group-item-danger';
            } else {
                $chat_message = htmlspecialchars($row["chat_message"]);
                $user_name = '<button class="close remove_chat" id="'.$row["chat_message_id"].'">&times;</button><p>You</p>';
                $dynamic_class = 'list-group-item-success';
            }
        } else {
            if($row["status"] == '2') $chat_message = '<em>This message has been removed</em>';
            else $chat_message = htmlspecialchars($row["chat_message"]);
            $user_name = '<b class="text-danger">'.get_user_name($row['from_user_id'], $connect).'</b>';
            $dynamic_class = 'list-group-item-primary';
        }
        $output .= '<li class="list-group-item '.$dynamic_class.'">
            <div class="row">
                <div class="col-2">
                    <div class="d-flex justify-content-between align-items-start">'.$user_name.'</div>
                </div>
                <div class="col-6"></div>
                <div class="col-4"><small>'.$row['timestamp'].'</small></div>
            </div>
            <b>'.$chat_message.'</b>
          </li>';
    }
    $output .= '</ul>';
    $query = "UPDATE chat_message SET status = '0' WHERE from_user_id = '".$to_user_id."' AND to_user_id = '".$from_user_id."' AND status = '1'";
    $statement = $connect->prepare($query);
    $statement->execute();
    return $output;
}
function get_user_name($user_id, $connect) {
    $query = "SELECT username FROM login WHERE user_id = '$user_id'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row) return $row['username'];
}
function fetch_is_type_status($user_id, $connect) {
    $query = "SELECT is_type FROM login_details WHERE user_id = '".$user_id."' ORDER BY last_activity DESC LIMIT 1";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach($result as $row)
        if($row["is_type"] == 'yes')
            $output = ' <small><em><span class="text-muted">Typing...</span></em></small>';
    return $output;
}