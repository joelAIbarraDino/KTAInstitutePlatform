<div class="bottom-to-top">
    <a href="#" class="to-top"><span class="fa-solid fa-arrow-up to-top-icon"></span></a>
</div>

<footer>
  <div class="footer-content v1">
    <div class="container-xl container-fluid-md">
      
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="footer-widget">
            <div class="footer-logo">
              <a href="/">
                <img src="/assets/img/logo/logo.jpg" alt="edupls-icon"  width="70px"/>
              </a>
            </div>
            <p class="widget-para">
              Ayudando al inmigrante en su integración total y exitosa en los Estados Unidos, 
              ayudamos a las personas a alcanzar sus metas y perseguir sus sueños.
            </p>

            <?php 
                $class="footer-social-link";
                include __DIR__.'/socialMedia.php';
            ?>

          </div>
        </div>
        <div class="col-lg-5 col-md-4 col-sm-6">
          <div class="footer-widget">
            <h4 class="widget-title">Menú</h4>
            <ul class="quick-links">
              <li>
                <a href="/home"> Inicio </a>
              </li>
              <li>
                <a href="/about">Sobre nosotros</a>
              </li>
              <li>
              <a href="/membresias">membresías</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="footer-widget">
            <h4 class="widget-title">Contactanos</h4>
            <div class="get-in-touch">
              <ul class="contact-info-items">
                <li class="contact-info-item">
                  <div class="contact-info-icon">
                    <i class="my-icon icon-location"></i>
                  </div>
                  <div class="contact-info-content">
                    <p class="para">KTA location</p>
                    <h4 class="title">Brandon, Florida</h4>
                  </div>
                </li>
                <li class="contact-info-item">
                  <div class="contact-info-icon">
                    <i class="my-icon icon-massage"></i>
                  </div>
                  <div class="contact-info-content">
                    <p class="para">Correo</p>
                    <h4 class="title">unicoach@mail.com</h4>
                  </div>
                </li>
                <li class="contact-info-item">
                  <div class="contact-info-icon">
                    <i class="my-icon icon-call-2"></i>
                  </div>
                  <div class="contact-info-content">
                    <p class="para">Telefono</p>
                    <h4 class="title">(888)5921822</h4>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-left-color-img">
        <img src="assets/img/footer/v1/bg-left-color.png" alt="bg-left-color" />
      </div>
      <div class="bg-right-color-img">
        <img
          src="assets/img/footer/v1/bg-right-color.png"
          alt="bg-right-color"
        />
      </div>
    </div>
  </div>
  <div class="copyright-section v1">
    <div class="container">
      <div class="copyright-content">
        <div class="left-content">
          <p class="para">© <?=date('Y')?> <span>KTA.</span> All Rights Reserved.</p>
        </div>
      </div>
    </div>
  </div>
</footer>