<section id="company-status">
  <div class="company-bg  pt-30 pb-30">
    <div class="container">
      <div class="section-title">
        <h2 class="">Company Statistics</h2>
        <div class="title-bg">
          <span class="line-bg"></span>
          <span class="line-bg"></span>
          <span class="line-bg"></span>
          <span class="line-bg"></span>
          <span class="line-bg"></span>
        </div>
      </div>
      <div class="customer-no-details">
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 pl-0 pr-0 cstatus">
            <div class="single-customer-details">
              <div class="customer-icon">
                <span><i class="fa fa-users"></i></span>
              </div>
              <div class="customer-icon-details">
                <strong>{{$total_views}}</strong>
                <p class="mt-10">Total Site Visitor</p>
              </div>
            </div>

          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 pl-0 pr-0 cstatus">
            <div class="single-customer-details">
              <div class="customer-icon">
                <span><i class="fa fa-user"></i></span>
              </div>
              <div class="customer-icon-details">
                <strong>{{$totalusers}}</strong>
                <p class="mt-10">Total Users / Clients</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 pl-0 pr-0 cstatus">
            <div class="single-customer-details br-0">
              <div class="customer-icon">
                <span><i class="fab fa-tripadvisor"></i></span>
              </div>
              <div class="customer-icon-details">
                <strong>{{$tripcounts}}</strong>
                <p class="mt-10">Number Of Trips</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 pl-0 pr-0 cstatus">
            <div class="single-customer-details br-0">
              <div class="customer-icon">
                <span><i class="fas fa-plane"></i></span>
              </div>
              <div class="customer-icon-details">
                <strong>{{$fixed}}</strong>
                <p class="mt-10">Fixed Departure</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>