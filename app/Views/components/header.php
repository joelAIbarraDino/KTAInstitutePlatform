<header class="nav-header header-layout1">
  <!--==============================
      Header One Top Area
      ==============================-->
  <div class="header-one-top-area">
    <div class="container">
      <div class="header-top-content v1">
        <p class="discount-the-month">
            Ayudando al inmigrante en su integración total y exitosa en los Estados Unidos
        </p>
        <ul class="user-login">
          <li>
            <i class="my-icon icon-user"></i>
          </li>
          <li>
            <a href="/login">Login</a>
          </li>
          <li>
            <a href="/sign-up">Register</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!--==============================
      Top Content Info
      ==============================-->
  <div class="top-content-info">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-2">
          <div class="logo-img">
            <a href="/">
              <img src="/assets/img/logo/logo.jpg" alt="edupls-icon"  width="70px"/>
            </a>
            <div class="navbar-right d-inline-flex d-lg-none">
              <button type="button" class="menu-toggle icon-btn">
                <i class="my-icon icon-all"></i>
              </button>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="nav-middle-content">
            <div class="content-location">
              <div class="location-icon">
                <i class="my-icon icon-location"></i>
              </div>
              <div class="info-data">
                <a class="title" 
                    href="https://www.google.com/maps/uv?pb=!1s0x84c300685e49e813%3A0x2bd2f5a34f18fa99!3m1!7e115!4s%2Fmaps%2Fplace%2Fkta%2Binstitute%2F%4027.9381914%2C-82.288147%2C3a%2C75y%2C21.51h%2C90t%2Fdata%3D*213m4*211e1*213m2*211s6ZZyuq2LnhWu7gjU6ZAa_A*212e0*214m2*213m1*211s0x84c300685e49e813%3A0x2bd2f5a34f18fa99%3Fsa%3DX%26ved%3D2ahUKEwjzl6v93PKLAxUJM0QIHa--IgAQpx96BAgVEAA!5skta%20institute%20-%20Buscar%20con%20Google!15sCgIgAQ&imagekey=!1e2!2s6ZZyuq2LnhWu7gjU6ZAa_A&cr=le_a7&hl=es-419&ved=1t%3A206134&ictx=111"
                >KTA Location</a>
                <p class="para text">Brandon, Florida</p>
              </div>
            </div>
            <div class="content-address">
              <div class="address-icon">
                <i class="my-icon icon-massage"></i>
              </div>
              <div class="info-data">
                <a class="title" href="https://ktainstitute.com/contacto/">Contacto</a>
                <p class="para text">unicoach@mail.com</p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="top-nav-search-option">
            <form>
              <input type="search" placeholder="Enter Courses" />
              <button class="search-btn-nav" type="submit"><i class="my-icon icon-search"></i></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--==============================
      Sticky Wrapper
    ==============================-->
  <div class="sticky-wrapper">
    <div class="menu-area">
      <div class="container">
        <div class="menu-area-content">
          <div class="row align-items-center justify-content-between">
            <div class="col-auto">
              <nav class="main-menu d-none d-lg-inline-block">
                <ul>
                    <?php include __DIR__.'/navegacion.php';?>
                </ul>
              </nav>
            </div>
            <div class="col-auto">
              <div class="menu-area-right-content">
                <?php 
                    $class="menu-social";
                    include __DIR__.'/socialMedia.php';
                ?>
                <div class="menu-contact-number">
                  <a href="tel:+1(888)5921822" class="contact-number">(888)5921822</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--==============================
      Mobile Menu Wrapper
    ==============================-->
  <div class="mobile-menu-wrapper">
    <div class="mobile-menu-area text-center">
      <button class="menu-toggle"><i class="fa-solid fa-xmark"></i></button>
      <div class="mobile-logo">
        <a href="/"><img src="/assets/img/logo/logo.jpg" alt="edupls-icon"  width="70px"/></a>
      </div>
      <div class="mobile-menu">
        <ul>
            <?php include __DIR__.'/navegacion.php';?>
        </ul>
      </div>
    </div>
  </div>
</header>