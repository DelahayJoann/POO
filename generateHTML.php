<?php
    include 'class.php';

    $myHTML = new Html();
    echo $myHTML->linkCSS("./blablabla.css");
    echo $myHTML->meta('testName','testContent');

    $myForm = new Form();
    $myForm->input('test','testtest','text');
    $myForm->select('testSelect',array('option1','option2','option3'));
    $myForm->textArea('textA',5,30);
    $myForm->input('test','testtest','radio');
    $myForm->input('test','testtest','checkbox');
    echo $myForm->getForm();


    echo $myHTML->image('http://goldpc.alakmalak.org/wp-content/plugins/woocommerce/assets/images/placeholder.png','random');
    echo $myHTML->a('./generateHTML.php',"a link");

    echo $myHTML->script('./blablabla.js');
?>