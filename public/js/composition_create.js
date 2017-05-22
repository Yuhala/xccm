/**
 * Created by TrivialMan on 20/05/2017.
 */

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function getType(type){
    switch(type){
        case "partie":
            return "part";
            break;
        case 'chapitre':
            return "chapter";
            break;
        case "section":
            return "section";
            break;
        case "notion":
            return "notion";
            break;
        default: return "course";
    }
}

function create_node(title,parent_id,node,type) {
    var serv=getType(type);
    $.ajax({
        url:"/composition/"+serv,
        method:"post",
        dataType: 'json',
        data:{
            'title':title,
            'parent_id':parent_id
        },
        beforeSend:function () {
            disableTree();
        },
        error:function (error,status) {
            console.log("Une erreur est survenue",error);
        },
        success:function (data) {
            node.a_attr.remoteid=data;
            console.log(node);
            console.log(node);
        },
        complete:function () {
            enableTree();
            saveTree()
        }

    })

}