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
	<script src="<?=base_url();?>static/js/jquery.tools.min.js"></script>

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
<div id="clonelink">&nbsp;<a href="<?=base_url();?>index.php/main/clonelist/<?=$slug;?>">[ Clone list ]</a></div>
<?php 
if($show_edit == TRUE)
{
    echo '<div id="editlink"><a href="'.base_url().'index.php/main/edit/'.$slug.'/">[ Edit list ]</a> | </div>';
}
    
foreach ($result as $row):
?>

<h1><?=$row->title;?></h1>
<hr />
<p><?=$row->description;?></p>

<ol>
    <?php foreach($items as $each_item): ?>
    <li><?=$each_item;?></li>
    <?php endforeach; ?>
</ol>

<?php
endforeach;
?>

<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="http://benelist.com" send="true" width="450" show_faces="false" font=""></fb:like>

<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:comments href="<?=$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];?>" num_posts="3" width="500"></fb:comments>
</div>

<div id="sidebar">
	<h1>Related</h1>
    <ul>
    <?php
		if(count($assoc) < 1):
			echo 'There are no related lists...';
		endif;
		foreach($assoc as $assocs):?>
        <li>
			<a class="assoc" title="<?=$assocs->description;?>" href="<?=base_url()?>index.php/main/view/<?=$assocs->slug;?>">
				<?=$assocs->title;?>
			</a>
		</li>
    <?php endforeach; ?>
    </ul>
</div>
</div>
<script type="text/javascript">
$("#sidebar ul li a[title]").tooltip({position: "top center"});
$(function(){
	$( "#sortable" ).sortable();
	$( "#sortable" ).disableSelection();
    
});
</script>
</body>
</html>