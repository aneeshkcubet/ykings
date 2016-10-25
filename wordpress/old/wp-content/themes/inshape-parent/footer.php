<?php 
 
    $footer_socials = tfuse_options('footer_socials');
    $footer_menu = tfuse_options('footer_menu');
?>
</div>
<footer class="site-footer" role="contentinfo">
        <?php if($footer_socials):?>
             <?php
                $fb = tfuse_options('facebook');
                $tw = tfuse_options('twitter');
                $v = tfuse_options('vimeo');
                $g = tfuse_options('google');
            ?>
            <ul class="footer-social">
                <?php if(!empty($fb)):?>
                    <li><a class="link-facebook" href="<?php echo $fb;?>" target="_blank"></a></li>
                <?php endif;?>
                <?php if(!empty($tw)):?>
                    <li><a class="link-twitter" href="<?php echo $tw;?>" target="_blank"></a></li>
                <?php endif;?>
                <?php if(!empty($v)):?>
                    <li><a class="link-vimeo" href="<?php echo $v;?>" target="_blank"></a></li>
                <?php endif;?>
                <?php if(!empty($g)):?>
                    <li><a class="link-google" href="<?php echo $g;?>" target="_blank"></a></li>
                <?php endif;?>
            </ul>
        <?php endif;?>
        <?php if($footer_menu):?>
            <?php  tfuse_menu('footer');  ?>
        <?php endif;?>
        <div class="copyright"><?php echo tfuse_options('footer_copyright');?></div>
    </footer>
    <!-- Site Footer -->

</div>
<?php
    $home = tfuse_is_homepage();
    $cat_ids = tfuse_get_categories_ids();
    $allhome = tfuse_select_all_home();
    $allblog = tfuse_select_all_blog();
?>
<input type="hidden" value="<?php echo $home; ?>" name="homepage"  />
<input type="hidden" value="<?php echo $allhome; ?>" name="allhome"  />
<input type="hidden" value="<?php echo $allblog; ?>" name="allblog"  />
<input type="hidden" value="<?php echo $cat_ids; ?>" name="categories_ids"  />
<?php wp_footer(); ?>
</body>
</html>

