

<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<!-- <h2>Notification Form</h2> -->
<form id="notification_form" method="post" action=""  onsubmit="return false">  
Notification Title: <input type="text" name="notification_title" value="" required>
  <br><br>
  Notification Body: <textarea name="notification_story" rows="5" cols="40" required></textarea>
  <br><br>
Notification Link: (sample https://google.com or rknews://news/details/4476)<input type="link" name="notification_link"  >
Notification Image: (sample https://www.rkproduction.co.in/uploads/rkproduction/1584370031.jpg) <input type="link" name="notification_image" >
Notification Topic:<input type="link" name="notification_topic"  value="News" required>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

</body>
<script>

$(function(){
    $("#notification_form").submit(function(){
        dataString = $("#notification_form").serialize();
        currentPostRequest = $.ajax({
            type: "POST",
            url: "https://www.rkproduction.co.in/console/notifications",
            data: dataString,
            success: function(data){
                data = JSON.parse(data);
                // console.log(data);

                if(data.status=="success"){
                    alert(data.message)
                    location.reload(true);
                }
                // $("#result").html('Successfully updated record!'); 
                // $("#result").addClass("alert alert-success");
            }

        });

        return false;

    });
});
</script>
</html>
