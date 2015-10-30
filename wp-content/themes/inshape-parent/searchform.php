<div class="widget widget-search">
    <h3 class="widget-title"><?php _e('Search blog','tfuse');?></h3>
    <form method="get" id="searchform" action="<?php echo home_url( '/' ) ?>">
        <div class="field-text buttoned">
            <input type="text" value="" placeholder="<?php _e('ENTER KEYWORD','tfuse');?>" name="s" id="s" />
            <button type="submit" id="searchsubmit" ><i class="tficon-arrow-right"></i></button>
        </div>
    </form>
</div>
