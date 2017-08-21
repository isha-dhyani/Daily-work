
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
add_filter('admin_init', 'register_fields_for_youtube_link');


//Use short code to list all tags on your page
add_shortcode('list_all_tags', 'tagList');
function tagList() {
    echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="'.get_stylesheet_directory_uri().'/js/pagination.js"></script>
<script src="'.get_stylesheet_directory_uri().'/js/new.js"></script>
<script src="'.get_stylesheet_directory_uri().'/js/script.js"></script>
<link type="text/css" rel="stylesheet" href="'.get_stylesheet_directory_uri().'/js/page.css"></script>';
    $list="";
    $tags=get_tags();
// print_r($tags);
    for($i=0;$i<count($tags);$i++){
        $jsArray[] = str_replace("'",'',array($tags[$i]->name,$tags[$i]->slug));
        $list.= "<div class=\"td-pb-span4\"><a href='/isha/dev/blog/topic/".$tags[$i]->slug."' target='_blank'>".$tags[$i]->name."</a></div>";
        $value=ucfirst($tags[$i]->name);
        $arr[$value[0]][]=str_replace('\'','',array($value,$tags[$i]->slug));

    }
    echo "<div style='width: 730px;' class=\"btn-group btn-group-sm\">";
    foreach($arr as $key=>$val){
        if( ctype_alpha($key)) {
            $ar["$key"]=$val;
            echo $val= "<button class=\"btn btn-primary\" id='$key' onclick='getList(this.id)' value=".$key.">$key</button>";

        }
    }  //print_r($list);
//echo "</div>";onclick='getList(".$_GET['page'].")'
//    echo "<body>
//    <div id=\"list\"></div>
//    <div style='width: 50%;' class=\"pager\" >
//     <input class=\"btn btn-warning\" type=\"button\" id=\"previous\" onclick=\"previousPage()\" value=\"<<\" />
//    <input class=\"btn btn-warning\" type=\"button\" id=\"next\" onclick=\"nextPage()\" value=\">>\" />
//    </div>
//</body>";
    echo "</div>";
//    echo "
//    <div id=\"list\"></div>
//    <ul style='width: ;' class=\"pager\" >
//   <li><a href='#'  id=\"previous\" onclick=\"previousPage()\" > <<Previous</a></li>
//   <li> <a href='#'  id=\"next\" onclick=\"nextPage()\" >Next>></a> </li>
//
//    </ul>
//";
    $page = $_GET['page'];
    echo " <input type='hidden' id='key' value='$page'>";
    echo '<div id="list"></div>
<ul id="pagination" class="pagination-sm"></ul>';

    /*if (!isset($page)) {

        echo '<div id="list">'.$list.'</div>';
    }
    else{

        echo " <input type='hidden' id='key' value='$page'>";
        echo '<div id="list"></div>
<ul id="pagination" class="pagination-sm"></ul>';
    }*/


    /*echo '<li><a id="previous" onclick="previousPage()">Previous</a></li>
    <li><a  id="next" onclick="nextPage()">Next</a></li>
  </ul> ';*/


    // $file = file_put_contents(get_stylesheet_directory()."/file.json", json_encode($jsArray));
    // echo '<script> var objj = '.file_get_contents(get_stylesheet_directory_uri()."/file.json").';</script>';
    $jsArr = json_encode($jsArray);
    $ar=json_encode($ar);
    echo "<input type='hidden' id='jsArr' value='$jsArr'>
<input type='hidden' id='jsList' value='$ar'>";
    echo '<script src="'.get_stylesheet_directory_uri().'/js/tagList.js" ></script>';
}
?>
