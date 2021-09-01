<section class="compare-section">
  <div class="container">
    <div class="section-title-black">
     <h2>{{$parallaxes[1]->title}}</h2>
     <div class="title-bg">
      <span class="line-bg"></span>
      <span class="line-bg"></span>
      <span class="line-bg"></span>
      <span class="line-bg"></span>
      <span class="line-bg"></span>
    </div>
    <p>{{$parallaxes[1]->description}}</p>
  </div>
</div>
<div class="combine-compare">
  <div id="compare-slider" class="compare-slider">
    @foreach($oneTrips as $key=>$value)
    <div class="compare-item">
      <div class="compare-wrapper">
        <div class="compare-image" style="width:300px">
          <a href="/{{$value['slug']}}" target="_blank">
            <img src="{{url('/images/trips/thumbnail/'.$value['cover_image'])}}" data-src="{{url('/images/trips/thumbnail/'.$value['cover_image'])}}"
            alt="{{$value['name']}}" width="100%" class="lazyload blur-up tran_scale"></a>
            <div class="compare-title">
              <a href="/{{$value['slug']}}" target="_blank"><h3>{{$value['name']}}</h3></a>
            </div>
            {{-- <div  class="compare-checkbox">
             <p><input title="Compare" class="filled-in compareCheckbox" type="checkbox" id="{{$value['id']}}"
               onchange="compareTo('{{$value['id']}}',this)"/>&nbsp;&nbsp;Compare</p>
             </div>--}}
           </div>
         </div>
       </div>
         @endforeach
         @foreach($secondTrips as $key=>$value)
      
           <div class="compare-item">
            <div class="compare-wrapper">
              <div class="compare-image" style="width:300px">
                <a href="/{{$value['slug']}}" target="_blank">
                  <img src="{{url('/images/trips/thumbnail/'.$value['cover_image'])}}"
                  data-src="{{url('/images/trips/thumbnail/'.$value['cover_image'])}}"
                  alt="{{$value['name']}}" width="100%" class="lazyload blur-up tran_scale"></a>
                  <div class="compare-title">
                    <a href="/{{$value['slug']}}" target="_blank"><h3>{{$value['name']}}</h3></a>
                  </div>
                  {{--<div  class="compare-checkbox">
                   <p><input title="Compare" class="filled-in compareCheckbox" type="checkbox" id="{{$value['id']}}"
                     onchange="compareTo('{{$value['id']}}',this)"/>&nbsp;&nbsp;Compare</p>
                   </div>--}}
                 </div>
               </div>
             </div>
               @endforeach
             </div>

           </div>
         {{--   </section>--}}
         {{-- <div id="modal20" class="modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

              <div class="modal-body">
               <a class="modal-action close btn center" type="button"  data-dismiss="modal" style="width:100%;">Select another trip </a>
             </div>

           </div>

         </div>
       </div>

       <div id="modal2" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">

            <div class="modal-body" style="text-align:center">
             You have selected two trips. You can compare these trips or add another. <br><br>
             <a class="modal-action close  btn center" type="button" data-dismiss="modal" style="width:100%;">Add another trip</a>
             <span class="CompareOr" >OR</span>
             <a href="javascript:ViewComparison();" class="modal-action close  btn center" type="button" data-dismiss style="width:100%;">Compare Trips</a>
           </div>
         </div>
       </div>
     </div>--}}
   </section>