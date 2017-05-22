function loadmyeditor() {

    tinymce.init({
        selector: '#notion_editor',
        setup:function(editor){
          editor.on("LoadContent",function(e){
            $("#loading").hide();
            $("#submit_content").show();
            editor.setContent(current_content);
          })
            editor.on('Change',function (e) {
                enablebuttons();
            })
        },
        relative_urls: false,
        remove_script_host: false,
        convert_urls: true,
        language: "fr_FR",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern responsivefilemanager"
        ],
        toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        toolbar2: "print preview media | forecolor backcolor emoticons | responsivefilemanager ",
        // enable title field in the Image dialog
        image_title: true,

        external_filemanager_path: "/filemanager/",
        filemanager_title: "Responsive Filemanager",
        external_plugins: {
            "filemanager": "/filemanager/plugin.min.js"
        }

    });
  }
