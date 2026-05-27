<footer class="sams-footer">
  <div class="sams-footer-bg"></div>
  <div class="container-fluid sams-footer-inner px-lg-5 px-3">
    <div class="sams-footer-col sams-footer-brand">
      <div class="sams-footer-logo">
        <img src="{{ url('/site/images/sams logo.jpeg') }}" alt="SAMS Logo" class="sams-logo-mark" height="44" width="44" loading="lazy">
        <div class="sams-logo-text">
          <div class="sams-logo-title">SAMS<span class="sams-logo-sup">JOS</span></div>
          <div class="sams-logo-sub">St. Augustine Major Seminary</div>
        </div>
      </div>
      <p class="sams-footer-desc">
        St. Augustine Major Seminary, Jos is a center of priestly formation committed to spiritual, human, intellectual, and pastoral development for service in the Church of God.
      </p>
      <div class="sams-footer-socials">
        <a href="#" aria-label="facebook" class="sams-social"><i class="bi bi-facebook"></i></a>
        <a href="#" aria-label="tiktok" class="sams-social"><i class="bi bi-tiktok"></i></a>
        <a href="#" aria-label="youtube" class="sams-social"><i class="bi bi-youtube"></i></a>
        <a href="#" aria-label="instagram" class="sams-social"><i class="bi bi-instagram"></i></a>
      </div>
    </div>

    <div class="sams-footer-col sams-footer-links">
      <h4 class="sams-footer-heading">QUICK LINKS</h4>
      <ul>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/page/history') }}">About</a></li>
        <li><a href="{{ url('/page/admission') }}">Admission</a></li>
        <li><a href="{{ url('/page/vocation-formation') }}">Vocation</a></li>
        <li><a href="{{ url('/page/alumni') }}">Alumni</a></li>
        <li><a href="{{ url('/page/reflection') }}">📖 Reflection</a></li>
      </ul>
    </div>

    <div class="sams-footer-col sams-footer-contact">
      <h4 class="sams-footer-heading">CONTACT US</h4>
      <p class="sams-footer-desc">
        St. Augustine Major Seminary, Jos<br>
        P.O. Box 1234, Jos, Plateau State, Nigeria<br>
        Phone: +234 812 345 6789<br>
        Email: info@samsjos.edu.ng
      </p>
    </div>

    <div class="sams-footer-col sams-footer-reflection">
      <h4 class="sams-footer-heading">DAILY REFLECTIONS</h4>
      <p class="sams-footer-desc">
        Nourish your spirit with our daily reflections prepared by the seminary community.
      </p>
      <a href="{{ url('/page/reflection') }}" class="btn btn-outline-light">Read Today's Reflection</a>
    </div>
  </div>

  <div class="sams-footer-bottom">
    <div class="page-wrap sams-footer-bottom-inner">
      <div class="sams-copyright">
        Copyright &copy; {{ date('Y') }} St. Augustine Major Seminary, Jos.
        All Rights Reserved | Website by
        <a href="https://sophajs.com" target="_blank">Sophajs Global Tech</a>
      </div>
    </div>
  </div>
</footer>
