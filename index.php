<?php
$backgroundImage = "img/sea.jpg";

// API call goes here
if(isset($_GET['keyword'])) {
    include 'api/pixabayAPI.php';
    $keyword = $_GET['keyword'];
    if(!isset($keyword) || trim($keyword) == '') {
        $imageURLs = getImageURLs($_GET['category'], $_GET['layout']);
    }
    else {
        $imageURLs = getImageURLs($_GET['keyword'], $_GET['layout']);
    }
    $backgroundImage = $imageURLs[array_rand($imageURLs)];
    // print_r($imageURLs);
   echo "Your searched for: " .$_GET['keyword'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Image Carousel</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <style>
            @import url("css/styles.css");
            body {
                background-image: url('<?=$backgroundImage ?>');
            }
        </style>
    </head>
    <body>
        <form>
            <input type="text" name="keyword" placeholder="Keyword" value="">
            
            <!--Layout and Category sections will be added after completing the tutorial-->
            <div id="layoutDiv">
                <input type="radio" name="layout" value="horizontal" id="layout_h" />
                <label for="layout_h"> Horizontal </label><br />
                 <input type="radio" name="layout" value="vertical" id="layout_v"   />
                 <label for="layout_v"> Vertical </label><br />
            </div>
            <br />
            <select name="category" style="color:black; font-size:1.5em">
                 <option value=""> - Select One - </option>
                 <option value="ocean"  > Sea </option>
                 <option> Mountains </option>
                 <option> Forest </option>
                 <option> Sky </option>
            </select><br /><br />
            <input type="submit" value="Submit" />
        </form>
        <br/> <br/>
        <?php
        if(!isset($imageURLs)) {
            echo "<h2> You must type a keyword or select a category </h2>";
        }
        else {
        ?>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style='width:325px'>
            <ol class="carousel-indicators">
                <?php 
                for($i = 0; $i < 7; $i++) {
                    echo "<li data-target='#carousel-example-generic' data-slide-to='$i'";
                    echo ($i == 0)?" class='active'": "";
                    echo "></li>";
                }
                ?>
            </ol>
            <div class="carousel-inner" role="listbox">
                <?php
                    for($i = 0; $i < 7; $i++) {
                        do {
                            $randomIndex = rand(0,count($imageURLs));
                        } while(!isset($imageURLs[$randomIndex]));
                        
                        echo '<div class="item ';
                        echo ($i == 0)?"active": "";
                        echo '">';
                        echo "<img src='" . $imageURLs[$randomIndex] . "' width='325' >";
                        echo '</div>';
                        unset($imageURLs[$randomIndex]);
                    }
                }
                ?>
        </div>
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
        </div> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>