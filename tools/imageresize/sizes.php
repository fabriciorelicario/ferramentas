<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="list-group">
    <?php foreach ($sizesArr as $k => $v){ ?>
    <a href="index.php?size=<?php echo $k ?>" class="list-group-item <?php if($sizeGet == $k){ echo "active";} ?>">
        <h4 id="list-group-item-heading" class="list-group-item-heading"><?php echo $v; ?></h4>
        <p class="list-group-item-text">(<?php echo $k ?>)</p>
    </a>
    <?php } ?>
</div>
