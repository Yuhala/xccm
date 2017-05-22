
<script src="{{ asset('/js/jquery-3.2.0.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/jstree/jstree.min.js') }}" type="text/javascript"></script>


<script>
    var structure = [{
        text: "Cours 1",
        type: "#",
        children: [{
            text: 'Partie 1',
            type: 'partie',
            id:"001",

            children: [{
                'text': 'Chapitre 1',
                'state': {
                    'opened': true,
                    'selected': true
                },
                type: "chapitre",
                'children': [{
                    'text': 'section 1',
                    'type': 'section',
                    'children': [{
                        text: "Notion 1",
                        type: "notion",
                    },
                        {
                            text: "Notion 2",
                            type: "notion",
                        }
                    ]
                },
                    {
                        'text': 'section 2',
                        'type': 'section',
                        'children': [{
                            text: "Notion 1",
                            type: "notion",
                        },
                            {
                                text: "Notion 2",
                                type: "notion",
                            }
                        ]
                    },
                    {
                        'text': 'section 3',
                        'type': 'section'
                    },
                    {
                        'text': 'section 4a',
                        'type': 'section'
                    },
                    {
                        'text': 'section 4b',
                        'type': 'section'
                    },
                ]
            }]
        }]
    }];
    var types = {
        "#": {
            icon: "fa fa-book orange",
            valid_children: ["partie"],
            "create_node": true,
            "delete_node": false
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
    var getitems = function(node) {
        var type = node.type;
        var childtype;
        switch (type) {
            case "#":
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
        var items = {
            addItem: {
                label: "Créer",
                icon: "fa fa-plus green",
                action: function() {
                    var inst = $.jstree.reference(node);
                    inst.create_node(node, {
                        text: "Nouveau Noeud",
                        type: childtype
                    }, 'last', (newnode) => {
                        inst.edit(newnode);
                })
                }
            },
            renameItem: {
                label: 'Renommer',
                icon: "fa fa-text-width blue",
                action: function() {
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
                        action: function() {
                            $.jstree.reference(node).copy(node);
                        }
                    },
                    cut: {
                        label: "Couper",
                        icon: "fa fa-scissors orange",
                        action: function() {
                            $.jstree.reference(node).cut(node);
                        }
                    },
                    paste: {
                        label: "Coller",
                        icon: "fa fa-clipboard orange",
                        _disabled: () => {
                        return !$.jstree.reference(node).can_paste();
    },
        action: function() {
            $.jstree.reference(node).paste(node);
        }
    }
    }
    },
        deleteItem: {
            label: 'Supprimer',
                    icon: "fa fa-trash red",
                    action: function() {
                $.jstree.reference(node).delete_node(node)
            }
        }
    };
        switch (type) {
            case "#":
                items.deleteItem._disabled = true;
                items.renameItem._disabled = true;
                items.editionItem._disabled = true;
                break;
            case "notion":
                items.addItem._disabled = true;
                break;
        }
        return items;
    };

    var tree = {};

    function enableTree() {
        tree.find("li").each(function() {
            var node = tree.jstree().get_node(this.id);
            tree.jstree().enable_node(node);
        })
    }

    function disableTree() {
        tree.find("li").each(function() {
            var node = tree.jstree().get_node(this.id);
            tree.jstree().disable_node(node);
        })
    }

    $(function() {

        tree = $('#treeview')
                .on('move_node.jstree', function(e, data) {
                    console.log('moved');
                    // refresh_json();

                })
                .on("select_node.jstree",function(e,data){
                    console.log(data.node.text);
                    if(data.node.type=="notion"){
                        $("#editionArea").hide().html($("#notion_editor").html()).show();
                        $("#loading").show();
                        loadmyeditor();
                    }else{
                        $("#editionArea").hide().html($("#course_editor").html()).show(300);


                    }
                })
                .jstree({
                    "core": {
                        'data': structure,
                        "check_callback": true
                    },
                    "types": types,
                    "plugins": ["contextmenu", "dnd", "types"],
                    "contextmenu": {
                        items: getitems
                    }
                });
    })

</script>