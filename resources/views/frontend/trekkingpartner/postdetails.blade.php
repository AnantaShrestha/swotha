@extends('layouts.master')

@section('title')
    <title> Find Travel Partner | Swotah Travel and Adventure</title>
@endsection

@section('metatags')
    <meta name="title" content="Find Travel Partner | Swotah Travel and Adventure">
    <meta name="description" content="Swotah Travel and Adventure Pvt. Ltd. is an Adventure-based Travel and Trekking Company in Kathmandu, Nepal.">
    <meta name="keywords" content="Nepal, Kathmandu, Trekking in nepal, Nepal travel, Adventure, Mountains, Tours">
@endsection

@section('styles')
    <link rel="stylesheet" href="{{url('css/frontend/index.css')}}">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <style type="text/css">
        .trippartnerSideTable tr td{
            padding:  5px 20px!important;
        }

        .userImage{
            width: 80px;
            height: 80px;
            border-radius: 80px;
        }

        .tableBtn{
            padding:2px 10px;
            font-size: 14px;
            color: white;
            background:#00B1FF ;
        }
    </style>
@endsection
@section('content')
    @include('layouts.navbar2')
    <div class="containerPadding" >
        <h1  class="titleHeadtwo" style="margin-top: 60px;"> <span class="reviewTitle"> {{$post->trip->name}} </span> </h1>
        <div class="row">
            <div class="col l8 m8 s12">
                <?php
                $photo = 'default.jpg';

                if(($post->user->photo != null)){
                    $photo = $post->user->photo;
                }
                ?>
                <div class="card" style="border: 1px solid #dbdbdb;">
                    <div class="card-content black-text">
                        <div class="row">
                            <div class="col l3 m3 s12">
                                 <a href="/partner/profile/{{$post->user_id}}">
                                    <img data-src="{{url('/images/profile/'.$photo)}}" class="p-img userImage lazyload" style="margin-left: 0;" alt="{{$post->user->name}}">
                                </a>
                            </div>
                            <div class="col l9 m9 s12" style="color: black;">
                                <p> <a href="/partner/profile/{{$post->user_id}}">
                                    {{$post->user->name}} </a>
                                    <span style="margin-left: 10px; color:#555454; font-size: 14px;">
                                         {{\Carbon\Carbon::parse($post->created_at)->diffForHumans(\Carbon\Carbon::now())}}
                                    </span>
                                </p>
                                <p style="font-weight: normal;font-size:18px;line-height: 20px;font-family:
                                    Sans serif;">
                                    {{$post->requirements->description}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        @if(Auth::user() && Auth::user()->is_active == 1)
                            <a class="btn-floating btn-medium waves-effect waves-light blue modal-trigger tooltipped"
                               href="#comment{{$post->id}}" data-position="top" data-tooltip="Comment on this post">
                                <i class="material-icons">comment</i>
                            </a>
                        @elseif(Auth::user() && Auth::user()->is_active == 0)
                            Please <a href="/profile/edit/resendprimary/{{Auth::user()->id}}" style="font-size: 18px;">Verify</a> your account to comment and reply.
                        @else
                            Please <a href="/login" style="font-size: 18px;">Log in</a> to comment and reply.
                        @endif

                        @if((Auth::user()) && ((Auth::user()->id) == ($post->user->id)))
                            <a class="btn-floating btn-medium waves-effect waves-light red modal-trigger tooltipped"
                               href="/partner/deletePost/{{$post->id}}" data-position="top" data-tooltip="Delete this comment"
                                onclick="return(confirm('Are you sure you want to delete this post?'))">
                                <i class="material-icons">delete</i>
                            </a>
                        @endif
                    </div>
                    <div id="comment{{$post->id}}" class="modal">
                        <form action="/partner/comment/{{$post->id}}" method="post">
                            {{csrf_field()}}
                            <div class="modal-content">
                                <h5>Comment on this post</h5>
                                <div class="input-field col s12">
                                    <textarea id="textarea11" name="comment" class="materialize-textarea"
                                              style="color:black"></textarea>
                                    <label for="textarea11">Your Comment</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="waves-effect waves-light btn blue">Comment</button>
                            </div>
                        </form>
                    </div>
                </div>
                    @foreach($post->comments as $comment)
                    <div class="card <?php echo (Auth::user()&&Auth::user()->id==$comment->user_id)?' ':'' ?>" style="margin-left: 5%">
                        <div class="card-content black-text">
	                        <?php
                            $commentphoto = 'default.jpg';
                            if(($comment->user->photo != null)){
		                        $commentphoto = $comment->user->photo;
	                        }
	                        ?>
                            <div class="row">
                                <div class="col l3 m3 s12">
                                     <a href="/partner/profile/{{$comment->user_id}}">
                                        <img data-src="{{url('/images/profile/'.$commentphoto)}}" class="c-img userImage lazyload" style="margin-left: 0px;" alt="{{$comment->user->name}}">
                                    </a>
                                </div>
                                <div class="col l9 m9 s12" style="color: black;">
                                    <p> <a href="/partner/profile/{{$comment->user_id}}">
                                        {{$comment->user->name}} </a>
                                        <span style="margin-left: 10px; color:#555454; font-size: 14px;">
                                            {{\Carbon\Carbon::parse($comment->created_at)->diffForHumans(\Carbon\Carbon::now())}}
                                        </span>
                                    </p>
                                    <p style="font-weight: normal;font-size:18px;line-height: 20px;font-family:
                                        Sans serif;">
                                        {{$comment->comment}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            @if(Auth::user() && Auth::user()->is_active == 1)
                                <a class="btn-floating btn-medium waves-effect waves-light blue modal-trigger tooltipped"
                                   href="#reply{{$comment->id}}" data-position="top" data-tooltip="Reply to this comment">
                                    <i class="material-icons">reply</i>
                                </a>
                            @elseif(Auth::user() && Auth::user()->is_active == 0)
                                Please <a href="/profile/edit/resendprimary/{{Auth::user()->id}}" style="font-size: 18px;">Verify</a> your account to comment and reply.
                            @else
                                Please <a href="/login" style="font-size: 18px;">Log in</a> to comment and reply.
                            @endif
                            @if(Auth::user() && (Auth::user()->id == $comment->user_id))
                            <a class="btn-floating btn-medium waves-effect waves-light green modal-trigger tooltipped"
                               href="#editComment{{$comment->id}}" data-position="top" data-tooltip="Edit this comment">
                                <i class="material-icons">edit</i>
                            </a>
                            <a class="btn-floating btn-medium waves-effect waves-light red modal-trigger tooltipped"
                               href="/partner/deleteComment/{{$comment->id}}" data-position="top"
                               data-tooltip="Delete this comment" onclick="return(confirm('Are you sure you want to delete this comment?'))">
                                <i class="material-icons">delete</i>
                            </a>
                            @endif
                        </div>
                        <div id="reply{{$comment->id}}" class="modal">
                            <form action="/partner/reply/{{$comment->id}}" method="post">
                                {{csrf_field()}}
                                <div class="modal-content">
                                    <h5>Reply to this post</h5>
                                    <div class="input-field col s12">
                                        <textarea id="textarea1" name="reply" class="materialize-textarea" style="color:black"></textarea>
                                        <label for="textarea1">Your reply</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="waves-effect waves-light btn blue">Reply</button>
                                </div>
                            </form>
                        </div>
                        <div id="editComment{{$comment->id}}" class="modal">
                            <form action="/partner/comment/edit/{{$comment->id}}" method="post">
                                {{csrf_field()}}
                                <div class="modal-content">
                                    <h5>Edit your comment</h5>
                                    <div class="input-field col s12">
                                        <textarea id="textarea1" name="comment" class="materialize-textarea" style="color:black" required>
                                            {{$comment->comment}}
                                        </textarea>
                                        <label for="textarea1">Your Comment</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="waves-effect waves-light btn blue">Reply</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @foreach($comment->replies as $reply)
                        {{--This is reply--}}
                        <div class="card <?php echo (Auth::user()&&Auth::user()->id==$reply->user_id)?' ':'' ?>" style="margin-left: 8%;">
                            <div class="card-content black-text">
	                            <?php
	                            $replyphoto = 'default.jpg';
	                            if(($reply->user->photo != null)){
                                    $replyphoto = $reply->user->photo;
	                            }
	                            ?>
                                <div class="row">
                                    <div class="col l3 m3 s12">
                                         <a href="/partner/profile/{{$reply->user_id}}">
                                            <img data-src="{{url('/images/profile/'.$replyphoto)}}" class="c-img userImage lazyload" style="margin-left: 0px;" alt="{{$reply->user->name}}">
                                        </a>
                                    </div>
                                    <div class="col l9 m9 s12" style="color: black;">
                                        <p> <a href="/partner/profile/{{$reply->user_id}}">
                                            {{$reply->user->name}}</a>
                                            <span style="margin-left: 10px; color:#555454; font-size: 14px;">
                                               {{\Carbon\Carbon::parse($reply->created_at)->diffForHumans(\Carbon\Carbon::now())}}
                                            </span>
                                        </p>
                                        <p style="font-weight: normal;font-size:18px;line-height: 20px;font-family:
                                            Sans serif;">
                                            {{$reply->reply}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @if(Auth::user() && (Auth::user()->id == $reply->user_id))
                            <div class="card-action">
                                <a class="btn-floating btn-medium waves-effect waves-light green modal-trigger tooltipped"
                                   href="#editReply{{$reply->id}}" data-position="top" data-tooltip="Edit this reply">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a class="btn-floating btn-medium waves-effect waves-light red modal-trigger tooltipped"
                                   href="/partner/deleteReply/{{$reply->id}}" data-position="top"
                                   data-tooltip="Delete this reply" onclick="return confirm('Are you sure you want to delete this reply?')">
                                    <i class="material-icons">delete</i>
                                </a>
                            </div>
                            @endif
                            <div id="editReply{{$reply->id}}" class="modal">
                                <form action="/partner/reply/edit/{{$reply->id}}" method="post">
                                    {{csrf_field()}}
                                    <div class="modal-content">
                                        <h5>Edit your Reply</h5>
                                        <div class="input-field col s12">
                                        <textarea id="textarea1" name="reply" class="materialize-textarea" style="color:black" required>
                                            {{$reply->reply}}
                                        </textarea>
                                            <label for="textarea1">Your Reply</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="waves-effect waves-light btn blue">Reply</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
            <div class="col l4 m4 s12" style="padding: 0px 20px;position: sticky;top:40px;">
                <div class="card con " style="margin-top: -21px;">
                    <h2 style="background: black;color: white;font-size: 18px;padding: 5px;">Partner Preference</h2>
                    <table class="bordered trippartnerSideTable" id="">
                        <tr>
                            <td class="s-fons">Preferred Age</td>
                            <td>{{$post->requirements->age}}</td>
                        </tr>
                        <tr>
                            <td class="s-fons">Preferred Nationalities</td>
                            <td>{{$post->requirements->nationalities}}</td>
                        </tr>
                        <tr>
                            <td class="s-fons">Preferred Gender</td>
                            <td>{{$post->requirements->gender}}</td>
                        </tr>
                    </table>

                    <div class="" style="padding: 10px;text-align: center;">
                        <?php
                        if($post->book_id == 0){
                            $href = '/book/'.$post->tripdate_id;
                        } else {
                            $href = '/trip/book/'.$post->trip_id;
                        }
                        ?>
                        <a href="{{$href}}"class="trippartnerTableContent waves-effect waves-light tableBtn"><i class="material-icons right" style="color:white">group_add</i>Book</a>
                    </div>
                </div>
                <div class="card con ">
                    <h2 style="background: black;color: white;font-size: 18px;padding: 5px;">Trip Details</h2>
                    <table class="bordered trippartnerSideTable">
                        <tr>
                            <td class="s-fons">Date</td>
                            <td>{{$post->tripdate->start_date or 'NA'}}</td>
                        </tr>
                        <tr>
                            <td class="s-fons">Pax</td>
                            <td>{{$post->bookingDetail->people or 'NA'}}</td>
                        </tr>
                        <tr>
                            <td class="s-fons">Days</td>
                            <td>{{$post->trip->days}}</td>
                        </tr>
                        <tr>
                            <td class="s-fons">Start Location</td>
                            <td>{{$post->trip->start_location}}</td>
                        </tr>
                        <tr>
                            <td class="s-fons">Finish Location</td>
                            <td>{{$post->trip->finish_location}}</td>
                        </tr>
                        <tr>
							<?php
							switch ($post->trip->physical_rating) {
								case 1:
									$difficulty = 'easy';
									break;
								case 2:
									$difficulty = 'moderate';
									break;
								case 3:
									$difficulty = 'hard';
									break;
								case 4:
									$difficulty = 'Severe';
									break;
								case 5:
									$difficulty = 'Very Severe';
									break;
								default:
									$difficulty = 'Extreme';
							}
							?>
                            <td class="s-fons">Difficulty</td>
                            <td>{{ucwords($difficulty)}}</td>
                        </tr>
                        <tr>
                            <td class="s-fons">Min-age</td>
                            <td>{{$post->trip->ages}}</td>
                        </tr>
                        <tr>
                            <td class="s-fons">Max-Altitude</td>
                            <td>{{$post->trip->altitude}} m</td>
                        </tr>
                       
                    </table>

                    <div style="padding: 20px;text-align: center;">
                        <a href="/trip/{{$post->trip->slug}}" target="_blank" class="trippartnerTableContent waves-effect waves-light tableBtn">View Trip </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>
    @include('layouts.footer1')
@endsection
