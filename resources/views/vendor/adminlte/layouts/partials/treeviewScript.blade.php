
<script src="{{ asset('/js/jquery-3.2.0.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/jstree/jstree.min.js') }}" type="text/javascript"></script>


<script>
    $(function() {
        var structure = [{
            text: "Cours 1",
            type: "#",
            children: [{
                text: 'Partie 1',
                type: 'partie',

                children: [{
                    'text': 'Notion 1',
                    'state': {
                        'opened': true,
                        'selected': true
                    },
                    type: "paragraphe",
                    'children': [{
                        'text': 'Paragraphe 1',
                        'type': 'notion'
                    },
                        {
                            'text': 'Paragraphe 2',
                            'type': 'notion'
                        },
                        {
                            'text': 'Paragraphe 3',
                            'type': 'notion'
                        },
                        {
                            'text': 'Paragraphe 4a',
                            'type': 'notion'
                        },
                        {
                            'text': 'Paragraphe 4b',
                            'type': 'notion'
                        },
                    ]
                }]
            }]
        }];


        var tree = $('#treeview')
                .on('changed.jstree', function(e, data) {
                    console.log('changed');
                    // refresh_json();
                })
                .on('move_node.jstree', function(e, data) {
                    console.log('moved');
                    // refresh_json();

                })
                .jstree({
                    "core": {
                        "check_callback": true,
                        'data': structure
                    },
                    "types": {
                        "#": {
                            icon: "fa fa-book",
                            valid_children: ["partie"]
                        },
                        // "cours": {
                        //     icon: "fa fa-book",
                        //     valid_children: ["partie"]
                        // },
                        "partie": {
                            "icon": "fa fa-folder",
                            valid_children: ["paragraphe"]
                        },
                        "paragraphe": {
                            "icon": "fa fa-clipboard ",
                            valid_children: ["notion"]
                        },
                        "notion": {
                            "icon": "fa fa-file-text-o",
                            valid_children: []
                        }
                    },
                    "plugins": ["contextmenu", "dnd", "types"]
                });

        // var editor = ace.edit("editor");
        // editor.setTheme("ace/theme/monokai");
        // editor.getSession().setMode("ace/mode/javascript");


        function refresh_json() {
            var v = $("#treeview").jstree(true).get_json('#', {}, false);
            var jsonstring = JSON.stringify(v, null, '\t');
            //$("#jsonstring").html("<h1>JSON string</h1><code>" + jsonstring + "</code>");
            console.log(v);
        }


    })

</script>