<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="gcm server push notification storing">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GCM Server</title>
        <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <?php
        include_once 'UserManager.php';
        $users = UserManager::getAll();
        $no_of_users = 0;
        if ($users != false)
            $no_of_users = mysql_num_rows($users);
        ?>
        <div class="container">
            <h3>No of Devices Registered: <?php echo $no_of_users; ?></h3>
            <hr/>
            <div class="devices">
                <?php
                if ($no_of_users > 0) {
                    ?>
                    <?php
                    while ($row = mysql_fetch_array($users)) {
                        ?>
                            <div class="span3 device">
                                <form class="form-horizontal" id="<?php echo $row["id"] ?>" name="" method="post" onsubmit="return sendPushNotification('<?php echo $row["id"] ?>')">
                                    <div class="control-group">
                                    <label class="control-label"><?php echo $row["email"] ?></label>
                                    <textarea rows="3" name="message" placeholder="Type message here"></textarea>
                                    </div>
                                    <div class="control-group">
                                        <input type="hidden" id="regId" name="regId" value="<?php echo $row["gcm_regid"] ?>"/>
                                        <input type="submit" class="btn btn-primary" value="Send" onclick=""/>
                                        <input type="button" class="btn" value="Remove" onclick="removeUser('<?php echo $row["id"] ?>')" />
                                    </div>
                                </form>
                            </div>
                    <?php }
                } else { ?>
                    No Users Registered Yet!
                <?php } ?>
            </div>
        </div>
        <script src="http://code.jquery.com/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
            });
            function sendPushNotification(id){
                var data = $('form#'+id).serialize();
                $('form#'+id).unbind('submit');
                $.ajax({
                    url: "send_message.php",
                    type: 'POST',
                    data: data,
                    beforeSend: function() {
                    },
                    success: function(data, textStatus, xhr) {
                        $('form#'+id).find('.txt_message').val("");
                    },
                    error: function(xhr, textStatus, errorThrown) {
                    }
                });
                return false;
            }
            function removeUser(id){
                var regId = $('form#'+id).find('input').first().val();
                $.ajax({
                    url: "unregister.php",
                    type: 'POST',
                    data: 'regId='+regId,
                    beforeSend: function() {
                        $('form#'+id).parent().remove();
                    },
                    success: function(data, textStatus, xhr) {
                        
                    },
                    error: function(xhr, textStatus, errorThrown) {
                    }
                });
                return false;
            }
        </script>
    </body>
</html>