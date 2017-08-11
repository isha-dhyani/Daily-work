
var ar= document.getElementById("jsList").value;
var obj=JSON.parse(ar);
//console.log(obj['A']);
//console.log(objj);
function getTagList(id) {
    var value = obj[id];
    var list = "";
    for (var i = 0; i < value.length; i++) {

        list += "<div class=\"td-pb-span4\"><a href='/isha/index.php/tag/" + value[i][1] + "' target='_blank'>" + value[i][0] + "</a></div>";
    }
    document.getElementById("list").innerHTML = list;

}

var pageList = new Array();
var currentPage= 1;
var numberPerPage= 75;
var numberOfPages = objj.length;

function makelist(){

    numberOfPages = ceil(objj.length / numberPerPage);
    }

    function nextPage() {
        currentPage += 1;
        loadList();
    }

    function previousPage() {
        currentPage -= 1;
        loadList();
    }
/*
    function firstPage() {
        currentPage = 1;
        loadList();

    }

    function lastPage() {
        currentPage = numberOfPages;
        loadList();
    }*/
    function loadList() {
        var begin = ((currentPage - 1) * numberPerPage);
        var end = begin + numberPerPage;

        pageList = objj.slice(begin, end);
        //console.log(pageList);
        drawList();
        check();
    }

    function drawList() {
        document.getElementById("list").innerHTML = "";
        for (r = 0; r < pageList.length; r++) {
            document.getElementById("list").innerHTML +=  "<div class=\"td-pb-span4\"><a href='/isha/index.php/tag/" + pageList[r][1] + "' target='_blank'>" + pageList[r][0] + "</a></div>";
        }
    }

    function check() {
        document.getElementById("next").disabled = currentPage == numberOfPages ? true : false;
        document.getElementById("previous").disabled = currentPage == 1 ? true : false;
       // document.getElementById("first").disabled = currentPage == 1 ? true : false;
        //document.getElementById("last").disabled = currentPage == numberOfPages ? true : false;
    }

    function load() {

        loadList();
    }

    window.onload = load;
