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

<div id="welcome">
    Welcome to BeneList: Where the lists are for your benefit. I've put this together in three days, which took longer than expected. It uses PHP5, Codeigniter framework, and a MySQL database. If you happen to stumble across this somehow, it's important to know this is a project put together for fun and education -- I'm not actually suggesting anyone use this over rememberthemilk or something like that.<br /><br /><span>Love you, <br />Brandon</span>
</div>

<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="http://benelist.com" send="true" width="450" show_faces="false" font=""></fb:like>
</div>

</div>
<script type="text/javascript">
$(function(){

	$( "#sortable" ).sortable();
	$( "#sortable" ).disableSelection();
    
});


</script>
</body>
</html>