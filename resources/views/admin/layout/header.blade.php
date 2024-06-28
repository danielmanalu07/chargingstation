  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

      <div class="d-flex align-items-center justify-content-between">
          <a href="" class="logo d-flex align-items-center">
              <img src="assets/img/logo.png" alt="">
              <span class="d-none d-lg-block">{{ Auth::guard('admin')->user()->username }}</span>
          </a>
      </div><!-- End Logo -->

      

      <nav class="header-nav ms-auto">
          <ul class="d-flex align-items-center">
              <li class="nav-item dropdown pe-3">

                  <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                      data-bs-toggle="dropdown">
                      <span
                          class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::guard('admin')->user()->username }}</span>
                  </a><!-- End Profile Iamge Icon -->

                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                      <li class="dropdown-header">
                          <h6>{{ Auth::guard('admin')->user()->username }}</h6>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>
            
                      <li>
                          <a class="dropdown-item d-flex align-items-center" href="{{ url('/admin/logout') }}">
                              <i class="bi bi-box-arrow-right"></i>
                              <span>Sign Out</span>
                          </a>
                      </li>

                  </ul><!-- End Profile Dropdown Items -->
              </li><!-- End Profile Nav -->

          </ul>
      </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->