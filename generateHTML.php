<?php
    include 'class.php';

    $myForm = new Form();
    $myForm->input('test','testtest','text');
    $myForm->select('testSelect',array('option1','option2','option3'));
    $myForm->textArea('textA',5,30);
    $myForm->input('test','testtest','radio');
    $myForm->input('test','testtest','checkbox');
    echo $myForm->getForm();
?>