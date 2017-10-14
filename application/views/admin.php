<?php $this->load->view("include/header"); ?>

   <div class="content-wrapper" id="dashboard">
          <h1 class="page-title">Overview</h1>
          <div class="row grid-margin">
            <div class="col-12 col-lg-6 grid-margin grid-margin-lg-0">
              <div class="card">
                <div class="card-body">
                  <h2 class="card-title">Total sales</h2>
                  <div class="row">
                    <div class="col-12">
                      <div class="custom-legend-container small-chart-container">
                        <div id="sales-chart-legend" class="legend-top"></div>
                        <canvas id="sales-chart" style="width:100%"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6">
              <div class="row grid-margin">
                <div class="col-6">
                  <div class="card card-statistics">
                    <div class="card-body">
                        <p class="highlight-text">
                          <i class="mdi mdi-account text-success"></i>
                          225
                        </p>
                        <p class="text-muted">
                          New  Added contacts
                        </p>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="card card-statistics">
                    <div class="card-body">
                      <p class="highlight-text">
                        <i class="mdi mdi-trophy text-info"></i>
                        $450.00
                      </p>
                      <p class="text-muted">
                        Income amounts
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <div class="card card-statistics">
                    <div class="card-body">
                      <p class="highlight-text">
                        <i class="mdi mdi-chart-areaspline text-danger"></i>
                        $18954
                      </p>
                      <p class="text-muted">
                        Lifetime total sales
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="card card-statistics">
                    <div class="card-body">
                      <p class="highlight-text">
                        <i class="mdi mdi-cash-multiple text-warning"></i>
                        $7841
                      </p>
                      <p class="text-muted">
                        Income amounts
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row grid-margin">
            <div class="col-12 col-lg-5 grid-margin grid-margin-lg-0">
              <div class="card">
                <div class="card-body">
                  <h2 class="card-title">Inbox Messages</h2>
                  <!--inbox preview starts-->
                  <div class="preview-list pr-5">
                    <div class="preview-item">
                      <div class="preview-thumbnail">
                        <img src="images/faces/face1.jpg" class="profile-pic" />
                        <span class="badge badge-online"></span>
                      </div>
                      <div class="preview-item-content">
                        <h4 class="preview-subject">Create New Page</h4>
                        <p class="text-muted">
                          Vestibulum lectus nulla, maximus
                        </p>
                      </div>
                    </div>
                    <div class="preview-item">
                      <div class="preview-thumbnail">
                        <img src="images/faces/face3.jpg" class="profile-pic" />
                        <span class="badge badge-offline"></span>
                      </div>
                      <div class="preview-item-content">
                        <h4 class="preview-subject">Back Up Theme</h4>
                        <p class="text-muted">
                          Vestibulum lectus nulla, maximus
                        </p>
                      </div>
                    </div>
                    <div class="preview-item">
                      <div class="preview-thumbnail">
                        <img src="images/faces/face4.jpg" class="profile-pic" />
                        <span class="badge badge-busy"></span>
                      </div>
                      <div class="preview-item-content">
                        <h4 class="preview-subject">Create New Page</h4>
                        <p class="text-muted">
                          Vestibulum lectus nulla, maximus
                        </p>
                      </div>
                    </div>
                    <div class="preview-item">
                      <div class="preview-thumbnail">
                        <img src="images/faces/face5.jpg" class="profile-pic" />
                        <span class="badge badge-offline"></span>
                      </div>
                      <div class="preview-item-content">
                        <h4 class="preview-subject">Back Up Theme</h4>
                        <p class="text-muted">
                          Vestibulum lectus nulla, maximus
                        </p>
                      </div>
                    </div>
                    <div class="preview-item">
                      <div class="preview-thumbnail">
                        <img src="images/faces/face6.jpg" class="profile-pic" />
                        <span class="badge badge-busy"></span>
                      </div>
                      <div class="preview-item-content">
                        <h4 class="preview-subject">Create New Page</h4>
                        <p class="text-muted">
                          Vestibulum lectus nulla, maximus
                        </p>
                      </div>
                    </div>
                    <div class="preview-item">
                      <div class="preview-thumbnail">
                        <img src="images/faces/face7.jpg" class="profile-pic" />
                        <span class="badge badge-online"></span>
                      </div>
                      <div class="preview-item-content">
                        <h4 class="preview-subject">Back Up Theme</h4>
                        <p class="text-muted">
                          Vestibulum lectus nulla, maximus
                        </p>
                      </div>
                    </div>
                    <div class="preview-item">
                      <div class="preview-thumbnail">
                        <img src="images/faces/face8.jpg" class="profile-pic" />
                        <span class="badge badge-offline"></span>
                      </div>
                      <div class="preview-item-content">
                        <h4 class="preview-subject">Create New Page</h4>
                        <p class="text-muted">
                          Vestibulum lectus nulla, maximus
                        </p>
                      </div>
                    </div>
                  </div>
                  <!--inbox-preview end-->
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-7">
              <div class="card pb-4">
                <div class="card-body">
                  <h2 class="card-title">Product Calculation</h2>
                  <div class="custom-legend-container">
                    <div id="product-calc-chart-legend" class="legend-top"></div>
                    <canvas id="product-calc-chart" class="mb-4"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row grid-margin">
            <div class="col-12 col-lg-5 grid-margin grid-margin-lg-0">
              <!--notification card starts-->
              <div class="card">
                <div class="card-body">
                  <h2 class="card-title">Notifications</h2>
                  <div class="preview-list">
                    <div class="preview-item">
                      <div class="preview-thumbnail">
                        <div class="preview-icon bg-primary">
                          <i class="mdi mdi-email"></i>
                        </div>
                      </div>
                      <div class="preview-item-content">
                        <h4 class="preview-subject">You have 3 new messages</h4>
                        <p class="text-muted">
                          Hanna giover, Jeffry brown
                        </p>
                        <p class="text-muted">
                          9:30 AM
                        </p>
                      </div>
                    </div>
                    <div class="preview-item">
                      <div class="preview-thumbnail">
                        <div class="preview-icon bg-info">
                          <i class="mdi mdi-earth"></i>
                        </div>
                      </div>
                      <div class="preview-item-content">
                        <h4 class="preview-subject">Newsfeed available</h4>
                        <p class="text-muted">
                          Hanna giover, Jeffry brown
                        </p>
                        <p class="text-muted">
                          9:30 AM
                        </p>
                      </div>
                    </div>
                    <div class="preview-item">
                      <div class="preview-thumbnail">
                        <div class="preview-icon bg-primary">
                          <i class="mdi mdi-currency-usd"></i>
                        </div>
                      </div>
                      <div class="preview-item-content">
                        <h4 class="preview-subject">2 Invoices to pay</h4>
                        <p class="text-muted">
                          Hanna giover, Jeffry brown
                        </p>
                        <p class="text-muted">
                          9:30 AM
                        </p>
                      </div>
                    </div>
                    <div class="preview-item">
                      <div class="preview-thumbnail">
                        <div class="preview-icon bg-info">
                          <i class="mdi mdi-message-text"></i>
                        </div>
                      </div>
                      <div class="preview-item-content">
                        <h4 class="preview-subject">15 New comments</h4>
                        <p class="text-muted">
                          Hanna giover, Jeffry brown
                        </p>
                        <p class="text-muted">
                          9:30 AM
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--notification card ends-->
            </div>
            <div class="col-12 col-lg-7 grid-margin grid-margin-lg-0">
              <div class="card">
                <div class="card-body">
                  <h2 class="card-title">Active Tasks (2/98)</h2>
                  <div class="preview-list">
                    <div class="preview-item">
                      <div class="form-check">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input">
                          </label>
                      </div>
                      <div class="preview-thumbnail">
                        <div class="preview-icon bg-primary">
                          MR
                        </div>
                      </div>
                      <div class="preview-item-content">
                        <h4 class="preview-subject">Send over investmnet documnet</h4>
                        <p>
                          <span class="content-category">EMAIL</span>
                          <span class="pl-3 text-muted">Hanna giover, Jeffry brown</span>
                        </p>
                      </div>
                      <div class="preview-actions ml-auto">
                        <a href="#"><i class="mdi mdi-pencil"></i></a>
                        <a href="#"><i class="mdi mdi-delete"></i></a>
                      </div>
                    </div>
                    <div class="preview-item">
                      <div class="form-check">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input">
                          </label>
                      </div>
                      <div class="preview-thumbnail">
                        <div class="preview-icon bg-info">
                          MR
                        </div>
                      </div>
                      <div class="preview-item-content">
                        <h4 class="preview-subject">Prepare for a bi-weekly meeting</h4>
                        <p>
                          <span class="content-category">DOCUMENT</span>
                          <span class="pl-3 text-muted">Hanna giover, Jeffry brown</span>
                        </p>
                      </div>
                      <div class="preview-actions ml-auto">
                        <a href="#"><i class="mdi mdi-pencil"></i></a>
                        <a href="#"><i class="mdi mdi-delete"></i></a>
                      </div>
                    </div>
                    <div class="preview-item">
                      <div class="form-check">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input">
                          </label>
                      </div>
                      <div class="preview-thumbnail">
                        <div class="preview-icon bg-success">
                          R
                        </div>
                      </div>
                      <div class="preview-item-content">
                        <h4 class="preview-subject">Shedule a call with reema on Thursday</h4>
                        <p>
                          <span class="content-category">DOCUMENT</span>
                          <span class="pl-3 text-muted">Hanna giover, Jeffry brown</span>
                        </p>
                      </div>
                      <div class="preview-actions ml-auto">
                        <a href="#"><i class="mdi mdi-pencil"></i></a>
                        <a href="#"><i class="mdi mdi-delete"></i></a>
                      </div>
                    </div>
                    <div class="preview-item">
                      <div class="form-check">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input">
                          </label>
                      </div>
                      <div class="preview-thumbnail">
                        <div class="preview-icon bg-danger">
                          MR
                        </div>
                      </div>
                      <div class="preview-item-content">
                        <h4 class="preview-subject">Prepare for a bi-weekly meeting</h4>
                        <p>
                          <span class="content-category">DOCUMENT</span>
                          <span class="pl-3 text-muted">Hanna giover, Jeffry brown</span>
                        </p>
                      </div>
                      <div class="preview-actions ml-auto">
                        <a href="#"><i class="mdi mdi-pencil"></i></a>
                        <a href="#"><i class="mdi mdi-delete"></i></a>
                      </div>
                    </div>
                    <div class="preview-item">
                      <div class="form-check">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input">
                          </label>
                      </div>
                      <div class="preview-thumbnail">
                        <div class="preview-icon bg-warning">
                          MR
                        </div>
                      </div>
                      <div class="preview-item-content">
                        <h4 class="preview-subject">Prepare for a bi-weekly meeting</h4>
                        <p>
                          <span class="content-category">DOCUMENT</span>
                          <span class="pl-3 text-muted">Hanna giover, Jeffry brown</span>
                        </p>
                      </div>
                      <div class="preview-actions ml-auto">
                        <a href="#"><i class="mdi mdi-pencil"></i></a>
                        <a href="#"><i class="mdi mdi-delete"></i></a>
                      </div>
                    </div>
                  </div>
                  <!--active task list ends-->
                </div>
              </div>
            </div>
          </div>
          <div class="row grid-margin">
            <div class="col-12 col-lg-7 grid-margin grid-margin-lg-0">
              <div class="row grid-margin">
                <div class="col-12">
                  <!--visitors card starts-->
                  <div class="card card-count">
                    <div class="card-body">
                      <h2 class="card-title">Visitors</h2>
                      <div class="count-item-list">
                        <div class="count-item">
                          <div class="count-item-title">
                            <i class="mdi mdi-cellphone-android"></i>
                            Phone
                          </div>
                          <div class="count-value">
                            <p>
                              No: 850
                            </p>
                          </div>
                        </div>
                        <div class="count-item">
                          <div class="count-item-title">
                            <i class="mdi mdi-desktop-mac"></i>
                            Website
                          </div>
                          <div class="count-value">
                            <p>
                              1050
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--visitors card ends-->
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-lg-6 grid-margin grid-margin-lg-0">
                  <div class="card card-twitter">
                    <div class="card-body">
                      <h3 class="card-title">
                        <i class="mdi mdi-twitter-box"></i>
                        03 November
                      </h3>
                      <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's
                        standard dummy text ever since the 1500s,
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-lg-6 grid-margin grid-margin-lg-0">
                  <div class="card card-fb">
                    <div class="card-body">
                      <h4 class="card-title">
                        <i class="mdi mdi-facebook-box"></i>
                        03 November
                      </h4>
                      <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's
                        standard dummy text ever since the 1500s,
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-5 grid-margin grid-margin-lg-0">
              <!--weather card starts-->
              <div class="card card-weather">
                <div class="card-body">
                  <h2 class="card-title">Weather</h2>
                  <div class="weather-status">
                    <i class="mdi mdi-weather-partlycloudy"></i>
                    <span class="highlight-text">73 <span class="symbol">&deg;</span></span>
                    <div class="weather-date">
                      <h3>Saturday</h3>
                      <p>
                        Ahmedabad, India
                      </p>
                    </div>
                  </div>
                  <div class="weather-report">
                    <p class="row">
                      <span class="col-4">
                        Wind
                      </span>
                      <span class="col-8">
                        ESE 17 mph
                      </span>
                    </p>
                    <p class="row">
                      <span class="col-4">
                        Humidity
                      </span>
                      <span class="col-8">
                        83%
                      </span>
                    </p>
                    <p class="row">
                      <span class="col-4">
                        Pressure
                      </span>
                      <span class="col-8">
                        28.56 in
                      </span>
                    </p>
                    <p class="row">
                      <span class="col-4">
                        Cloud cover
                      </span>
                      <span class="col-8">
                        78%
                      </span>
                    </p>
                    <p class="row">
                      <span class="col-4">
                        Ceiling
                      </span>
                      <span class="col-8">
                        25760 ft
                      </span>
                    </p>
                  </div>
                  <div class="weather-timing">
                    <div class="row">
                      <div class="col-3">
                        <i class="mdi mdi-weather-night"></i>
                        <p>
                          00.30
                        </p>
                      </div>
                      <div class="col-3">
                        <i class="mdi mdi-weather-pouring"></i>
                        <p>
                          11.30
                        </p>
                      </div>
                      <div class="col-3">
                        <i class="mdi mdi-weather-partlycloudy"></i>
                        <p>
                          13.30
                        </p>
                      </div>
                      <div class="col-3">
                        <i class="mdi mdi-weather-fog"></i>
                        <p>
                          13.30
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--weather card ends-->
            </div>
          </div>
        </div>
		<div class="content-wrapper" id="module_container"></div>
        <?php $this->load->view("include/footer"); ?>