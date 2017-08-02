<?php
/*
 * Theme Name:  Newspaper IL
 * Theme URI:           http://themeforest.net/user/tagDiv/portfolio
 * Description:         Function file for IL
 * Version:             7.5
 * Author:              tagDiv
 * Author URI:  http://themeforest.net/user/tagDiv/portfolio
 * License:
 * License URI:
 * Template: Newspaper
 * Tags:black, white, one-column, two-columns, fixed-layout
 * */

function header_sidebar(){
    register_sidebar(array(
       'name'=>'Header Sidebar',
        'id'=>'header-sidebar',
        'before_widget'=>'<aside class="widget %2$s">',
        'after_widget'=>'</aside>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>'        
    ));
}
add_action('widgets_init','header_sidebar');

/* register_field_for_youtube_live_link add input box for live link setting page. */
function register_fields_for_youtube_link() {
    register_setting('general', 'youtube_live_link', 'esc_attr');
    add_settings_field('youtube_live_link', '<label for="youtube_live_link">' . __('Youtube Live link', 'youtube_live_link') . '</label>', 'youtube_live_link_field', 'general');
}
/* youtube_live_link_field function to show saved value for youtube live link */
function youtube_live_link_field() {
    ?>
    <input name="youtube_live_link" type="text" id="youtube_live_link" value="<?php echo get_option('youtube_live_link');?>" class="regular-text">
    <?php
}
add_filter('admin_init', 'register_fields_for_youtube_link');

//Use short code to list all tags on your page

add_shortcode('list_all_tags', 'tagList');
function tagList() {
    $list="";
    $tags=get_tags();


    for($i=0;$i<count($tags);$i++){

      $list.= "<div class=\"td-pb-span4\"><a href='/tag/".$tags[$i]->name."'>".$tags[$i]->name."</a></div>";
 $value=ucfirst($tags[$i]->name);
        $arr[$value[0]][]=$value;
    }

    foreach($arr as $key=>$val){
            if( !preg_match("/[#$,.'?0-9]/i", $key)) {
                echo $val = "<div class=\"td-tag-filter\"><button  value=".$key.">$key</button></div>";
            }



    }
    echo "<div>$list</div>";

}



?>
<style>
    div .td-tag-filter(    font: 14px/27px Arial, Helvetica, sans-serif;
    height: 27px;
    width: 20px;
    text-align: center;
    margin-right: 1px;
    background: #dedede;
    color: #666;
    display: inline-block;
    text-transform: uppercase;)

</style>