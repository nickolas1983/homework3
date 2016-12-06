

function pagination() {
        $("#show").fadeOut(500, function() {
            $(".page").fadeIn(1500, function() { });
        });
    }

function total_views(data) {
    $("#viewed").text('Viewed ' + data  + ' times');
}


function visit_counter() {
    var visitors = Math.floor(Math.random() * 6);
    $.get("Article/counter", {
        id: $("#id").text(),
        visitors: visitors
        },
        total_views);
    
    $("#visitors").text(visitors);
    setTimeout("visit_counter()", 5000);
}

function search_results(data) {
    var array = data.split(';');
    var result = $("#search_result");
    result.empty();
    for (var i = 0; i < array.length; i++) {
        result.append("<li style='padding-bottom : 5px;'><a href='Article/tagList/" + array[i] + "'>"  + array[i] + "</a></li>");
    }
}

function search() {
    $.get("Article/search", {
            text: $(this).val()
        },
        search_results);
}

function saveComment() {
    var $commentTree = '';
    if ($("#comment").val()){
        $.post("Article/saveComment",
            {
                text: $("#comment").val(),
                id: $("#id").text(),
                parent_id: comment_id
            }, function (data) {
                //alert(JSON.parse(data));
                data = JSON.parse(data);
                $commentTree += "<li class='well well-small' id='comment_"+data['id_comment']+"' style='text-decoration: none'>";
                $commentTree += "<p><b>"+data['login'] +" :</b><span> "+data['comment']+"</span></p><div style='text-align: right'><span></span>";
                $commentTree += "<button class='like' id='+_comment_"+data['id_comment']+"'>+</button><button class='like' id='-_comment_"+data['id_comment']+"'>-</button>";
                $commentTree += "<button class='like' id='answer_comment_"+data['id_comment']+"'>Ответить</button></div>";
                $commentTree += "</li>\n";
                if (!comment_id){
                    $("#comments_return").append($($commentTree));
                }
                else {
                    var parent = $("#comment_"+comment_id + " + ul");

                    if (parent.length > 0){
                        parent.append($($commentTree));
                    }
                    else {
                        $commentTree = "<ul>" + $commentTree + "</ul>";
                        $("#comment_"+comment_id).after($($commentTree));
                    }
                    comment_id = '';
                }
            });
    }
}

var comment_id = '';

function like() {
    var element = $(this);
    comment_id = element.attr("id");
    var like_dislike = comment_id.substring(0,1);
    var result = '';
    comment_id = comment_id.substring(comment_id.lastIndexOf('_')+1);
    if (like_dislike == "+" || like_dislike == "-"){
        $.post("Article/like", {
                id: comment_id,
                mark: like_dislike
            },
            function (data) {
                data = JSON.parse(data);

                if (data['rating'] >= 0){
                    result = "<span style='color: green; font-weight: bold'>"+data['rating']+" </span>";
                }
                else {
                    result = "<span style='color: red; font-weight: bold'>"+data['rating']+" </span>";
                }
                $("#comment_"+data['id_comment']+" > div > span").replaceWith(result);
            });
    }
    else if(like_dislike == "a"){
       $("#comment").focus();
    }
}

function comment_edit() {
    var element = $(this);
    var oldButton = element;
    comment_id = element.attr("id");
    var result = '';
    comment_id = comment_id.substring(comment_id.lastIndexOf('_')+1);
    var parent = $("#comment_"+comment_id); 
    var editFild = $("#comment_"+comment_id + " p span");
    var text = editFild.html();

    editFild.replaceWith("<textarea class='form-control'>"+text+"</textarea>");
    element.replaceWith("<button class='save' id='save_comment_"+comment_id+"'>Сохранить</button>");

    $("#comments_return").on("click","li button.save", function () {
        var saveFild = $("#comment_"+comment_id + " textarea");
        var text = saveFild.val();

        $.post("Article/editComment", {
                id: comment_id,
                text: text
            },
            function (data) {
                console.log(data);
            });
        saveFild.replaceWith("<span>"+text+"</span>");
        $(this).replaceWith("<button class='edit' id='edit_comment_"+comment_id+"'>Редактировать</button>");
    });

}

/*window.addEventListener("beforeunload", function (e) {
    var confirmationMessage = "Текст в раздражающем пользователя окне";

    (e || window.event).returnValue = confirmationMessage;
    return confirmationMessage;
});*/

// возвращает cookie с именем name, если есть, если нет, то undefined
function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

function reclame() {
    var element = $(this);
    var price = element.children(".price");
    var oldPrice = price.text();
    price.text(price.text()*0.9);
    var font_size = price.css("font-size");
    var f_color = price.css("color");
    var font_weight = element.css("font-weight");
    price.css({"font-size":"16pt", "color":"red", "font-weight":"bold"});
    element.mouseleave(function(){
        price.text(oldPrice);
        price.css({"font-size":font_size, "color":f_color, "font-weight":font_weight});
    });
}


function checkComment() {

    var element = $(this);
    var visible = element.children(".visible");
    var comment_id = (element.children("span")).text();
    var visColor = visible.css("color");
    var visText = visible.text();
    if (visText == 'Не видимый') {

        visible.css({"color":"green"});
        visible.text('Видимый');
        $.post("Admin/visible", {
                id:  comment_id,
                visible: "1"
            },
            function (data) {

            });
    } else {
        visible.css({"color":"red"});
        visible.text('Не видимый');
        $.post("Admin/visible", {
                id:  comment_id,
                visible: "0"
            },
            function (data) {

            });
    }
}

$(document).ready(function() {
    visit_counter();
    $("#show").bind("click", pagination);
    $("#search").bind("keyup", search);
    $("#save_comment").on("click", saveComment);
    $("#comments_return").on("click","li button.like", like);
    $(".reclame").on("mouseenter", reclame);
    $('[data-toggle="tooltip"]').tooltip();
    $(".check_comment").on("click", checkComment);
    $("#comments_return").on("click","li button.edit", comment_edit);
    



    $(function(){
        setTimeout(function () {
            if (!getCookie('contacts') || getCookie('contacts') == 0){
                document.cookie = "contacts=1; path=/;";
                $('#exampleModal').arcticmodal();
            }
        }, 15000);
    });

    $("#myForm").submit(function () {

        // Получение ID формы
        var formID = $(this).attr('id');
        // Добавление решётки к имени ID
        var formNm = $('#' + formID);
        $.post("Index/contact", {
                name:  $("#inputName").val(),
                email: $("#exampleInputEmail1").val()
            },
            function (data) {
                $(formNm).html(data);
            });
        return false;
    });
    
    
});

