<!-- REQUIRED JS SCRIPTS -->

<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->
<!-- Laravel App -->
<script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>



<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->
<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
</script>

<!-- Scripts for TinyMCE plugin -->
<script src="{{URL::to('js/vendor/tinymce/js/tinymce/tinymce.min.js')}}"></script>
<script>
    var editor_config={
        path_absolute:"{{URL::to('/')}}/",
        selector: "textarea.tinymce",
        statubar:true,
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            " media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",

        relative_urls:false, file_browser_callback : function(field_name, url, type, win){
        var x=window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y=window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL=editor_config.path_absolute+'laravel-filemanager?field_name='+field_name;
        if(type=='image'){
            cmsURL=cmsURL+"&type=Images";
        }else{
            cmsURL=cmsURL+"&type=Files";
        }
        tinyMCE.activeEditor.windowManager.open({
            file:cmsURL,
            title:'Filemanager',
            width:x*0.8,
            height:y*0.8,
            resizable:"yes",
            close_previous:"no"
        });
    }
    };
    tinymce.init(editor_config);

</script>

