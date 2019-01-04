<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Welcome | ABAH - Aplikasi Bank Sampah</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.min.css">

    <!-- Custom styles for this template -->
    <link href="css/welcome.css" rel="stylesheet">
</head>
<body id="page-top" class="landing-page">
<div class="navbar-wrapper">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!--<a class="navbar-brand" href="index.html">ABAH</a>-->
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="page-scroll" href="#page-top">Beranda</a></li>
                        <li><a class="page-scroll" href="#features">Fitur</a></li>
                        <li><a class="page-scroll" href="#workflow">Alur Kerja</a></li>
                        <li><a class="page-scroll" href="#contact">Kontak</a></li>
                    </ul>
                </div>
            </div>
        </nav>
</div>
<div id="inSlider" class="carousel carousel-fade" data-ride="carousel">
  
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <div class="container">
                <div class="carousel-caption blank">
                    @if (Sentinel::check())
                    <p style="color:#19aa8d;">Selamat Bekerja, {{Sentinel::getUser()->first_name}} !</p>
                    @endif
                    <h1 style="color:#19aa8d;">ABAH <br/> Aplikasi Bank Sampah.</h1>
                    <p style="color:#19aa8d;">Aplikasi Pengelolaan Nasabah & Transaksi Bank Sampah terintegerasi.</p>
                    <p>
                    @if (Route::has('login'))
                       @if (Sentinel::check())
                            <a href="{{ url('/dashboard') }}" class="btn btn-lg btn-primary" role="button">Dashboard</a>
                            @else
                            <a href="{{ url('/login') }}" class="btn btn-lg btn-primary" role="button">Login ke akun</a>
                            @endif
                            @endif
                    </p>
                </div>
            </div>
            <!-- Set background for slide in css -->
            <div class="header-back two"></div>
        </div>
    </div>

</div>
<section id="features" class="container services">
    <div class="row">
        <div class="col-sm-3">
            <h2>Buku Panduan</h2>
            <p> Buku panduan penggunaan (ABAH) Aplikasi Bank Sampah.</p>
            <p><a class="navy-link" href="#" role="button">Unduh &raquo;</a></p>
        </div>
        <div class="col-sm-3">
            <h2>SOP</h2>
            <p> <i>Standard Operational Procedure</i> pengelolaan data nasabah dan transaksi.</p>
            <p><a class="navy-link" href="#" role="button">Unduh &raquo;</a></p>
        </div>
        <div class="col-sm-3">
            <h2>Alur Kerja</h2>
            <p>Alur Kerja pengelolaan data nasabah dan transaksi.</p>
            <p><a class="navy-link" href="#" role="button">unduh &raquo;</a></p>
        </div>
        <div class="col-sm-3">
            <h2>Formulir Nasabah</h2>
            <p>Formulir pendaftaran nasabah baru.</p>
            <p><a class="navy-link" href="#" role="button">unduh &raquo;</a></p>
        </div>
       
    </div>
</section>
<section  id="features" class="container features">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="navy-line"></div>
            <h1>Fitur ABAH<br/> <span class="navy"> (Aplikasi Bank Sampah)</span> </h1>
            <p>Aplikasi pengelolaan nasabah dan transaksi bank sampah. </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 text-center wow fadeInLeft">
            <div>
                <i class="fa fa-leaf features-icon"></i>
                <h2>Efisien</h2>
                <p>Pengelolaan data secara digital sehingga ramah lingkungan dikarenakan <i>paperless</i>.</p>
            </div>
            <div class="m-t-lg">
                <i class="fa fa-bar-chart features-icon"></i>
                <h2>Dashboard</h2>
                <p>Penyajian laporan berubah dashboard berisi resume data-data dalam bentuk chart.</p>
            </div>
        </div>
        <div class="col-md-6 text-center  wow zoomIn">
            <img src="img/landing/perspective.png" alt="dashboard" class="img-responsive">
        </div>
        <div class="col-md-3 text-center wow fadeInRight">
            <div>
                <i class="fa fa-clock-o features-icon"></i>
                <h2>Realtime</h2>
                <p>Data yang dapat diakses kapan saja dan dimana saja.</p>
            </div>
            <div class="m-t-lg">
                <i class="fa fa-lock features-icon"></i>
                <h2>Keamanan</h2>
                <p>Transaksi dan penyimpanan data menggunakan enkripsi.</p>
            </div>
        </div>
    </div>
   
</section>

<section class="timeline gray-section" id="workflow">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>Alur Kerja</h1>
                <p>Alur kerja deposit sampah di Bank Sampah PD. Kebersihan.</p>
            </div>
        </div>
        <div class="row features-block">

            <div class="col-lg-12">
                <div id="vertical-timeline" class="vertical-container light-timeline center-orientation">
                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg">
                            <i class="fa fa-user"></i>
                        </div>

                        <div class="vertical-timeline-content">
                            <h2>Nasabah Baru</h2>
                            <p>Nasabah baru bisa perorangan atau kelompok. 
                             Nasabah dapat mendaftar dengan membawa persyaratan yang telah ditentukan.
                            </p>
                            <a href="#" class="btn btn-xs btn-primary"> Unduh Formulir</a>
                            <span class="vertical-date"> Senin - Jumat <br/> <small>09:00 - 17:00</small> </span>
                        </div>
                    </div>

                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg">
                            <i class="fa fa-check"></i>
                        </div>

                        <div class="vertical-timeline-content">
                            <h2>Aktivasi</h2>
                            <p>Data dari Nasabah diverifikasi, apabila lengkap dan sesuai maka Administrator Bank Sampah akan memberikan buku tabungan. Dengan ini nasabah telah sah menjadi anggota.</p>
                            <span class="vertical-date"> Senin - Jumat <br/> <small>09:00 - 17:00</small> </span>
                        </div>
                    </div>

                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg">
                            <i class="fa fa-pagelines"></i>
                        </div>

                        <div class="vertical-timeline-content">
                            <h2>Penyetoran Sampah</h2>
                            <p>Sampah yang hendak di setor biasanya telah dipilah menjadi sampah organik dan an-organik. Sampah kemudian ditimbang dan dikalkulasikan menjadi nilai. Berat sampah yang bisa disetorkan sudah ditentukan pada kesepakatan sebelumnya, misalnya minimal harus satu kilogram</p>
                            <span class="vertical-date"> Senin, Rabu, Kamis <br/> <small>09:00 - 17:00</small></span>
                        </div>
                    </div>

                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg">
                            <i class="fa fa-money"></i>
                        </div>

                        <div class="vertical-timeline-content">
                            <h2>Pencairan</h2>
                            <p>Pencairan dilakukan setelah deposit dari nasabah cukup sesuai batas minimal pencairan yang telah ditentukan. Nasabah membawa buku tabungan dan identitas ketika hendak melakukan pencairan.
                            Pencairan ini dapat pula ditukarkan dengan barang sesuai dengan nilainya.</p>
                            <span class="vertical-date"> Senin - Jumat <br/> <small>09:00 - 17:00</small> </span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</section>
<section id="contact" class="contact">
    <div class="container">
        <div class="row m-b-lg">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>Kontak Administrator</h1>
            </div>
        </div>
        <div class="row m-b-lg">
            <div class="col-lg-3 col-lg-offset-3">
                <address>
                    <strong><span class="navy">PD. Kebersihan - Bandung</span></strong><br/>
                    Jl. Surapati No.126, Cihaur Geulis<br/>
                    Cibeunying Kaler, Kota Bandung, Jawa Barat 40122<br/>
                    <abbr title="Phone">P:</abbr> (022) 7207889
                </address>
            </div>
            <div class="col-lg-4">
                <p class="text-color">
                    Kontak kami apabila menemukan kendala teknis dan mendaftarkan pengguna baru.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <a href="mailto:test@email.com" class="btn btn-primary">Email Kami</a>
                <p class="m-t-sm">
                    Ikuti kami di sosial media 
                </p>
                <ul class="list-inline social-icon">
                    <li><a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center m-t-lg m-b-lg">
                <p><strong>&copy; 2017 - PD. Kebersihan Bandung</strong></p>
            </div>
        </div>
    </div>
</section>

<!-- Mainly scripts -->
<script src="js/jquery-2.1.1.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>
<script src="js/plugins/wow/wow.min.js"></script>


<script>

    $(document).ready(function () {

        $('body').scrollspy({
            target: '.navbar-fixed-top',
            offset: 80
        });

        // Page scrolling feature
        $('a.page-scroll').bind('click', function(event) {
            var link = $(this);
            $('html, body').stop().animate({
                scrollTop: $(link.attr('href')).offset().top - 50
            }, 500);
            event.preventDefault();
            $("#navbar").collapse('hide');
        });
    });

    var cbpAnimatedHeader = (function() {
        var docElem = document.documentElement,
                header = document.querySelector( '.navbar-default' ),
                didScroll = false,
                changeHeaderOn = 200;
        function init() {
            window.addEventListener( 'scroll', function( event ) {
                if( !didScroll ) {
                    didScroll = true;
                    setTimeout( scrollPage, 250 );
                }
            }, false );
        }
        function scrollPage() {
            var sy = scrollY();
            if ( sy >= changeHeaderOn ) {
                $(header).addClass('navbar-scroll')
            }
            else {
                $(header).removeClass('navbar-scroll')
            }
            didScroll = false;
        }
        function scrollY() {
            return window.pageYOffset || docElem.scrollTop;
        }
        init();

    })();

    // Activate WOW.js plugin for animation on scrol
    new WOW().init();

</script>

</body>
</html>
