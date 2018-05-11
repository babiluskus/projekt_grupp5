<?php
var_dump($_POST['cartItem']);
?>

<div class="single-prod-container">
    <?php 
    //title
    printf("<h1 class='prod-title'>%s</h1>", $data[0]['title']);

    //image
    printf('<img src="%s" alt="bild" class="img-fluid prod_img">', $data[0]['img_url']);
    ?>
        <div class="prod-info">
            <?php echo "<h3>".$data[0]['info']."</h3>"?>
            <?php
           foreach ($data[0] as $key => $value) {

               if($key == 'info' || $key == 'img_url'){
                   continue;
               }
               printf("<ul><li>%s: %s</li></ul>", $key, $value);
           }
            ?>
            <form method="POST" action="<?php echo URLrewrite::BaseURL().'cart'; ?>">
              <input type="hidden" name="cartItem" value="<?php echo htmlentities(serialize($data[0])); ?>" />
              <button type="submit">Köp</button>
            </form>
        </div>
</div>
