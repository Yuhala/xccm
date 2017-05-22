/**
 * Created by TrivialMan on 20/05/2017.
 */

function getRemoteId(id){
    return $(tree).jstree().get_json(id).a_attr.remoteid;
}
function getnode(id){
    return $(tree).jstree().get_json(id);
}
function getParent(id) {
    return $(tree).jstree().get_parent(id);
}
function setRemoteId(nodeid,remoteid){
    $(tree).jstree().get_json(nodeid).a_attr.remoteid=remoteid;
}


function saveTree() {
    var json = $(tree).jstree(true).get_json('#', {flat: true});
    var values = [];
    json.forEach(function (element) {
        values.push({
            "id": element.id,
            "type": element.type,
            "parent": element.parent,
            "text": element.text,
            "state": element.state,
            "a_attr": {
                "remoteid": element.a_attr.remoteid
            }
        });
    })
    $.ajax({
        url: "/composition/course/" + course_id,
        method: "patch",
        dataType: "text",
        data: {
            'structure': JSON.stringify(values),
        },
        error: function (error, status) {
            console.log("Une erreur est survenue", error);
        },
        success: function (data) {
            console.log(data);
        }
    });
}

function rename(id, type, newname) {
    $.ajax({
        url: "/composition/" + type + "/" + id,
        method: "PUT",
        dataType: "json",
        data: {
            title: newname
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
            saveTree();
        }
    })

}

function deletenode(node) {
    parts = [];
    chapters = [];
    sections = [];
    notions = [];
    childrens = $(tree).jstree(true).get_json(node, {flat: true});
    childrens.forEach(function (node) {
        if (node.type == "partie") {
            parts.push(node.a_attr.remoteid);
            return;
        }
        if (node.type == "chapitre") {
            chapters.push(node.a_attr.remoteid);
            return;
        }
        if (node.type = "section") {
            sections.push(node.a_attr.remoteid);
            return;
        }
        if (node.type = "notion") {
            notions.push(node.a_attr.remoteid);
        }
    })
    $.ajax({
        url: "/composition/deletenode",
        method: "post",
        dataType: "json",
        data: {
            "parts": parts,
            "chapters": chapters,
            "sections": sections,
            "notions": notions,
        },
        beforeSend: function () {
            disableTree();
        },
        error: function (error, status) {
            console.log("Une erreur est survenue", error);
        },
        success: function (data) {
            $.jstree.reference(node).delete_node(node);
            console.log(data);
        },
        complete: function () {
            enableTree();
            saveTree();
        }
    })
    console.log(childrens)
}

function duplicatenodestructure(nodeid) {
     var root ={id:getRemoteId(nodeid),
        childrens:[]
    }
    var node=getnode(nodeid);
    node.children.forEach(function (childid) {
        root.childrens.push(duplicatenodestructure(childid))
    })
    return root;
}

function updatenodes(nodeid,structure){
    setRemoteId(nodeid,structure.id);
    index=0;
    getnode(nodeid).children.forEach(function (child) {
        updatenodes(child.id,structure.childrens[index])
        index++;
    })
}

function duplicate(nodeid,type,parentid) {
    var success;
    var structure= duplicatenodestructure(nodeid);
    structure.parentid=getRemoteId(parentid);
    $.ajax({
        url: "/composition/duplicatenode",
        method: "POST",
        dataType: "json",
        data: {
            structure: JSON.stringify(structure),
            rootType: getType(type),

        },
        beforeSend: function () {
            disableTree();
        },
        error: function (error, status) {
            console.log("Une erreur est survenue", error);
        },
        success: function (data) {
            console.log(data);
            updatenodes(nodeid,data);
            success=true;
        },
        complete: function () {
            enableTree();
            if(success) saveTree();
        }
    })
}

function changeParentid(id,type) {
    $.ajax({
        url: "/composition/" + getType(type) + "/" + getRemoteId(id),
        method: "PUT",
        dataType: "json",
        data: {
            newparentid: getRemoteId(getParent(id))
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
            saveTree();
        }
    })
}

function getintroconcl() {
    var id = current.a_attr.remoteid;
    var type = current.type;
    $.ajax({
        url: "/composition/" + getType(type) + "/" + id,
        method: "GET",
        dataType: "json",
        data: {
            "introconcl": true,
        },
        beforeSend: function () {
            disableTree();
        },
        error: function (error, status) {
            console.log("Une erreur est survenue", error);
        },
        success: function (data) {
            console.log(data);
            $("#introduction").val(data.introduction);
            $("#conclusion").val(data.conclusion);
        },
        complete: function () {
            enableTree();
        }
    });
}

function geteditorcontent() {

    var id = current.a_attr.remoteid;
    $.ajax({
        url: "/composition/notion/" +id,
        method: "GET",
        dataType: "text",
        beforeSend: function () {
            disableTree();
        },
        error: function (error, status) {
            console.log("Une erreur est survenue", error);
        },
        success: function (data) {
            console.log(data);
            current_content=data;
        },
        complete: function () {
            enableTree();
        }
    })
};

current_content=null;