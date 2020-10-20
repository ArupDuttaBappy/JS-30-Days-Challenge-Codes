<?php

    $response = array();
    if($_SERVER['REQUEST_METHOD']!='POST'){
        $response['error'] = true;
        $response['message'] = "Invalid Request method";
        echo json_encode($response);
        exit();
    }

    if(!isset($_POST['title'])){
        $response['error'] = true;
        $response['message'] = "Required fields missing!";
        echo json_encode($response);
        exit();
    }

    require_once('dbconnect.php');

    $result = delete_a_category($_POST,$conn);

    if($result>0)
    {
        $response['error'] = false;
        $response['message'] = "Deleted successfully.";
    }
    else {
        $response['error'] = true;
        $response['message'] = "Operation failed. Please try again.";
    }

    //echo json_encode($response);


    function delete_a_category($post,$conn)
    {

        $title = trim(strip_tags($post['title']));
        $sql_del = "DELETE FROM `box_list` WHERE box_title=?";

        $stmt = $conn->prepare($sql_del);
        $stmt->bind_param("s",$title);
        $stmt->execute();
        //var_dump($stmt);
        $result=$stmt->affected_rows;

        return $result;
    }
 ?>
