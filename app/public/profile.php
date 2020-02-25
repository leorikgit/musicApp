<?php
include_once __DIR__ .'../../core/ini.php';

$user = new User();
if(!$user->findUser()->isLoggedIn()){

    Redirect::to('index.php');
}

$album = new Album();
$albums = $album->findAll();



?>
<?php include_once "includes/header.php";?>
<?php include_once "includes/mainContainerHeader.php"; ?>

    <h1 class="mainViewHeader">You might aslo like</h1>
    <div class="gridViewContainer">
        <?php
            foreach ($albums as $album){
               ?>
                <a href="<?php echo BASE_URL."album.php?id=".$album->id?>">
                    <div class="gridViewItem">
                        <img src="<?php echo BASE_URL."assets/upload/artwork/".$album->art_work_path?>">
                        <div class="gridViewText">
                            <?php echo $album->title?>
                        </div>
                    </div>
                </a>
                <?php
            }
        ?>
    </div>


<?php include_once "includes/mainContainerFooter.php"; ?>
<?php include_once "includes/footer.php"; ?>