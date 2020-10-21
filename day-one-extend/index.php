<?php
$user = 'root';
$password = '';
$database = 'open_timer';
$servername='localhost';
$conn = new mysqli($servername, $user,$password, $database);
$sql = "SELECT * FROM box_list";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Open Timerr</title>
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    <link href="style.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


  </head>
  <body>

  <div class="boxes">
    <?php
    $kbd_keys = array("A", "S", "D", "F", "G", "H", "J", "K", "L", "Z", "X", "C" ,"V" ,"B", "N", "M");
    $key_codes = array(65, 83, 68, 70, 71, 72, 74, 75, 76, 90, 88, 67, 86, 66, 78, 77);
    $i=0;

    while($rows=$result->fetch_assoc())
    {
    ?>
    <div data-key="<?php echo $key_codes[$i];?>"
      href="<?php echo $rows['box_url'];?>"
      target="_blank" class="box" style="background:<?php echo $rows['box_background'];?>"><!--#ff3333-->
      <!-- box_background is loading from DB, in-case this feature be needed in future -->
      <span class="cancel_box">&times;</span>

      <kbd><?php echo $kbd_keys[$i];?></kbd>
      <span class="title"><?php echo $rows['box_title'];?></span>
      <div id="total_time" style="display:block"><?php echo $rows['total_time'];?></div>
      <div class="stop_timer_btn" style="">STOP</div>

    </div>
    <?php
    $i++;
    }
    ?>

    <!--  add new box -->
    <div class="box" data-toggle="modal"data-target="#myModal">
        <kbd><i class="fas fa-plus"></i></kbd>
        <span class="">ADD</span>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add a new website</h4>
        </div>
        <div class="modal-body">
          <form action="add_website.php" method="post">
            <label for="box_title">Title :</label>
            <input class="do_not_follow_link" type="text" name="title" placeholder="Enter website title" required/><br><br>
            <label for="box_url">URL :</label>
            <input class="do_not_follow_link" type="url" name="url" placeholder="Enter website url" required/><br><br>
            <br><br>
            <input type="submit" value="Add Website" name="submit"/><br />
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>


  <script type="text/javascript">

  window.onbeforeunload = function() {
    return "Data will be lost if you leave the page, are you sure?";
  };

  var closeIcons = document.querySelectorAll('.cancel_box');
  for (var i = 0; i < closeIcons.length; i++) {
    closeIcons[i].addEventListener("click", function(e){
      let nextSibling_title = this.nextElementSibling.nextElementSibling.innerHTML;
      var confirmation_result=confirm("Remove the site \""+nextSibling_title+"\" ?");
      if(confirmation_result==true){}
      else return;
      $.ajax({
        type : "POST",  //type of method
        url  : "delete_website.php",  //your page
        data : {title : nextSibling_title},// passing the values
        success: function(res){ location.replace("index.php"); }
    });
    });
  }

  function hour_min_sec_format(seconds){
    var hour = Math.floor(seconds / 3600);
    var min = Math.floor((seconds % 3600) / 60);
    var sec = Math.floor((seconds % 3600) % 60);
    return hour+" : "+min+" : "+sec;
  }

  function follow_link(e){

  if(!e.target.classList.contains("do_not_follow_link")){
  let pressed_key = document.querySelector(`.box[data-key="${e.keyCode}"]`);
  //const pressed_key_url=document.querySelector(`.box[href="${e.keyCode}"]`);
  if (!pressed_key) return;
  href = pressed_key.getAttribute("href");

  pressed_key.style.background="red";// to active red background
  pressed_key.querySelector(".stop_timer_btn").style.display="block";
  //window.location.href = href;
  window.open(href, '_blank');
  //win.focus();

  let present_total_time=Number(pressed_key.querySelector("#total_time").innerText);
  setInterval(timer_func, 1000);// call timer function after every 1000ms

  function timer_func() {
  present_total_time = present_total_time + 1;
  pressed_key.querySelector("#total_time").innerText = hour_min_sec_format(present_total_time);
  $.ajax({
    type : "POST",  //type of method
    url  : "update_time_important.php",
    data : {
            title : pressed_key.querySelector(".title").innerText ,
            total_time : present_total_time
           }// passing the values
});
}
 }
}//function follow_link ends
  window.addEventListener("keydown",follow_link);

// Starts "STOP" div functionalities
  var all_stop_div=document.querySelectorAll(".stop_timer_btn");
  for (var i = 0; i < all_stop_div.length; i++) {
     all_stop_div[i].addEventListener("click", function(e) {
       this.style.display="none";
       //this.parentNode.classList.remove('active'); // to default box background
       this.parentNode.style.background='#999999';
     });
 }

  </script>

  </body>
</html>
