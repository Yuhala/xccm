<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Composition XCCM</title>
    <meta name="description" content="DESCRIPTION">
    <link rel="stylesheet" href="/css/composition.css">
    <link rel="stylesheet" href="/css/submit.css">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/js/jstree/themes/default/style.min.css">
     <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <script type="text/javascript" src="/js/tinymce/tinymce.min.js"></script>

</head>

<body>


@yield('content')

</body>

<script src="/js/jquery-3.2.0.min.js"></script>
<script src="/js/jstree/jstree.min.js" charset="utf-8"></script>
<script src="/js/tinymce/jquery.tinymce.min.js" charset="utf-8"></script>
<script src="/js/composition.js" charset="utf-8"></script>
<script src="/js/tree.js" charset="utf-8"></script>
<script src="/js/composition_create.js"></script>
<script src="/js/composition_save.js"></script>
<script src="/js/composition_submit.js"></script>

</html>
