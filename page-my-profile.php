<?php get_header() ?>

<?php if(is_user_logged_in()) { ?>
Here you find all details about the events

<?php } else { ?>
Please, login!

<?php } ?>

<?php get_footer() ?>