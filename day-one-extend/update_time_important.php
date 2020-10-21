<?php
require_once('dbconnect.php');
update_time_second_by_second($_POST,$conn);

function update_time_second_by_second($post,$conn)
{
    $total_time = trim(strip_tags($post['total_time']));
    $title = trim(strip_tags($post['title']));

    $sql_del = "UPDATE `box_list` SET `total_time`=? WHERE `box_title`=?";
    $stmt = $conn->prepare($sql_del);
    $stmt->bind_param("ss",$total_time,$title);
    $stmt->execute();
}

?>
