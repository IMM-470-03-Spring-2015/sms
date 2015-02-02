<?php
 
    // make an associative array of senders we know, indexed by phone number
    $phonebook = array(
        "+12152642459"=>"Me",
    );

    $name = "fella";
 
    // if the sender is known, then greet them by name
    // otherwise, consider them just another monkey
    if(isset($phonebook[$_REQUEST['From']])) {
        $name = $phonebook[$_REQUEST['From']];
    }
 
    // now greet the sender
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
    <Message>Hey <?php echo $name ?>, thanks for the message!</Message>
</Response>
