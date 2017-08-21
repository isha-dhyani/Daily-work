var ar= document.getElementById("jsList").value;
var obj=JSON.parse(ar);
var jsArr= document.getElementById("jsArr").value;
var jsArray = JSON.parse(jsArr);
var page= document.getElementById("key").value;
var pageList = new Array();
var currentPage = 1;
var numberPerPage = 75;
var vall="";
var list_="";

function Pageload(page){

    getTagList(page);
}
function getList(id){

console.log(id);
        val= "";
        window.location="?page="+id;
        getTagList(id);

}
function getTagList(id) {
   if(id==""){
       vall=jsArray;
   }else {
    vall= obj[id];}

console.log(vall);

    for (var i = 0; i < vall.length; i++) {

        list_+= "<div class=\"td-pb-span4\"><a href='/isha/dev/blog/topic/" + vall[i][1] + "' target='_blank'>" + vall[i][0] + "</a></div>";
    }
    document.getElementById("list").innerHTML = list_;
    loadList();
return list_;
}

$(function() {
    $('#pagination').pagination({
        items: vall.length/numberPerPage,
        hrefTextPrefix: '#num=',
        cssStyle: 'light-theme',
        onPageClick: function (pagenum) {
            var begin = ((pagenum - 1) * numberPerPage);
            var end = begin + numberPerPage;
            pageList = vall.slice(begin, end);
            drawList();
            console.log(pageList);
        }

    });
});

   /*$('#pagination').twbsPagination({
        totalPages: 50,
        visiblePages: 5,
       href: '?page={{number}}',
       onPageClick: function (event, page) {
           $('#page-content').text('Page ' + page);
       }
    });*/



/*function nextPage() {
    currentPage += 1;
    loadList();
}

function previousPage() {
    currentPage -= 1;


    loadList();

}*/
function loadList() {
    numberOfPages = vall.length;
    var begin = ((currentPage - 1) * numberPerPage);
    var end = begin + numberPerPage;

    pageList = vall.slice(begin, end);

    drawList();

}

function drawList() {

    document.getElementById("list").innerHTML = "";
    //console.log(pageList.length);
        for (var r = 0; r < pageList.length; r++) {
            document.getElementById("list").innerHTML += "<div class=\"td-pb-span4\"><a href='/isha/dev/blog/topic/" + pageList[r][1] + "' target='_blank'>" + pageList[r][0] + "</a></div>";

        }

}

window.onload = getTagList(page);

/*
$k= json_encode($jsArray);

$file = file_put_contents(get_stylesheet_directory()."/file.json", $k);

$l=file_get_contents(get_stylesheet_directory()."/file.json");
$p= str_replace("'","",$l);
// echo '<script> var objj = '.file_get_contents(get_stylesheet_directory_uri()."/file.json").';</script>';
//echo $jsArr =  preg_replace("\'s", "$$", html_entity_decode(json_encode($jsArray), ENT_QUOTES));
$ar=json_encode($ar);
echo "<input type='hidden' id='jsArr' value='$p'>
<input type='hidden' id='jsList' value='$ar'>";
echo '<script src="'.get_stylesheet_directory_uri().'/js/tagList.js" ></script>';*/
