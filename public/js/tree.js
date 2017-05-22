// var structure = [{
//     text: "Cours 1",
//     type: "#",
//     children: [{
//         text: 'Partie 1',
//         type: 'partie',
//         id: "001",
//
//         children: [{
//             'text': 'Chapitre 1',
//             'state': {
//                 'opened': true,
//                 'selected': true
//             },
//             type: "chapitre",
//             'children': [{
//                 'text': 'section 1',
//                 'type': 'section',
//                 'children': [{
//                     text: "Notion 1",
//                     type: "notion",
//                 },
//                     {
//                         text: "Notion 2",
//                         type: "notion",
//                     }
//                 ]
//             },
//                 {
//                     'text': 'section 2',
//                     'type': 'section',
//                     'children': [{
//                         text: "Notion 1",
//                         type: "notion",
//                     },
//                         {
//                             text: "Notion 2",
//                             type: "notion",
//                         }
//                     ]
//                 },
//                 {
//                     'text': 'section 3',
//                     'type': 'section'
//                 },
//                 {
//                     'text': 'section 4a',
//                     'type': 'section'
//                 },
//                 {
//                     'text': 'section 4b',
//                     'type': 'section'
//                 },
//             ]
//         }]
//     }]
// }];



var types = {
    "#":{
        max_children: 1,
    },
    "cours": {
        icon: "fa fa-book orange",
        valid_children: ["partie"],
        "create_node": true,
        "delete_node": false,
    },
    "partie": {
        "icon": "fa fa-fort-awesome red",
        valid_children: ["chapitre"]
    },
    "chapitre": {
        "icon": "fa fa-folder ",
        valid_children: ["section"]
    },
    "section": {
        "icon": "fa fa-flag blue",
        valid_children: ["notion"]
    },
    "notion": {
        "icon": "fa fa-leaf green",
        valid_children: []
    }
};
var getitems = function (node) {
    var type = node.type;
    var childtype;
    switch (type) {
        case "cours":
            childtype = "partie";
            break;
        case "partie":
            childtype = "chapitre";
            break;
        case 'chapitre':
            childtype = "section";
            break;
        case "section":
            childtype = "notion";
            break;
    }
    var text = ((childtype == "chapitre") ? "Nouveau" : "Nouvelle") + " " + childtype;
    var items = {
        addItem: {
            label: "Créer",
            icon: "fa fa-plus green",
            action: function () {
                var inst = $.jstree.reference(node);
                inst.create_node(node, {
                    "text": text ,
                    type: childtype
                }, 'last', (newnode) => {
                    inst.edit(newnode);
                    create_node(text,node.a_attr.remoteid,newnode,childtype);
                })
            }
        },
        renameItem: {
            label: 'Renommer',
            icon: "fa fa-text-width blue",
            action: function () {
                $.jstree.reference(node).edit(node)
            }
        },
        editionItem: {
            label: "Editer",
            icon: "fa fa-pencil orange",
            action: false,
            submenu: {
                copy: {
                    label: "Copier",
                    icon: "fa fa-copy orange",
                    action: function () {
                        $.jstree.reference(node).copy(node);
                    }
                },
                cut: {
                    label: "Couper",
                    icon: "fa fa-scissors orange",
                    action: function () {
                        $.jstree.reference(node).cut(node);
                    }
                },
                paste: {
                    label: "Coller",
                    icon: "fa fa-clipboard orange",
                    _disabled: () => {
                        return !$.jstree.reference(node).can_paste();
                    },
                    action: function () {
                        $.jstree.reference(node).paste(node);
                    }
                }
            }
        },
        deleteItem: {
            label: 'Supprimer',
            icon: "fa fa-trash red",
            action: function () {
                deletenode(node);
            }
        }
    };
    switch (type) {
        case "cours":
            items.deleteItem._disabled = true;
            items.renameItem._disabled = true;
            items.editionItem.submenu.copy._disabled = true;
            items.editionItem.submenu.cut._disabled = true;
            break;
        case "notion":
            items.addItem._disabled = true;
            break;
    }
    return items;
};

var tree = {};

function enableTree() {
    tree.find("li").each(function () {
        var node = tree.jstree().get_node(this.id);
        tree.jstree().enable_node(node);
    })
}

function disableTree() {
    tree.find("li").each(function () {
        var node = tree.jstree().get_node(this.id);
        tree.jstree().disable_node(node);
    })
}

current_dragged_remoteid=null;
$(function () {

    tree = $('#treeview')
        .on('move_node.jstree', function (e, data) {
            console.log('moved');
            // refresh_json();

        })
        .on("select_node.jstree", function (e, data) {
            console.log(data.node.text);
            if(current.id==data.node.id) return;
            current=data.node;
            if (data.node.type == "notion") {
                $("#editionArea").hide().html($("#notion_editor").html()).show();
                $("#loading").show();
                loadmyeditor();
                geteditorcontent();

            } else {
                $("#editionArea").hide().html($("#course_editor").html()).show(300);
                getintroconcl();
            }
            disablebuttons();
        })
        .on("rename_node.jstree",function (event , obj) {

            if(obj.text!=obj.old){
                rename(obj.node.a_attr.remoteid,getType(obj.node.type),obj.text);
                console.log(obj.text);
            }
        }).on("paste.jstree",function (event,obj) {
            console.log(obj);
            if(obj.mode=="copy_node"){
                duplicate(obj.node[0].id,obj.node[0].type,obj.parent);
            }
            if(obj.mode=="move_node"){
                changeParentid(obj.node[0].id,obj.node[0].type);
            }
        })
        .jstree({
            "core": {
                'data': structure,
                'multiple':false,
                "check_callback": true
            },
            "types": types,
            "plugins": ["contextmenu","dnd", "types"],
            "contextmenu": {
                items: getitems
            }
        });

    $(document).on("dnd_start.vakata",function (e,obj) {
        start_partent_drag=current.parent;
    }).on("dnd_stop.vakata",function (e,obj) {
        console.log(current)
        if(current.id==null) return;
        parent_id=$(tree).jstree().get_parent(current.id);
        if(parent_id==start_partent_drag){
            console.log("nothing");
            return;
        }
        changeParentid(current.id,current.type)

        // console.log(current_dragged_remoteid,$(tree).jstree().get_json(data.node.parent))
    })
})
start_partent_drag={};
current={};