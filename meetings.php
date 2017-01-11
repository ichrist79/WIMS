<?php
session_start();
include("header.php");
?>
<div class="jumbotron">
    <p class="text-center" id="welcome">Καλώς ήρθες <?php echo $_SESSION['disp_name']; ?> </p>
    <h1><span class="glyphicon glyphicon-briefcase"></span> Meetings</h1>
    <div class="btn-group col-sm-12">    
        <button class="btn btn-primary col-sm-4" type="button" onClick="getActive();"><span class="glyphicon glyphicon-hdd"></span>&nbsp; Αρχείο δημιουργηθέντων Meetings</button>
        <button class="btn btn-primary col-sm-4" type="button"  onClick="getVote();" ><span class="glyphicon glyphicon-inbox"></span>&nbsp; Meetings προς ψήφιση</button>
        <button class="btn btn-primary col-sm-4" type="button"  onClick="getFinalMeeting();" ><span class="glyphicon glyphicon-ok"></span>&nbsp; Meetings που θα παραστώ</button>
    </div>
    <br><br/>
    <div class="tab-content" id="tab_example"></div>
</div>

</body>
<script>
    function hide() {
        $("#welcome").fadeOut(5000);
    }

    function getActive() {

        jQuery.ajax({
            url: "active.php",
            type: "POST",
            success: function (data) {
                $('#tab_example').html(data);
            }
        });
    }

    function getActiveHide() {
        getActive();
        hide();
    }

    window.onload = getActiveHide;

    function getVote() {

        jQuery.ajax({
            url: "pending.php",
            type: "POST",
            success: function (data) {
                $('#tab_example').html(data);
            }
        });
    }

    function vote($id_event) {

        jQuery.ajax({
            url: "vote.php",
            type: "POST",
            data: {id_event: $id_event},
            success: function (data) {
                $('#tab_example').html(data);
            }
        });
    }

    function participate($id_event) {

        jQuery.ajax({
            url: "participate.php",
            type: "POST",
            data: {id_event: $id_event},
            success: function (data) {
                $('#tab_example').html(data);
            }
        });
    }

    function getFinal($id_event) {

        jQuery.ajax({
            url: "final.php",
            type: "POST",
            data: {id_event: $id_event},
            success: function (data) {
                $('#tab_example').html(data);
            }
        });
    }

    function stopVote($id_event) {

        jQuery.ajax({
            url: "showLastVote.php",
            type: "POST",
            data: {id_event: $id_event},
            success: function (data) {
                $('#tab_example').html(data);
            }
        });

    }

    function getFinalMeeting() {

        jQuery.ajax({
            url: "participateMeetings.php",
            type: "POST",
            success: function (data) {
                $('#tab_example').html(data);
            }
        });
    }
</script>
</html>
<?php
include("footer.php");
?>