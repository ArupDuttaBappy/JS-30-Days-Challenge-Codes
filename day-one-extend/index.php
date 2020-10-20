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
    <link rel="stylesheet" href="style.css">
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
      target="_blank" class="box">
      <span class="cancel_box">&times;</span>

      <kbd><?php echo $kbd_keys[$i];?></kbd>
      <span class="title"><?php echo $rows['box_title'];?></span>

    </div>
    <?php
    $i++;
    }
    ?>

    <!--  add new box -->
    <div class="box" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">
        <kbd><i class="fas fa-plus"></i></kbd>
        <span class="title">ADD</span>
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

  <!-- <script>
  var myVar = setInterval(myTimer, 1000);

  function myTimer() {
    var d = new Date();
    document.getElementById("demo").innerHTML = d.toLocaleTimeString();
  }
  </script> -->

  <script type="text/javascript">

  var closeIcons = document.querySelectorAll('.cancel_box');
  for (var i = 0; i < closeIcons.length; i++) {
    closeIcons[i].addEventListener("click", function(e){
      let nextSibling_title = this.nextElementSibling.nextElementSibling.innerHTML;
      var confirmation_result=confirm("Remove the site \""+nextSibling_title+"\" ?");
      //
      // $sql_delete = "DELETE FROM `box_list` WHERE `box_title`=`nextSibling_title`";
      // $conn->query($sql_delete);
      //
      if(confirmation_result==true){}
      else return;
      $.ajax({
        type : "POST",  //type of method
        url  : "delete_website.php",  //your page
        data : {title : nextSibling_title},// passing the values
        success: function(res){
                 location.replace("index.php");
                }
    });
    });
  }

  function follow_link(e){
  //if(!(e.target.getAttribute('type') == "text"  ||   e.target.getAttribute('type') == "url")){
  if(!e.target.classList.contains("do_not_follow_link")){
  const pressed_key = document.querySelector(`.box[data-key="${e.keyCode}"]`);
  if (!pressed_key) return;
  href = pressed_key.getAttribute("href");
  //window.location.href = href;
  window.open(href, '_blank');
  //win.focus();
}
  }
  window.addEventListener("keydown",follow_link);

  </script>

  </body>
</html>
