<?php 
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Home</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Logo</a> </p>
        </div>

        <div class="right-links">

            <?php 
            
            $id = $_SESSION['id'];
            $query = mysqli_query($con,"SELECT*FROM users WHERE Id=$id");

            while($result = mysqli_fetch_assoc($query)){
                $res_Uname = $result['Username'];
                $res_lastname = $result['lastname'];
                $res_Email = $result['Email'];
                $res_Password = $result['Password'];
                $res_id = $result['Id'];
                
            }
            
            echo "<a href='edit.php?Id=$res_id'>Reset Password</a>";
            ?>

            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>

        </div>
    </div>
    <main>

       <div class="main-box top">
          <div class="top">
            <div class="box">
                <p>Hello <b><?php echo $res_Uname ?></b>, Welcome</p>
            </div>
            <!--<div class="box">
                <p>Your email is <b><?php echo $res_Email ?></b>.</p>
            </div>-->
          </div>
          <div class="bottom">
            <!--<div class="box">
                <p>And your password is <b><?php echo $res_Password ?> </b>!</p> 
            </div>-->
            <head>
<title>FullCalendar</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js"></script>
<script>
    $(document).ready(function() {
      var calendarEvents = [
        // Add existing events 
      ];
    
      $('#calendar').fullCalendar({
        defaultDate: moment().format('YYYY-MM-DD'),
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: calendarEvents,
        customButtons: {
          addButton: {
            text: 'Add',
            click: function() {
              var title = prompt('Title:');
              var startDate = prompt('Start date (YYYY-MM-DD):');
              var endDate = prompt('End date(YYYY-MM-DD):');
              if (title && startDate) {
                var newEvent = {
                  title: title,
                  start: startDate,
                  end: endDate
                };
                calendarEvents.push(newEvent);
                $('#calendar').fullCalendar('renderEvent', newEvent, true); // Add event in calendar
              }
            }
          },
          homeButton: {
            text: 'Home',
            click: function() {
              window.location.href = 'register.php'; 
            }
          }
        },
        header: {
          left: 'prev,next today addButton,homeButton,editButton,deleteButton',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
        eventClick: function(calEvent, jsEvent, view) {
          // Popup
          var confirmEdit = confirm('Edit event?');
          if (confirmEdit) {
            // Edit
            var newTitle = prompt('New title:', calEvent.title);
            if (newTitle) {
              calEvent.title = newTitle;
              $('#calendar').fullCalendar('updateEvent', calEvent);
            }
          }
    
          var confirmDelete = confirm('Delete event?');
          if (confirmDelete) {
            // Delete
            $('#calendar').fullCalendar('removeEvents', calEvent._id);
          }
        }
      });
    });
    </script>
<style>
  a{
    text-decoration: none;
  }
  body {
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
  }
  #calendar {
    max-width: 900px;
    margin: 40px auto;
  }
  .fc-button {
    margin: 2px;
  }
</style>
<div id="calendar"></div>
          </div>
       </div>

    </main>
</body>
</html>