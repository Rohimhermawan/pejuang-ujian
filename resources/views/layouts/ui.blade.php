<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pejuang Ujian</title>
        <link rel="icon" type="image/x-icon" href="/img/berkas/icon-pu.png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Rubik&family=Shrikhand&display=swap');
            body {
                font-family: 'Rubik', sans-serif !important;
                color: white;
            }
            .navbar {
                background-color: #1572A1 !important;
            }
            .navbar:hover{
                opacity: 1 !important;
            }
            .navbar-brand,.brand{
                font-family: 'Shrikhand', sans-serif !important;
            }
            footer {
                background-color: #1572A1;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
            <div class="container-fluid">
              <img src="/img/berkas/icon-pu.png" alt="Icon-Pejuang-Ujian" width="50px">
              <a class="ms-2 navbar-brand" href="/">Pejuang Ujian</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav mx-auto">
                  <a class="nav-link {{request()->is('/')? 'active':''}}" aria-current="page" href="/">Home</a>
                  <a class="nav-link {{request('feature') == 'blog' || request()->is('features/blog/*') ? 'active':''}}" href="/features?feature=blog">BLog</a>
                  <a class="nav-link {{request('feature') == 'exam' || request()->is('features/exam/*') ? 'active':''}}" href="/features?feature=exam">Soal</a>
                </div>
              </div>
            </div>
          </nav>
        <main>
          @yield('main')
        </main>
        <footer class="container-fluid">
          <div class="row">
              <div class="col-md-4 text-white d-flex align-items-center justify-content-center">
                  <div class="text-center">
                      <h2 class="h-2 brand">Pejuang Ujian</h2>
                      <div class="text-center">
                          <a href="https://instagram.com/asinambu" class=" link-light" target="_blank"><i class="bi bi-instagram"></a></i>
                          <a href="https://linkedin.com/in/rohim-hermawan-102952222/" class=" link-light" target="_blank"><i class="bi bi-linkedin"></a></i>
                      </div>
                      <img src="/img/berkas/icon-pu.png" alt="Icon-Pejuang-Ujian" width="200px">
                  </div>
              </div>
              <div class="col-md-4 text-center text-white pt-5">
                  <h4>Features</h4>
                  <div class="Text-center">
                      <a class="link-light text-decoration-none" href="/features?feature=blog">BLog</a>
                      <a class="link-light d-block text-decoration-none" href="/features?feature=exam">Soal</a>
                  </div>
              </div>
              <div class="col-md-4 text-center text-white py-5">
                  <h4>Soal</h4>
                  <div class="Text-center">
                      <a class="link-light text-decoration-none" href="/features?feature=exam&material=matematika">Matematika</a>
                      <a class="link-light d-block text-decoration-none" href="/features?feature=exam&material=kimia">Kimia</a>
                      <a class="link-light text-decoration-none" href="/features?feature=exam&material=biologi">Biologi</a>
                      <a class="link-light d-block text-decoration-none" href="/features?feature=exam&material=fisika">Fisika</a>
                      <a class="link-light d-block text-decoration-none" href="/features?feature=exam&material=b-indonesia">Bahasa Indonesia</a>
                      <a class="link-light d-block text-decoration-none" href="/features?feature=exam&material=b-inggris">Bahasa Inggris</a>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12 text-center text-white">
                  <hr>
                  <p>Make with <i class="bi bi-heart-fill text-danger"></i> by <a href="instagram.com/asinambu" class="text-decoration-none link-light">Asinambu</a></p>
                  <p>&copy; <span id="year"></span></p>
              </div>
          </div>
      </footer>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <script>
          document.getElementById("year").innerHTML = new Date().getFullYear();
          window.onscroll = function() {
              const navbar = document.querySelector(".navbar");
                navbar.style.opacity = 0.8;
          }
      </script>
  </body>
</html>