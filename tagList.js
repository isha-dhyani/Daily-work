
var ar= document.getElementById("jsList").value;
console.log(ar);
var obj=JSON.parse(ar);
console.log(obj);
function getTagList(id){
    var value = obj[id];

    var list="";
    for(var i=0; i<value.length;i++){

        list +="<div class=\"td-pb-span4\"><a href='/isha/index.php/tag/"+value[i][1]+"' target='_blank'>"+value[i][0]+"</a></div>";
    }
    document.getElementById("list").innerHTML=list;
}
