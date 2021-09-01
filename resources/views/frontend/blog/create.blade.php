@extends('layouts.master')
@section('title')

    Swotah Travel and Adventure | Trekking packages for Nepal,
    Trekking costs in nepal
@endsection
@section('innerId','pkdetail-header')
@section('innertop','inner-top')
@section('styles')
    <style type="text/css">
        .blog-category {
            background: #f2f2f2;
            padding: 15px 20px;
            border-bottom: 3px solid #111;
        }

        .blog-btn {
            background: #fc0;
            border: 0px;
            padding: 8px 18px;
            border-radius: 30px;
            box-shadow: inset 0 0 0 0 #111;
            -webkit-transition: ease-out 0.6s;
            -moz-transition: ease-out 0.6s;
            transition: ease-out 0.6s;
        }

        .blog-btn:hover {
            box-shadow: inset 400px 0 0 0 #111;
            color: #fff;

        }

        .top-payment img {

            margin-top: -11px !important;
        }
    </style>
@endsection
@section('content')
    @include('layouts.navbar')
    <?php
    $action = 'Add';
    $href = "/blog/add";

    if (isset($blog)) {
        $action = 'Edit';
        $href = "/blog/update/" . $blog->id;
    }
    ?>
    <div class="section-title-black mt-30">
        <h2>{{$action}} Blog</h2>
        <div class="title-bg">
            <span class="line-bg"></span>
            <span class="line-bg"></span>
            <span class="line-bg"></span>
            <span class="line-bg"></span>
            <span class="line-bg"></span>
        </div>
    </div>
    <section class="add-blog-section mb-30">
        <div class="container">

            <form action="{{$href}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <div class="form-group">
                            <label><strong>Blog Title</strong></label>
                            <input name="title" placeholder="Your Blog Title" id="title" type="text"
                                   class="validate form-control"
                                   value="<?php echo (isset($blog)) ? $blog->title : '' ?>">
                        </div>
                        <div class="form-group">
                            <label><strong>Description</strong></label>
                            <textarea name="description" id="textarea1" class="my-editor">
                            <?php echo (isset($blog)) ? $blog->article : '' ?>
                        </textarea>
                        </div>
                        <div class="form-group">
                            <button class="blog-btn" type="submit">Submit</button>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="blog-category">
                            <div class="inner-package-head-title mb-20"><h3>Blog Category</h3></div>
                            @foreach($categories as $category)

                                <p><input name="categories[]" class="filled-in" type="checkbox"
                                          id="{{$category->title}}"
                                          value="{{$category->id}}"
                                    <?php $category =;$blog_categories =;echo (isset($blog) && (in_array($category->id, $blog_categories))) ? 'checked' : '' ?>/>
                                    <label for="{{$category->title}}">{{$category->title}}</label></p>
                            @endforeach
                            <div class="form-group">
                                <label><strong>Cover Image</strong></label>
                                @if(isset($blog) && ($blog->cover_image != null))
                                    <img data-src="{{'/images/blogs/'.$blog->cover_image}}" style="max-height: 200px;"
                                         alt="cover image for blog" class="lazyload">
                                    <br>
                                    <br>
                                @endif
                                <input type="file" class="form-control" name="cover_image"
                                       <?php echo (!isset($blog)) ? 'required' : '' ?> accept="image/*">
                            </div>
                            <div class="form-group">
                                <label><strong>Other Image</strong></label>
                                @if(isset($blog) && (count($blog->images) > 0))
                                    <div class="row otherImages">
                                        @foreach($blog->images as $image)
                                            <button type="button" class="btn deleteButton white" title="Delete Image"
                                                    value="{{$image->id}}">
                                                <i class="material-icons" style="color: red">delete</i>
                                            </button>
                                            <img class="otherImage"
                                                 data-src="{{url('/images/blogs/images/'.$image->image)}}"
                                                 class="l4 s6 m4" alt="Blog Image" style="max-height: 150px">
                                        @endforeach
                                    </div>
                                @endif
                                <input class="form-control" name="other_images[]" type="file" multiple accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        var editor_config = {
            height: "300px",
            path_absolute: "/",
            selector: "textarea.my-editor",
            plugins: [
                "emoticons help imagetools toc fullpage codesample advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "paste | textcolor | emoticons | imageupload | formatselect | insertfile undo redo | styleselect | bold italic strikethrough forecolor backcolor|" +
                " alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | removeformat",
            paste_data_images: true,
            paste_word_valid_elements: "b,strong,i,em,h1,h2",
            paste_retain_style_properties: "color font-size",
            paste_as_text: true,
            relative_urls: false,
            image_advtab: true,
            setup: function (editor) {
                var inp = $('<input id="tinymce-uploader" type="file" name="pic" accept="image/*" style="display:none">');
                $(editor.getElement()).parent().append(inp);

                inp.on("change", function () {
                    var input = inp.get(0);
                    var file = input.files[0];
                    var fr = new FileReader();
                    fr.onload = function () {
                        var img = new Image();
                        img.src = fr.result;
                        editor.insertContent('<img src="' + img.src + '"/>');
                        inp.val('');
                    };
                    fr.readAsDataURL(file);
                });
                editor.addButton('imageupload', {
                    text: "Image",
                    icon: false,
                    onclick: function (e) {
                        inp.trigger('click');
                    }
                });
            }
        };
        tinymce.init(editor_config);

    </script>
@endsection
