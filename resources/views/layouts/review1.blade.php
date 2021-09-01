<style xmlns:v-bind="http://www.w3.org/1999/xhtml">

    #carouselNReview .card .row{
        margin-bottom: 0;
    }
    #carouselContainer .carousel{
        -webkit-perspective: 1700px;
        perspective: 1700px;
    }



    #carouselContainer .carousel-item{
        width:400px;
        height: 100%;
        opacity: 1 !important;
        color: #FFF;
    }

    #reviewCarouselModal .modal{
        height:100% !important;
    }


    #carouselNReview .card .card-content {
        padding: 5px 15px;
    }

    #carouselNReview .card .card-content .card-title {
        margin-bottom: 0px;
    }

    #carouselNReview .card .card-content h5{
        margin:5px;
    }

    #carouselNReview .card .card-content h5>span{
        margin: 1px;
    }
    .review-content{
        text-align:justify;
    }

    /*#carouselNReview .modal-content {*/
        /*padding: 5px 15px;*/
    /*}*/

    /*#carouselNReview .modal-content .card-title {*/
        /*margin-bottom: 0px;*/
    /*}*/

    /*#carouselNReview .modal-content h5{*/
        /*margin:5px;*/
    /*}*/

    /*#carouselNReview .modal-content h5>span{*/
        /*margin: 1px;*/
    /*}*/
    
    #carouselContainer button{
        background:none!important;
        color:inherit;
        border:none;
        padding:0!important;
        font: inherit;
        /*border-bottom:1px solid #444;*/
        cursor: pointer;
        box-shadow: none;
    }

    #carouselContainer button:hover{
        font-size: large;
    }


</style>

<div id="carouselNReview">
    <div class="container-fluid" id="carouselContainer">
    <div class="container">
        <div class = "title-wrapper1">
            <span class="title teal">
                <span class="flow-text" style="color: white;">
                What clients say about us
                </span>
            </span>
        </div>
    </div>
    <div class="carousel " style="">
        <a class="carousel-item " href="#one!">
            <div class="card " style="background-color: #23334B!important;">
                 <div class="card-content">
                     <span class="card-title center-align">Magnificient Mustang</span>
                     <hr>

                     <h5 class = "center-align">Overall Ratings</h5>
                     <div class="row">
                         <div class="col l6 m6 s6">
                             <h5 class = "center-align">
                                 <span class = "stars">
                                     <i class="material-icons">star_border</i>
                                     <i class="material-icons">star_border</i>
                                     <i class="material-icons">star_border</i>
                                     <i class="material-icons">star_border</i>
                                </span>
                             </h5>
                         </div>
                         <div class="col l6 m6 s6">
                            <h5 class="center-align"><span>4.1</span></h5>
                         </div>
                     </div>

                     <hr>
                     <div class="row ">
                        <span class="review-content">
                            Swotah made this journey to Mustang an unforgettable one.
                            Great staff, guide and great management. We are coming again in March 2018.
                            Highly recommend everyone willing to travel in Nepal.
                            We would like to be in a group next time even though it was a solo trip for me this time....
                        </span>
                         <span>
                                <button class="btn modal-trigger" data-target="modal1" v-bind:title='viewMore'>view more</button>
                         </span>
                     </div>
                     <hr>
                     <div class="row">
                         <div class="col s7">
                             <span class = "center-align"><img id = "flag" src="" alt="flag"></span>
                             <span>Review by:</span>
                             <span>Mr. Jack Sparrow</span>
                         </div>
                         <div class="col s5">
                             <span class = "right">Reviewed on July 30,1995</span>
                         </div>
                     </div>
                 </div>
            </div>
        </a>
        <a class="carousel-item"  href="#two!">
            <div class="card " style="background-color: #23334B!important;">
                <div class="card-content">
                    <span class="card-title center-align">Magnificient Mustang</span>
                    <hr>

                    <h5 class = "center-align">Overall Ratings</h5>
                    <div class="row">
                        <div class="col l6 m6 s6">
                            <h5 class = "center-align">
                                 <span class = "stars">
                                     <i class="material-icons">star_border</i>
                                     <i class="material-icons">star_border</i>
                                     <i class="material-icons">star_border</i>
                                     <i class="material-icons">star_border</i>
                                </span>
                            </h5>
                        </div>
                        <div class="col l6 m6 s6">
                            <h5 class="center-align"><span>4.1</span></h5>
                        </div>
                    </div>

                    <hr>
                    <div class="row ">
                        <span class="review-content">
                            Swotah made this journey to Mustang an unforgettable one.
                            Great staff, guide and great management. We are coming again in March 2018.
                            Highly recommend everyone willing to travel in Nepal.
                            We would like to be in a group next time even though it was a solo trip for me this time...
                        </span>
                        <span>
                            <button class="btn modal-trigger" data-target="modal2" v-bind:title='viewMore'>view more</button>
                         </span>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col s7">
                            <span class = "center-align"><img id = "flag" src="" alt="flag"></span>
                            <span>Review by:</span>
                            <span>Mr. Jack Sparrow</span>
                        </div>
                        <div class="col s5">
                            <span class = "right">Reviewed on July 30,1995</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        <a class="carousel-item"  href="#three!">
            <div class="card " style="background-color: #23334B!important;">
                <div class="card-content">
                    <span class="card-title center-align">Magnificient Mustang</span>
                    <hr>

                    <h5 class = "center-align">Overall Ratings</h5>
                    <div class="row">
                        <div class="col l6 m6 s6">
                            <h5 class = "center-align">
                                 <span class = "stars">
                                     <i class="material-icons">star_border</i>
                                     <i class="material-icons">star_border</i>
                                     <i class="material-icons">star_border</i>
                                     <i class="material-icons">star_border</i>
                                </span>
                            </h5>
                        </div>
                        <div class="col l6 m6 s6">
                            <h5 class="center-align"><span>4.1</span></h5>
                        </div>
                    </div>

                    <hr>
                    <div class="row ">
                        <span class="review-content">
                            Swotah made this journey to Mustang an unforgettable one.
                            Great staff, guide and great management. We are coming again in March 2018.
                            Highly recommend everyone willing to travel in Nepal.
                            We would like to be in a group next time even though it was a solo trip for me this time....
                        </span>
                        <span>
                                <button class="modal-trigger" data-target="modal3" v-bind:title='viewMore'>view more</button>
                         </span>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col s7">
                            <span class = "center-align"><img id = "flag" src="" alt="flag"></span>
                            <span>Review by:</span>
                            <span>Mr. Jack Sparrow</span>
                        </div>
                        <div class="col s5">
                            <span class = "right">Reviewed on July 30,1995</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        <a class="carousel-item"  href="#four!">
            <div class="card " style="background-color: #23334B!important;">
                <div class="card-content">
                    <span class="card-title center-align">Magnificient Mustang</span>
                    <hr>

                    <h5 class = "center-align">Overall Ratings</h5>
                    <div class="row">
                        <div class="col l6 m6 s6">
                            <h5 class = "center-align">
                                 <span class = "stars">
                                     <i class="material-icons">star_border</i>
                                     <i class="material-icons">star_border</i>
                                     <i class="material-icons">star_border</i>
                                     <i class="material-icons">star_border</i>
                                </span>
                            </h5>
                        </div>
                        <div class="col l6 m6 s6">
                            <h5 class="center-align"><span>4.1</span></h5>
                        </div>
                    </div>

                    <hr>
                    <div class="row ">
                        <span class="review-content">
                            Swotah made this journey to Mustang an unforgettable one.
                            Great staff, guide and great management. We are coming again in March 2018.
                            Highly recommend everyone willing to travel in Nepal.
                            We would like to be in a group next time even though it was a solo trip for me this time....
                        </span>
                        <span>
                                <button class="btn modal-trigger" data-target="modal4">view more</button>
                         </span>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col s7">
                            <span class = "center-align"><img id = "flag" src="" alt="flag"></span>
                            <span>Review by:</span>
                            <span>Mr. Jack Sparrow</span>
                        </div>
                        <div class="col s5">
                            <span class = "right">Reviewed on July 30,1995</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        <a class="carousel-item"  href="#five!">
            <div class="card " style="background-color: #23334B!important;">
                <div class="card-content">
                    <span class="card-title center-align">Magnificient Mustang</span>
                    <hr>

                    <h5 class = "center-align">Overall Ratings</h5>
                    <div class="row">
                        <div class="col l6 m6 s6">
                            <h5 class = "center-align">
                                 <span class = "stars">
                                     <i class="material-icons">star_border</i>
                                     <i class="material-icons">star_border</i>
                                     <i class="material-icons">star_border</i>
                                     <i class="material-icons">star_border</i>
                                </span>
                            </h5>
                        </div>
                        <div class="col l6 m6 s6">
                            <h5 class="center-align"><span>4.1</span></h5>
                        </div>
                    </div>

                    <hr>
                    <div class="row ">
                        <span class="review-content">
                            Swotah made this journey to Mustang an unforgettable one.
                            Great staff, guide and great management. We are coming again in March 2018.
                            Highly recommend everyone willing to travel in Nepal.
                            We would like to be in a group next time even though it was a solo trip for me this time....
                        </span>
                        <span>
                                <button class="btn modal-trigger" data-target="modal5" v-bind:title='viewMore'>view more</button>
                         </span>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col s7">
                            <span class = "center-align"><img id = "flag" src="" alt="flag"></span>
                            <span>Review by:</span>
                            <span>Mr. Jack Sparrow</span>
                        </div>
                        <div class="col s5">
                            <span class = "right">Reviewed on July 30,1995</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
    <div id="reviewCarouselModal">

        <div id="modal1" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="card blue-grey darken-1  z-depth-5" style="background-color: #23334B!important;">
                    <div class="card-content white-text">
                        <span class="card-title center-align">Magnificient Mustang</span>
                        <hr>

                        <h5 class = "center-align">Overall Ratings</h5>
                        <div class="row">
                            <div class="col l6 m6 s6">
                                <h5 class = "center-align">
                                         <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>
                                </h5>
                            </div>
                            <div class="col l6 m6 s6">
                                <h5 class="center-align"><span>5</span></h5>
                            </div>
                        </div>


                        <div class="row ratings">
                            <div class="col l4 m6 s12">
                                <span class = "rate">Staff</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                     </span>

                                </div>
                            </div>
                            <div class="col l4 m6 s12">
                                <span class = "rate">Price Value</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>

                                </div>
                            </div>
                            <div class="col l4 m6 s12">
                                <span class = "rate">Meals</span><br>
                                <div class="rate">

                                   <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>

                                </div>
                            </div>
                            <div class="col l4 m6 s12">
                                <span>Accomodation</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>


                                </div>
                            </div>
                            <div class="col l4 m6 s12">
                                <span>Transportation</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>

                                </div>

                            </div>
                            <div class="col l4 m6 s12">
                                <span class = "rate">Guides & Porters</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>

                                </div>

                            </div>
                            <div class="col l4 m6 s12">
                                <span>All in all</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div >
                                Swotah made this journey to Mustang an unforgettable one.
                                Great staff, guide and great management. We are coming again in March 2018.
                                Highly recommend everyone willing to travel in Nepal.
                                We would like to be in a group next time even though it was a solo trip for me this time.
                            </div>
                        </div>
                        <hr>
                        <span class = "center-align"><img id = "flag" src="" alt=""></span>
                        <span>Review by:</span>
                        <span>Mr. Jack Sparrow</span>
                        <span class = "right">Reviewed on 11July, 2020</span>
                    </div>
                    <div class="card-action center-align">
                        <a href="/trip/#">
                            UPPER MUSTANG
                        </a>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
            </div>
        </div>

        <div id="modal2" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="card blue-grey darken-1  z-depth-5" style="background-color: #23334B!important;">
                    <div class="card-content white-text">
                        <span class="card-title center-align">Magnificient Mustang</span>
                        <hr>
                        <div class = "container">
                            <h5 class = "center-align">Overall Ratings</h5>
                            <div class="row">
                                <div class="col l6 m6 s6">
                                    <h5 class = "center-align">
                                         <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>
                                    </h5>
                                </div>
                                <div class="col l6 m6 s6">
                                    <h5 class="center-align"><span>5</span></h5>
                                </div>
                            </div>
                        </div>

                        <div class="row ratings">
                            <div class="col l4 m6 s12">
                                <span class = "rate">Staff</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                     </span>

                                </div>
                            </div>
                            <div class="col l4 m6 s12">
                                <span class = "rate">Price Value</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>

                                </div>
                            </div>
                            <div class="col l4 m6 s12">
                                <span class = "rate">Meals</span><br>
                                <div class="rate">

                                   <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>

                                </div>
                            </div>
                            <div class="col l4 m6 s12">
                                <span>Accomodation</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>


                                </div>
                            </div>
                            <div class="col l4 m6 s12">
                                <span>Transportation</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>

                                </div>

                            </div>
                            <div class="col l4 m6 s12">
                                <span class = "rate">Guides & Porters</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>

                                </div>

                            </div>
                            <div class="col l4 m6 s12">
                                <span>All in all</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div >
                                Swotah made this journey to Mustang an unforgettable one.
                                Great staff, guide and great management. We are coming again in March 2018.
                                Highly recommend everyone willing to travel in Nepal.
                                We would like to be in a group next time even though it was a solo trip for me this time.
                            </div>
                        </div>
                        <hr>
                        <span class = "center-align"><img id = "flag" src="" alt=""></span>
                        <span>Review by:</span>
                        <span>Mr. Jack Sparrow</span>
                        <span class = "right">Reviewed on 11July, 2020</span>
                    </div>
                    <div class="card-action center-align">
                        <a href="/trip/#">
                            UPPER MUSTANG
                        </a>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
            </div>
        </div>
        <div id="modal3" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="card blue-grey darken-1  z-depth-5" style="background-color: #23334B!important;">
                    <div class="card-content white-text">
                        <span class="card-title center-align">Magnificient Mustang</span>
                        <hr>
                        <div class = "container">
                            <h5 class = "center-align">Overall Ratings</h5>
                            <div class="row">
                                <div class="col l6 m6 s6">
                                    <h5 class = "center-align">
                                         <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>
                                    </h5>
                                </div>
                                <div class="col l6 m6 s6">
                                    <h5 class="center-align"><span>5</span></h5>
                                </div>
                            </div>
                        </div>

                        <div class="row ratings">
                            <div class="col l4 m6 s12">
                                <span class = "rate">Staff</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                     </span>

                                </div>
                            </div>
                            <div class="col l4 m6 s12">
                                <span class = "rate">Price Value</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>

                                </div>
                            </div>
                            <div class="col l4 m6 s12">
                                <span class = "rate">Meals</span><br>
                                <div class="rate">

                                   <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>

                                </div>
                            </div>
                            <div class="col l4 m6 s12">
                                <span>Accomodation</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>


                                </div>
                            </div>
                            <div class="col l4 m6 s12">
                                <span>Transportation</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>

                                </div>

                            </div>
                            <div class="col l4 m6 s12">
                                <span class = "rate">Guides & Porters</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>

                                </div>

                            </div>
                            <div class="col l4 m6 s12">
                                <span>All in all</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div >
                                Swotah made this journey to Mustang an unforgettable one.
                                Great staff, guide and great management. We are coming again in March 2018.
                                Highly recommend everyone willing to travel in Nepal.
                                We would like to be in a group next time even though it was a solo trip for me this time.
                            </div>
                        </div>
                        <hr>
                        <span class = "center-align"><img id = "flag" src="" alt=""></span>
                        <span>Review by:</span>
                        <span>Mr. Jack Sparrow</span>
                        <span class = "right">Reviewed on 11July, 2020</span>
                    </div>
                    <div class="card-action center-align">
                        <a href="/trip/#">
                            UPPER MUSTANG
                        </a>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
            </div>
        </div>
        <div id="modal4" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="card blue-grey darken-1  z-depth-5" style="background-color: #23334B!important;">
                    <div class="card-content white-text">
                        <span class="card-title center-align">Magnificient Mustang</span>
                        <hr>
                        <div class = "container">
                            <h5 class = "center-align">Overall Ratings</h5>
                            <div class="row">
                                <div class="col l6 m6 s6">
                                    <h5 class = "center-align">
                                         <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>
                                    </h5>
                                </div>
                                <div class="col l6 m6 s6">
                                    <h5 class="center-align"><span>5</span></h5>
                                </div>
                            </div>
                        </div>

                        <div class="row ratings">
                            <div class="col l4 m6 s12">
                                <span class = "rate">Staff</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                     </span>

                                </div>
                            </div>
                            <div class="col l4 m6 s12">
                                <span class = "rate">Price Value</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>

                                </div>
                            </div>
                            <div class="col l4 m6 s12">
                                <span class = "rate">Meals</span><br>
                                <div class="rate">

                                   <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>

                                </div>
                            </div>
                            <div class="col l4 m6 s12">
                                <span>Accomodation</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>


                                </div>
                            </div>
                            <div class="col l4 m6 s12">
                                <span>Transportation</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>

                                </div>

                            </div>
                            <div class="col l4 m6 s12">
                                <span class = "rate">Guides & Porters</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>

                                </div>

                            </div>
                            <div class="col l4 m6 s12">
                                <span>All in all</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div >
                                Swotah made this journey to Mustang an unforgettable one.
                                Great staff, guide and great management. We are coming again in March 2018.
                                Highly recommend everyone willing to travel in Nepal.
                                We would like to be in a group next time even though it was a solo trip for me this time.
                            </div>
                        </div>
                        <hr>
                        <span class = "center-align"><img id = "flag" src="" alt=""></span>
                        <span>Review by:</span>
                        <span>Mr. Jack Sparrow</span>
                        <span class = "right">Reviewed on 11July, 2020</span>
                    </div>
                    <div class="card-action center-align">
                        <a href="/trip/#">
                            UPPER MUSTANG
                        </a>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
            </div>
        </div>
        <div id="modal5" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="card blue-grey darken-1  z-depth-5" style="background-color: #23334B!important;">
                    <div class="card-content white-text">
                        <span class="card-title center-align">Magnificient Mustang</span>
                        <hr>
                        <div class = "container">
                            <h5 class = "center-align">Overall Ratings</h5>
                            <div class="row">
                                <div class="col l6 m6 s6">
                                    <h5 class = "center-align">
                                         <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>
                                    </h5>
                                </div>
                                <div class="col l6 m6 s6">
                                    <h5 class="center-align"><span>5</span></h5>
                                </div>
                            </div>
                        </div>

                        <div class="row ratings">
                            <div class="col l4 m6 s12">
                                <span class = "rate">Staff</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                     </span>

                                </div>
                            </div>
                            <div class="col l4 m6 s12">
                                <span class = "rate">Price Value</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>

                                </div>
                            </div>
                            <div class="col l4 m6 s12">
                                <span class = "rate">Meals</span><br>
                                <div class="rate">

                                   <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>

                                </div>
                            </div>
                            <div class="col l4 m6 s12">
                                <span>Accomodation</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>


                                </div>
                            </div>
                            <div class="col l4 m6 s12">
                                <span>Transportation</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>

                                </div>

                            </div>
                            <div class="col l4 m6 s12">
                                <span class = "rate">Guides & Porters</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>

                                </div>

                            </div>
                            <div class="col l4 m6 s12">
                                <span>All in all</span><br>
                                <div class="rate">

                                     <span class = "stars">
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                             <i class="material-icons">star_border</i>
                                        </span>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div style="">
                                Swotah made this journey to Mustang an unforgettable one.
                                Great staff, guide and great management. We are coming again in March 2018.
                                Highly recommend everyone willing to travel in Nepal.
                                We would like to be in a group next time even though it was a solo trip for me this time.
                            </div>
                        </div>
                        <hr>
                        <span class = "center-align"><img id = "flag" src="" alt=""></span>
                        <span>Review by:</span>
                        <span>Mr. Jack Sparrow</span>
                        <span class = "right">Reviewed on 11July, 2020</span>
                    </div>
                    <div class="card-action center-align">
                        <a href="/trip/#">
                            UPPER MUSTANG
                        </a>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
            </div>
        </div>


    </div>

</div>

