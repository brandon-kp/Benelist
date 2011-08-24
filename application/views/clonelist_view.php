<?php
$attributes = array(
    'id'=>'createform'
);
$listname = array(
    'name'=>'listname',
    'id'=>'listname',
    'value'=>$title
);
$textarea = array(
    'name'=>'listdesc',
    'id'=>'listdesc',
    'value'=>$description,
    'maxlength'=>'255'
);
/*$listitem = array(
    'name'=>'listitem[]',
    'class'=>'listitem',
    'value'=>$each_item
);*/
$listpass = array(
    'name'=>'listpass',
    'id'=>'listpass',
    'placeholder'=>'Enter your Password...'
);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="author" content="Brandon Probst" />
    
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>static/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>static/css/main.css" />
    <link type="text/css" href="<?=base_url();?>static/css/jquery-ui-1.8.14.custom.css" rel="stylesheet" />
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://raw.github.com/malsup/form/master/jquery.form.js"></script>
    <script type="text/javascript" src="<?=base_url();?>static/js/jquery.jqEasyCharCounter.min.js"></script>

	<title>BeneList: Lists for your benefit.</title>
</head>

<body>
<div id="wrap">

    <div id="logo">
        <h1><a href="<?=site_url();?>" title="Go Home"> </a></h1>
    </div>
    <div id="links">
        <a href="<?=base_url();?>index.php/main/recent">Recent</a>
        <span>|</span>
        <a href="<?=base_url();?>index.php/main/create">Create</a>
    </div>
    
<div id="content">
    <h1>Edit List: <?=$title;?></h1>
    <?=form_open('main/clonelist/'.$slug, $attributes);?>
    <?=form_input($listname);?>
    <?=form_textarea($textarea);?>
    <ul id="sortable">
        <?php foreach($items as $each_item): ?>
        <li><input type="text" name="listitem[]" class="listitem" value="<?=$each_item;?>" /> <span class="move"></span></li>
        <?php endforeach;?>
    </ul>
     <a href="#" class="dupe">Add a new item,</a> or <a href="#" class="dupe2">add </a><input type="text" value="1" id="number" size="1" /><a href="#" class="dupe2"> items.</a>
    
    <p id="listpassp"><input type="checkbox" id="listpasscheck" name="listpasscheck" /> <label for="listpasscheck">I want to be allowed to edit this list at a later date</label></p>
    <input type="submit" name="submit" value="Clone List" id="submit" />
    
    <?=form_close();?>
    
    <div id="list_url"></div>
    <script type="text/javascript">
        $('#listdesc').jqEasyCounter({ 
            'maxChars': 255,
            'msgFontSize': '12px', 
            'msgFontColor': '#000', 
            'msgFontFamily': 'Arial', 
            'msgTextAlign': 'right', 
            'msgAppendMethod': 'insertBefore'               
        }); 
    </script>

<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="http://benelist.com" send="true" width="450" show_faces="false" font=""></fb:like><script type="text/javascript">$(function(){$( "#sortable" ).sortable();});$('.dupe').click(function() {$('#sortable').append('<li><input type="text" name="listitem[]" value="" class="listitem" placeholder="A list item..."  /> <span class="move"></span></li>');return false;});$('.dupe2').click(function() {var num = $('#number').val();for(var i = 0; i<num; i++){$('#sortable').append('<li><input type="text" name="listitem[]" value="" class="listitem" placeholder="A list item..."  /> <span class="move"></span></li>');}return false;});$('#listpasscheck').click(function() {$('#listpassp').html('<?=form_password($listpass);?>');return false;});</script>
</div>

</div>
</body>
</html>