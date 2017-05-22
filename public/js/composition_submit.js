/**
 * Created by TrivialMan on 21/05/2017.
 */

function disablebuttons(){
    $("#submit-content").prop("disabled",true);
    $("#submit-intro").prop("disabled",true);
    $("#submit-concl").prop("disabled",true);
}
function enablebuttons(){
    $("#submit-content").prop("disabled",false);
    $("#submit-intro").prop("disabled",false);
    $("#submit-concl").prop("disabled",false);
}
function enableintro() {
    if($("#introduction").val()=="") $("#submit-intro").prop("disabled",true);
    else $("#submit-intro").prop("disabled",false);
}
function enableconcl() {
    if($("#conclusion").val()=="") $("#submit-concl").prop("disabled",true);
    else $("#submit-concl").prop("disabled",false);
}

function submitcontent(){
    var button=$("#submit-content")
    console.log("trying to submit");
    if(button.hasClass("submitbutton--loading")||button.prop("disabled")==true){
        return;
    }
    button.addClass("submitbutton--loading");

    var id= current.a_attr.remoteid;
    var content=$("#notion_editor").tinymce().getContent();

    $.ajax({
        url: "/composition/notion/"+id,
        method: "PUT",
        dataType: "json",
        data: {
            "content": content
        },
        beforeSend: function () {
            disableTree();
        },
        error: function (error, status) {
            console.log("Une erreur est survenue", error);
        },
        success: function (data) {
            console.log(data);
        },
        complete: function () {
            enableTree();
            button.removeClass("submitbutton--loading");
        }
    })
}

function submitintroduction() {
    var button=$("#submit-intro");
    if(button.hasClass("submitbutton--loading")||button.prop("disabled")==true){
        return;
    }
    button.addClass("submitbutton--loading");
    var id= current.a_attr.remoteid;
    var type=getType(current.type);
    var introduction=$("#introduction").val();
    $.ajax({
        url: "/composition/"+type+"/"+id,
        method: "PUT",
        dataType: "json",
        data: {
            "introduction": introduction
        },
        beforeSend: function () {
            disableTree();
        },
        error: function (error, status) {
            console.log("Une erreur est survenue", error);
        },
        success: function (data) {
            console.log(data);
        },
        complete: function () {
            enableTree();
            button.removeClass("submitbutton--loading");
        }
    })
}

function submitconclusion() {
    var button=$("#submit-concl");
    if(button.hasClass("submitbutton--loading")||button.prop("disabled")==true){
        return;
    }
    button.addClass("submitbutton--loading");
    var id= current.a_attr.remoteid;
    var type=getType(current.type);
    var conclusion=$("#conclusion").val();
    $.ajax({
        url: "/composition/"+type+"/"+id,
        method: "PUT",
        dataType: "json",
        data: {
            "conclusion": conclusion
        },
        beforeSend: function () {
            disableTree();
        },
        error: function (error, status) {
            console.log("Une erreur est survenue", error);
        },
        success: function (data) {
            console.log(data);
        },
        complete: function () {
            enableTree();
            button.removeClass("submitbutton--loading");
        }
    })
}