<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Unite Gallery - Tiles - Justified - With Links</title>

<script type='text/javascript' src={{url('js/jquery-11.0.min.js')}}></script>
<script type='text/javascript' src={{url('js/unitegallery.min.js')}}></script>

<link rel='stylesheet' href={{url('css/unite-gallery.css')}} type='text/css'/>

<script type='text/javascript' src={{url('js/ugtiles.js')}}></script>


</head>

<body>
hello
<div id="gallery" style="display:none;">
    <a href="http://unitegallery.net">
        <img alt="Lemon Slice"
             src="{{url('/images/trips/thumbnail/1496399173.jpg')}}"
             data-image="http://placehold.it/350x150"
             data-description="This is a Lemon Slice"
             style="display:none">
    </a>
    <a href="http://unitegallery.net">
        <img alt="Lemon Slice"
             src="{{url('/images/trips/thumbnail/1496399173.jpg')}}"
             data-image="http://placehold.it/350x150"
             data-description="This is a Lemon Slice"
             style="display:none">
    </a>
    <a href="http://unitegallery.net">
        <img alt="Lemon Slice"
             src="{{url('/images/trips/thumbnail/1496399173.jpg')}}"
             data-image="http://placehold.it/350x150"
             data-description="This is a Lemon Slice"
             style="display:none">
    </a>
</div>
</body>

<script type="text/javascript">

        jQuery(document).ready(function(){

            jQuery("#gallery").unitegallery({
                tiles_type:"justified",
                tile_border_color:"#F0F0F0",
                tile_outline_color:"#8B8B8B",
                tile_enable_shadow:true,
                tile_shadow_color:"#8B8B8B",
                tile_show_link_icon:true,
                lightbox_textpanel_title_color:"e5e5e5",
                theme_gallery_padding:20,
                tiles_justified_space_between:20,
                tiles_justified_row_height:200
            });

        });

</script>
