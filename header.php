<?php
include ("functions.php");
$conn
?>


<?php
if (isset($_SESSION['uid'])) {
    ?>


    <!DOCTYPE html>
    <html>
        <head>
            <title>Δημιουργία νέου Meeting</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="js/jquery.min.js" type="text/javascript"></script>
            <script src="js/bootstrap.min.js" type="text/javascript"></script>
            <link rel="stylesheet" href="css/bootstrap.min.css"/>
            <link rel="stylesheet" href="css/edit.css"/>	
            <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
            <script type="text/javascript" src="js/jquery.timepicker.js"></script>
            <link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css" />
            <script type="text/javascript" src="lib/bootstrap-datepicker.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-rc1/jquery.min.js"></script>
            <link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker.css" />
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxIlVbCHNbS_I5iR5Qy8MHptycEM2xZXs&libraries=places"></script>

            <script type="text/javascript">
                google.maps.event.addDomListener(window, 'load', initilize);
                function initilize() {
                    var autocomplete = new google.maps.places.Autocomplete(document.getElementById('txtautocomplete'));
                    google.maps.event.addListener(autocomplete, 'place-changed', function () {
                        var place = autocomplete.getPlace();
                        var location = "<b> Address</b> : " + place.formatted_address + "<br/>";
                        document.getElementById('lblResult').innerHTML = location
                    });
                }
                ;
            </script>

            <script>
                $(document).ready(function () {
                    var i = 100;
                    $('#add_input').click(function () {
                        i++;
                        $('#date').append('<tr id="row' + i + '"><td><input type="date" name="date[]" min="<?php echo date('Y-m-d', strtotime("+2 day")); ?>" class="form-control"/></td><td><input type="time" name="time[]" class="form-control"/></td><td><button type="button" name="remove" id="' + i + '" class="btn btn_remove"><span class="glyphicon glyphicon-remove"></span></button></td></tr>');
                    });
                    $(document).on('click', '.btn_remove', function () {
                        var button_id = $(this).attr("id");
                        $('#row' + button_id + '').remove();
                    });
                    $('#submit').click(function () {
                        $.ajax({
                            url: "meetingschedule.php",
                            method: "POST",

                        });
                    });
                });
            </script>

            <script>
                $(document).ready(function () {
                    var m = 1;
                    $('#add_inputm').click(function () {
                        m++;
                        $('#email').append('<tr id="rowm' + m + '"><td><input class="form-control" placeholder="Contacts email" name="email[]" id="contact_email" type="text" title="Contacts email (format: xxx@xxx.xxx)"pattern="[a-zA-Z0-9!#$%&amp;*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+.([a-zA-Z]+)"></td><td><button type="button" name="remove" id="' + m + '" class="btn btn_remove"><span class="glyphicon glyphicon-remove"></span></button> </td></tr>');
                    });
                    $(document).on('click', '.btn_remove', function () {
                        var button_id = $(this).attr("id");
                        $('#rowm' + button_id + '').remove();
                    });
                    $('#submit').click(function () {
                        $.ajax({
                            url: "meetingschedule.php",
                            method: "POST",

                        });
                    });
                });
            </script>


        </head>
        <body>
            <div class="container">
                <nav class="navbar navbar-inverse">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand">Web Intelligence Meeting Scheduler</a>
                        </div>

                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php echo $_SESSION["disp_name"]; ?><span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="meetings.php"><span class="glyphicon glyphicon-home"></span>&nbsp; Αρχική</a></li>
                                        <li><a href="meetingschedule.php"><span class="glyphicon glyphicon-edit"></span>&nbsp; Meeting Scheduler</a></li>
                                        <li class="divider"></li>
                                        <li class="dropdown-header"><a href="logout.php"><span class="glyphicon glyphicon-off"></span>&nbsp; Έξοδος</a></li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                    </div>
                </nav>
                <?php
            } else {
                ?>
                <!DOCTYPE html>
                <html>
                    <head>
                        <title>Web Intelligence Meeting Scheduler</title>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <script src="js/jquery.min.js" type="text/javascript"></script>
                        <script src="js/bootstrap.min.js" type="text/javascript"></script>
                        <link rel="stylesheet" href="css/bootstrap.min.css"/>
                        <link rel="stylesheet" href="css/edit.css"/>
                    </head>
                    <body>
                        <div class="container">
                            <nav class="navbar navbar-inverse">
                                <div class="container-fluid">
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                        <a class="navbar-brand">Web Intelligence Meeting Scheduler</a>
                                    </div>

                                    <div id="navbar" class="navbar-collapse collapse">

                                        <form class="navbar-form navbar-right" role="form" method="POST" action="login.php">
                                            <div class="form-group has-feedback has-feedback-left" >
                                                <input type="text" placeholder="Email" class="form-control" name="email">
                                                <i class="glyphicon glyphicon-user form-control-feedback"></i>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <input type="password" placeholder="Κωδικός" class="form-control" name="password">
                                                <i class="glyphicon glyphicon-lock form-control-feedback"></i>
                                            </div>
                                            <!--<a href="profile.html" class="btn btn-primary">Sign In</a>-->
                                            <div class="form-group has-feedback">
                                                <input type="submit" class="btn btn-success form-control" name="login" value="Είσοδος">
                                                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </nav>
                            <div class="container-fluid">
                                <div id="img_button">
                                    <img src="https://www.opusmeetingrooms.com/wp-content/themes/office/images/bg/meeting_room_bkg-3.jpg" class="img-responsive">
                                    <div id="button">
                                        <p>Καλώς ήρθατε στον πιο Εξελιγμένο Meeting Scheduler του διαδικτύου</p>
                                        <a href="signup.php" class="btn btn-primary btn-lg">Εγγραφή</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>