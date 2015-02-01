<?php
    // we can get the number of the sender using the 'Fromn' request value
    $from = $_REQUEST['From'];
   
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
    <Message>Hello <?php echo $from ?>! Thanks for the message!</Message>
</Response>