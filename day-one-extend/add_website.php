<?php

    $response = array();
    if($_SERVER['REQUEST_METHOD']!='POST'){
        $response['error'] = true;
        $response['message'] = "Invalid Request method";
        echo json_encode($response);
        exit();
    }

    if(!isset($_POST['title']) || !isset($_POST['url']) ){
        $response['error'] = true;
        $response['message'] = "Required fields missing!";
        echo json_encode($response);
        exit();
    }

    require_once('dbconnect.php');

    $result = insert_a_category($_POST,$conn);

    if($result>0)
    {
        $response['error'] = false;
        $response['message'] = "Inserted successfully.";
    }
    else {
        $response['error'] = true;
        $response['message'] = "Operation failed. Please try again.";
    }

    //echo json_encode($response);


    function insert_a_category($post,$conn)
    {

        $title = trim(strip_tags($post['title']));
        $url = trim(strip_tags($post['url']));

        $sql_sec = "INSERT INTO `box_list`(`box_title`, `box_url`) VALUES (?,?)";

        $stmt = $conn->prepare($sql_sec);
        $stmt->bind_param("ss",$title,$url);
        $stmt->execute();
        //var_dump($stmt);
        $result=$stmt->affected_rows;

        return $result;
    }
 ?>
<script>
//alert("going to index");
location.replace("index.php");
</script>
