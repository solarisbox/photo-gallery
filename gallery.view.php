<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foundation | Welcome</title>
    <link rel="stylesheet" href="css/foundation.css">
    <meta class="foundation-mq-small">
    <meta class="foundation-mq-medium">
    <meta class="foundation-mq-large">
    <meta class="foundation-mq-xlarge">
    <meta class="foundation-mq-xxlarge">
    <meta class="foundation-mq-topbar">
  </head>
  
  <body>
    <div class="row">
      <div class="large-12 columns">
        <h1 class="text-center subheader"><a href="gallery.ctrl.php"><strong>My Photo Galleries</strong></a></h1>
      </div>
    </div>

    <?php if(isset($TPL['DEFAULT_GALLERIES'])) {?>
      <div class="row">
        <div class="large-12 columns">
          <div class="panel">
            <ul class="small-block-grid-3">
              <?php foreach ($TPL['photo_entries'] as $key => $value) { ?>
              <li class="text-center">
                <a href="gallery.ctrl.php?act=allphotos&dir=<?php echo $key?>">
                  <img class="th" src="<?php echo($value['photos'][0]['thumbs']); ?>"
                </a> <br>
                <p class="text-center"><?php echo $value['description'] ?></p>
              </li>
              <?php }?>
            </ul>
          </div>
        </div>
      </div>
    <?php } else if(isset($TPL['ALL_GALLERIES'])) {?>
      <div class="row">
      <div class="large-12 columns">
        <div class="panel">
          <h3 class="subheader"><strong><?php echo $TPL['photo_entries'][$_REQUEST['dir']]['description'] ?></strong></h3>
            <p>Click on a photo to start a slide show!</p>
              <ul class="small-block-grid-6">
              <?php foreach ($TPL['photo_entries'][$_REQUEST['dir']]['photos'] as $key => $value) { ?>
                <li>
                  <a href="gallery.ctrl.php?act=onephoto&dir=<?php echo $_REQUEST['dir'] ?>&id=<?php echo $key ?>">
                    <img class="th" src="<?php echo $value['thumbs']?>">
                  </a>
                </li>   
              <?php }?>             
              </ul>
          </div>
        </div>
      </div>
    <?php } else if(isset($TPL['ONE_GALLERY'])) { ?>
      <div class="row">
      <div class="large-12 columns">
        <div class="panel">
          <h3 class="subheader" style="color:#0079a1"><strong><?php echo $TPL['photo_entries'][$_REQUEST['dir']]['description'] ; ?></strong></h3>
            <p>
              <a class="round label" href="gallery.ctrl.php?act=onephoto&dir=1&id=<?php echo ($_REQUEST['id'] - 1)<=0?0:($_REQUEST['id'] - 1) ;?>">PREV</a>   
              <a class="round label" href="gallery.ctrl.php?act=onephoto&dir=1&id=<?php echo ($_REQUEST['id'] + 1)>=count($TPL['photo_entries'][$_REQUEST['dir']]['photos'])-1?count($TPL['photo_entries'][$_REQUEST['dir']]['photos'])-1:($_REQUEST['id'] + 1);?>">NEXT</a> 
              <span style="margin :0px 20px"><strong><?php echo ($_REQUEST['id'] + 1)."/".count($TPL['photo_entries'][$_REQUEST['dir']]['photos'])?></strong></span>
              <a class="label" href="gallery.ctrl.php?act=allphotos&dir=<?php echo $_REQUEST['dir']; ?>">ShowAll Photos</a>
            </p>
            <img class="round th" src="<?php echo $TPL['photo_entries'][$_REQUEST['dir']]['photos'][$_REQUEST['id']]['thumbs'];?>">
        </div>
      </div>
    </div>
    <?php }?>
  </body>
</html>