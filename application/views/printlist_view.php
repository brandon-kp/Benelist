<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="Brandon Probst" />
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>static/css/print.css" />

	<title>Benelist: <?=$title;?></title>
</head>

<body>

    <div id="logo">
        <h1></h1>
    </div>
    
<div id="content">

<h1><?=$title;?></h1>
<p><?=$description;?></p>

<ol>
    <?php foreach($items as $each_item): ?>
    <li><?=$each_item;?> <span class="tick"></span></li>
    <?php endforeach; ?>
</ol>

<p class="watermark">Printed courtesy of Benelist.tld</p>
</div>

</body>
</html>