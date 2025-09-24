<?php
require_once "../config/Database.php";

$koneksi = (new Database())->getConnection();
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php?message=login_required");
    exit;
}

$successMessage = isset($_GET['success']) ? $_GET['success'] : null;
$errorMessage = isset($_GET['error']) ? $_GET['error'] : null;
$pageTitle = "Home";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" type="text/css" href="assets/normalize.css">
    <link rel="stylesheet" type="text/css" href="../icomoon/icomoon.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor.css">
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    <!-- <link rel="stylesheet" href="./assets/sticky-logo.css"> -->

</head>

<body data-bs-spy="scroll" data-bs-target="#header" tabindex="0">

    <div id="header-wrap">
        <div class="top-content">
            <div class="container-fluid">
                <div class="right-element">
                    <div class="user-profile-container">
                        <div class="welcome-text">
                            Selamat Datang,
                            <?= htmlspecialchars($_SESSION['username']); ?>
                        </div>
                        <div class="menu-item user-menu">
                            <a class="nav-link" href="#user-menu"><i class="icon icon-user"></i></a>
                            <ul class="dropdown-content">
                                <li><a href="settings.php">⚙️ Settings</a></li>
                                <li><a href="../controller/AuthController.php?action=logout">🚪 Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--top-content-->

    <header id="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div class="main-logo">
                        <a href="../index.php"><img src="../images/main-logo.png" alt="logo"></a>
                    </div>
                </div>
                <?php
                if ($errorMessage): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($errorMessage); ?>
                        <button type="button" class="btn-close"></button>
                    </div>
                <?php endif; ?>

                <?php if ($successMessage): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($successMessage); ?>
                        <button type="button" class="btn-close"></button>
                    </div>
                <?php endif; ?>
                <!-- </div> -->
            </div>

            <div class="col-md-10">

                <nav id="navbar">
                    <div class="main-menu stellarnav">
                        <ul class="menu-list">
                            <li class="menu-item active"><a href="view.php">Home</a></li>
                            <li class="menu-item has-sub">
                                <a href="#pages" class="nav-link">Pages</a>

                                <ul>
                                    <li class="active"><a href="index.html">Home</a></li>
                                    <li><a href="index.html">About</a></li>
                                    <li><a href="index.html">Blog</a></li>
                                    <li><a href="index.html">Contact</a></li>
                                    <li><a href="index.html">Thank You</a></li>
                                </ul>

                            </li>
                        </ul>

                        <div class="hamburger">
                            <span class="bar"></span>
                            <span class="bar"></span>
                            <span class="bar"></span>
                        </div>

                    </div>
                </nav>

            </div>

        </div>
        </div>
    </header>

    </div><!--header-wrap-->

    <section id="billboard">

        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <button class="prev slick-arrow">
                        <i class="icon icon-arrow-left"></i>
                    </button>

                    <div class="main-slider pattern-overlay">
                        <div class="slider-item">
                            <div class="banner-content">
                                <h2 class="banner-title">Ayat-Ayat Cinta</h2>
                                <p>Ayat Ayat Cinta adalah novel yang sangat bagus dan lengkap kandungannya. Ini bukan hanya novel sastra dan cinta, tapi juga novel politik, novel budaya, novel reliji, novel fikih, novel etika, novel bahasa, dan novel dakwah. Sangat bagus untuk dibaca siapa saja.</p>
                                <div class="btn-wrap">
                                    <a href="#" class="btn btn-outline-accent btn-accent-arrow">Read More<i
                                            class="icon icon-ns-arrow-right"></i></a>
                                </div>
                            </div><!--banner-content-->
                            <img src="../images/ayat-ayat-cinta.png" alt="banner" class="banner-image">
                        </div><!--slider-item-->

                        <div class="slider-item">
                            <div class="banner-content">
                                <h2 class="banner-title">Dillan 1990</h2>
                                <p>Novel “Dilan : Dia Adalah Dilanku Tahun 1990” bercerita tentang kisah cinta dua remaja Bandung pada tahun 90an. Berawal dari seorang siswa bernama Dilan yang jatuh cinta dengan siswi pindahan dari SMA di Jakarta bernama Milea. Dilan memiliki beragam cara untuk mendekati dan mencuri perhatian Milea.</p>
                                <div class="btn-wrap">
                                    <a href="#" class="btn btn-outline-accent btn-accent-arrow">Read More<i
                                            class="icon icon-ns-arrow-right"></i></a>
                                </div>
                            </div><!--banner-content-->
                            <img src="../images/buku-dilan.png" alt="banner" class="banner-image">
                        </div><!--slider-item-->

                    </div><!--slider-->

                    <button class="next slick-arrow">
                        <i class="icon icon-arrow-right"></i>
                    </button>

                </div>
            </div>
        </div>

    </section>

    <section id="client-holder" data-aos="fade-right">
        <div class="container">
            <div class="row">
                <div class="inner-content">
                    <div class="logo-wrap">
                        <div class="grid">
                            <a href="#"><img src="../images/client-image1.png" alt="client"></a>
                            <a href="#"><img src="../images/client-image2.png" alt="client"></a>
                            <a href="#"><img src="../images/client-image3.png" alt="client"></a>
                            <a href="#"><img src="../images/client-image4.png" alt="client"></a>
                            <a href="#"><img src="../images/client-image5.png" alt="client"></a>
                        </div>
                    </div><!--image-holder-->
                </div>
            </div>
        </div>
    </section>

    <?php
    $sql = "SELECT * FROM books ORDER BY id DESC";
    $result = mysqli_query($koneksi, $sql);
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC); // Konversi ke array asosiatif
    ?>

    <section id="featured-books" class="py-5 my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header align-center">
                        <div class="title">
                            <span>Some quality items</span>
                        </div>
                        <h2 class="section-title">Featured Books</h2>
                    </div>

                    <div class="product-list" data-aos="fade-up">
                        <div class="row">
                            <?php foreach ($products as $product): ?>
                                <div class="col-md-3">
                                    <div class="product-item">
                                        <figure class="product-style">
                                            <img src="<?= htmlspecialchars($product['Foto']) ?>"
                                                alt="<?= htmlspecialchars($product['Nama_Buku']) ?>"
                                                class="product-item">
                                            <button type="button" class="add-to-cart" data-product-tile="add-to-cart">
                                                Add to Cart
                                            </button>
                                        </figure>
                                        <figcaption>
                                            <h3><?= htmlspecialchars($product['Nama_Buku']) ?></h3>
                                            <div class="item-price">Rp <?= number_format($product['Harga'], 0, ',', '.') ?></div>
                                        </figcaption>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <div class="btn-wrap align-right">
                    <a href="#" class="btn-accent-arrow">View all products <i
                            class="icon icon-ns-arrow-right"></i></a>
                </div>

            </div>
        </div>
    </section>

    <section id="best-selling" class="leaf-pattern-overlay">
        <div class="corner-pattern-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-8">

                    <div class="row">

                        <div class="col-md-6">
                            <figure class="products-thumb">
                                <img src="../images/ayat-ayat-cinta.png" alt="book" class="single-image">
                            </figure>
                        </div>

                        <div class="col-md-6">
                            <div class="product-entry">
                                <h2 class="section-title divider">Best Selling Book</h2>

                                <div class="products-content">
                                    <div class="author-name">By Habiburrahman El Shirazy</div>
                                    <h3 class="item-title">Ayat-Ayat Cinta</h3>
                                    <p>Ayat Ayat Cinta adalah novel yang sangat bagus dan lengkap kandungannya. Ini bukan hanya novel sastra dan cinta, tapi juga novel politik, novel budaya, novel reliji, novel fikih, novel etika, novel bahasa, dan novel dakwah. Sangat bagus untuk dibaca siapa saja.</p>
                                    <div class="item-price">Rp <?= number_format($product['Harga'], 0, ',', '.'); ?></div>
                                    <div class="btn-wrap">
                                        <a href="#" class="btn-accent-arrow">shop it now <i
                                                class="icon icon-ns-arrow-right"></i></a>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- / row -->

                </div>

            </div>
        </div>
    </section>

    <section id="popular-books" class="bookshelf py-5 my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="section-header align-center">
                        <div class="title">
                            <span>Some quality items</span>
                        </div>
                        <h2 class="section-title">Popular Books</h2>
                    </div>

                    <ul class="tabs">
                        <li data-tab-target="#all-genre" class="active tab">All Genre</li>
                        <li data-tab-target="#business" class="tab">Business</li>
                        <li data-tab-target="#technology" class="tab">Technology</li>
                        <li data-tab-target="#romantic" class="tab">Romantic</li>
                        <li data-tab-target="#adventure" class="tab">Fiction</li>
                    </ul>

                    <div class="tab-content">
                        <div id="all-genre" data-tab-content class="active">
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="product-item">
                                        <figure class="product-style">
                                            <img src="../images/rumahKaca.jpg" alt="Books" class="product-item">
                                            <button type="button" class="add-to-cart"
                                                data-product-tile="add-to-cart">Add to
                                                Cart</button>
                                        </figure>
                                        <figcaption>
                                            <h3>Rumah Kaca</h3>
                                            <span>Pramoedya Ananta Toerr</span>
                                            <div class="item-price">Rp 137.000</div>
                                        </figcaption>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="product-item">
                                        <figure class="product-style">
                                            <img src="../images/kewirausahaanUMKM.jpg" alt="Books" class="product-item">
                                            <button type="button" class="add-to-cart"
                                                data-product-tile="add-to-cart">Add to
                                                Cart</button>
                                        </figure>
                                        <figcaption>
                                            <h3>Kunci Keberlanjutan UMKM di Era Digital</h3>
                                            <span>Ce Gunawan</span>
                                            <div class="item-price">Rp 129.000</div>
                                        </figcaption>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="product-item">
                                        <figure class="product-style">
                                            <img src="../images/buku_teknologi1.jpg" alt="Books" class="product-item">
                                            <button type="button" class="add-to-cart"
                                                data-product-tile="add-to-cart">Add to
                                                Cart</button>
                                        </figure>
                                        <figcaption>
                                            <h3>Pemahaman Dasar Tentang Teknologi Media Dan Sumber Media Pembelajaran</h3>
                                            <span>Wiene Surya Putra, S.Pd., M.Pd</span>
                                            <div class="item-price">Rp 109.000</div>
                                        </figcaption>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="product-item">
                                        <figure class="product-style">
                                            <img src="../images/kemarauseDanau.jpg" alt="Books" class="product-item">
                                            <button type="button" class="add-to-cart"
                                                data-product-tile="add-to-cart">Add to
                                                Cart</button>
                                        </figure>
                                        <figcaption>
                                            <h3>Kemarau di Sedanau</h3>
                                            <span>Asroruddin Zoechni</span>
                                            <div class="item-price">Rp 79.000</div>
                                        </figcaption>
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="product-item">
                                        <figure class="product-style">
                                            <img src="../images/anjani.jpg" alt="Books" class="product-item">
                                            <button type="button" class="add-to-cart"
                                                data-product-tile="add-to-cart">Add to
                                                Cart</button>
                                        </figure>
                                        <figcaption>
                                            <h3>Anjani</h3>
                                            <span>Nuning Soedibjo</span>
                                            <div class="item-price">Rp 99.000</div>
                                        </figcaption>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="product-item">
                                        <figure class="product-style">
                                            <img src="../images/strategiJasa.jpg" alt="Books" class="product-item">
                                            <button type="button" class="add-to-cart"
                                                data-product-tile="add-to-cart">Add to
                                                Cart</button>
                                        </figure>
                                        <figcaption>
                                            <h3>Strategi Peningkatan Kualitas Layanan Jasa</h3>
                                            <span>Yupi Yuliawati</span>
                                            <div class="item-price">Rp 79.000</div>
                                        </figcaption>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="product-item">
                                        <figure class="product-style">
                                            <img src="../images/perkembanganteknologi.jpg" alt="Books" class="product-item">
                                            <button type="button" class="add-to-cart"
                                                data-product-tile="add-to-cart">Add to
                                                Cart</button>
                                        </figure>
                                        <figcaption>
                                            <h3>Perkembangan Teknologi Komunikasi</h3>
                                            <span>Fadhil Pahlevi Hidayat,S.I.Kom., M.I.Kom.</span>
                                            <div class="item-price">Rp 52.000</div>
                                        </figcaption>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="product-item">
                                        <figure class="product-style">
                                            <img src="../images/popularbooks8.jpg" alt="Books" class="product-item">
                                            <button type="button" class="add-to-cart"
                                                data-product-tile="add-to-cart">Add to
                                                Cart</button>
                                        </figure>
                                        <figcaption>
                                            <h3>Perfect Imperfections</h3>
                                            <span>Nathalia Theodora</span>
                                            <div class="item-price">Rp 79.000</div>
                                        </figcaption>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div id="business" data-tab-content>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="product-item">
                                        <figure class="product-style">
                                            <img src="../images/tab-item2.jpg" alt="Books" class="product-item">
                                            <button type="button" class="add-to-cart"
                                                data-product-tile="add-to-cart">Add to
                                                Cart</button>
                                        </figure>
                                        <figcaption>
                                            <h3>Peaceful Enlightment</h3>
                                            <span>Marmik Lama</span>
                                            <div class="item-price">$ 40.00</div>
                                        </figcaption>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="product-item">
                                        <figure class="product-style">
                                            <img src="../images/tab-item4.jpg" alt="Books" class="product-item">
                                            <button type="button" class="add-to-cart"
                                                data-product-tile="add-to-cart">Add to
                                                Cart</button>
                                        </figure>
                                        <figcaption>
                                            <h3>Great travel at desert</h3>
                                            <span>Sanchit Howdy</span>
                                            <div class="item-price">$ 40.00</div>
                                        </figcaption>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="product-item">
                                        <figure class="product-style">
                                            <img src="../images/tab-item6.jpg" alt="Books" class="product-item">
                                            <button type="button" class="add-to-cart"
                                                data-product-tile="add-to-cart">Add to
                                                Cart</button>
                                        </figure>
                                        <figcaption>
                                            <h3>Life among the pirates</h3>
                                            <span>Armor Ramsey</span>
                                            <div class="item-price">$ 40.00</div>
                                        </figcaption>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="product-item">
                                        <figure class="product-style">
                                            <img src="../images/tab-item8.jpg" alt="Books" class="product-item">
                                            <button type="button" class="add-to-cart"
                                                data-product-tile="add-to-cart">Add to
                                                Cart</button>
                                        </figure>
                                        <figcaption>
                                            <h3>Simple way of piece life</h3>
                                            <span>Armor Ramsey</span>
                                            <div class="item-price">$ 40.00</div>
                                        </figcaption>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div id="technology" data-tab-content>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="product-item">
                                        <figure class="product-style">
                                            <img src="../images/tab-item1.jpg" alt="Books" class="product-item">
                                            <button type="button" class="add-to-cart"
                                                data-product-tile="add-to-cart">Add to
                                                Cart</button>
                                        </figure>
                                        <figcaption>
                                            <h3>Peaceful Enlightment</h3>
                                            <span>Marmik Lama</span>
                                            <div class="item-price">$ 40.00</div>
                                        </figcaption>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="product-item">
                                        <figure class="product-style">
                                            <img src="../images/tab-item3.jpg" alt="Books" class="product-item">
                                            <button type="button" class="add-to-cart"
                                                data-product-tile="add-to-cart">Add to
                                                Cart</button>
                                        </figure>
                                        <figcaption>
                                            <h3>Great travel at desert</h3>
                                            <span>Sanchit Howdy</span>
                                            <div class="item-price">$ 40.00</div>
                                        </figcaption>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="product-item">
                                        <figure class="product-style">
                                            <img src="../images/tab-item5.jpg" alt="Books" class="product-item">
                                            <button type="button" class="add-to-cart"
                                                data-product-tile="add-to-cart">Add to
                                                Cart</button>
                                        </figure>
                                        <figcaption>
                                            <h3>Life among the pirates</h3>
                                            <span>Armor Ramsey</span>
                                            <div class="item-price">$ 40.00</div>
                                        </figcaption>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="product-item">
                                        <figure class="product-style">
                                            <img src="../images/tab-item7.jpg" alt="Books" class="product-item">
                                            <button type="button" class="add-to-cart"
                                                data-product-tile="add-to-cart">Add to
                                                Cart</button>
                                        </figure>
                                        <figcaption>
                                            <h3>Simple way of piece life</h3>
                                            <span>Armor Ramsey</span>
                                            <div class="item-price">$ 40.00</div>
                                        </figcaption>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="romantic" data-tab-content>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="product-item">
                                        <figure class="product-style">
                                            <img src="../images/tab-item1.jpg" alt="Books" class="product-item">
                                            <button type="button" class="add-to-cart"
                                                data-product-tile="add-to-cart">Add to
                                                Cart</button>
                                        </figure>
                                        <figcaption>
                                            <h3>Peaceful Enlightment</h3>
                                            <span>Marmik Lama</span>
                                            <div class="item-price">$ 40.00</div>
                                        </figcaption>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="product-item">
                                        <figure class="product-style">
                                            <img src="../images/tab-item3.jpg" alt="Books" class="product-item">
                                            <button type="button" class="add-to-cart"
                                                data-product-tile="add-to-cart">Add to
                                                Cart</button>
                                        </figure>
                                        <figcaption>
                                            <h3>Great travel at desert</h3>
                                            <span>Sanchit Howdy</span>
                                            <div class="item-price">$ 40.00</div>
                                        </figcaption>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="product-item">
                                        <figure class="product-style">
                                            <img src="../images/tab-item5.jpg" alt="Books" class="product-item">
                                            <button type="button" class="add-to-cart"
                                                data-product-tile="add-to-cart">Add to
                                                Cart</button>
                                        </figure>
                                        <figcaption>
                                            <h3>Life among the pirates</h3>
                                            <span>Armor Ramsey</span>
                                            <div class="item-price">$ 40.00</div>
                                        </figcaption>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="product-item">
                                        <figure class="product-style">
                                            <img src="../images/tab-item7.jpg" alt="Books" class="product-item">
                                            <button type="button" class="add-to-cart"
                                                data-product-tile="add-to-cart">Add to
                                                Cart</button>
                                        </figure>
                                        <figcaption>
                                            <h3>Simple way of piece life</h3>
                                            <span>Armor Ramsey</span>
                                            <div class="item-price">$ 40.00</div>
                                        </figcaption>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="adventure" data-tab-content>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="product-item">
                                        <figure class="product-style">
                                            <img src="../images/tab-item5.jpg" alt="Books" class="product-item">
                                            <button type="button" class="add-to-cart"
                                                data-product-tile="add-to-cart">Add to
                                                Cart</button>
                                        </figure>
                                        <figcaption>
                                            <h3>Life among the pirates</h3>
                                            <span>Armor Ramsey</span>
                                            <div class="item-price">$ 40.00</div>
                                        </figcaption>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="product-item">
                                        <figure class="product-style">
                                            <img src="../images/tab-item7.jpg" alt="Books" class="product-item">
                                            <button type="button" class="add-to-cart"
                                                data-product-tile="add-to-cart">Add to
                                                Cart</button>
                                        </figure>
                                        <figcaption>
                                            <h3>Simple way of piece life</h3>
                                            <span>Armor Ramsey</span>
                                            <div class="item-price">$ 40.00</div>
                                        </figcaption>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="fictional" data-tab-content>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="product-item">
                                        <figure class="product-style">
                                            <img src="../images/tab-item5.jpg" alt="Books" class="product-item">
                                            <button type="button" class="add-to-cart"
                                                data-product-tile="add-to-cart">Add to
                                                Cart</button>
                                        </figure>
                                        <figcaption>
                                            <h3>Life among the pirates</h3>
                                            <span>Armor Ramsey</span>
                                            <div class="item-price">$ 40.00</div>
                                        </figcaption>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="product-item">
                                        <figure class="product-style">
                                            <img src="../images/tab-item7.jpg" alt="Books" class="product-item">
                                            <button type="button" class="add-to-cart"
                                                data-product-tile="add-to-cart">Add to
                                                Cart</button>
                                        </figure>
                                        <figcaption>
                                            <h3>Simple way of piece life</h3>
                                            <span>Armor Ramsey</span>
                                            <div class="item-price">$ 40.00</div>
                                        </figcaption>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div><!--inner-tabs-->

            </div>
        </div>
    </section>

    <section id="quotation" class="align-center pb-5 mb-5">
        <div class="inner-content">
            <h2 class="section-title divider">Quote of the day</h2>
            <blockquote data-aos="fade-up">
                <q>“The more that you read, the more things you will know. The more that you learn, the more places
                    you’ll go.”</q>
                <div class="author-name">Dr. Seuss</div>
            </blockquote>
        </div>
    </section>

    <section id="special-offer" class="bookshelf pb-5 mb-5">

        <div class="section-header align-center">
            <div class="title">
                <span>Grab your opportunity</span>
            </div>
            <h2 class="section-title">Books with offer</h2>
        </div>

        <div class="container">
            <div class="row">
                <div class="inner-content">
                    <div class="product-list" data-aos="fade-up">
                        <div class="grid product-grid">
                            <div class="product-item">
                                <figure class="product-style">
                                    <img src="../images/bukudiskon1.jpg" alt="Books" class="product-item">
                                    <button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add to
                                        Cart</button>
                                </figure>
                                <figcaption>
                                    <h3>Perayaan dari Masa Depan</h3>
                                    <span>Zemiko</span>
                                    <div class="item-price">
                                        <span class="prev-price">Rp 99.000</span>Rp 89.100
                                    </div>
                            </div>
                            </figcaption>

                            <div class="product-item">
                                <figure class="product-style">
                                    <img src="../images/bukudiskon2jpg.jpg" alt="Books" class="product-item">
                                    <button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add to
                                        Cart</button>
                                </figure>
                                <figcaption>
                                    <h3>Data Mining</h3>
                                    <span>Lailil Muflikhah, Dian Eka Ratnawati, Rekyan Regasari Mardi Putri</span>
                                    <div class="item-price">
                                        <span class="prev-price">Rp 109.000</span>Rp 98.100
                                    </div>
                            </div>
                            </figcaption>

                            <div class="product-item">
                                <figure class="product-style">
                                    <img src="../images/bukudiskon3.jpg" alt="Books" class="product-item">
                                    <button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add to
                                        Cart</button>
                                </figure>
                                <figcaption>
                                    <h3>Manajemen Resiko</h3>
                                    <span>Suharno, S.E., M.M.</span>
                                    <div class="item-price">
                                        <span class="prev-price">Rp 99.000</span>Rp 89.100
                                    </div>
                            </div>
                            </figcaption>

                            <div class="product-item">
                                <figure class="product-style">
                                    <img src="../images/product-item8.jpg" alt="Books" class="product-item">
                                    <button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add to
                                        Cart</button>
                                </figure>
                                <figcaption>
                                    <h3>Once upon a time</h3>
                                    <span>Klien Marry</span>
                                    <div class="item-price">
                                        <span class="prev-price">$ 25.00</span>$ 35.00
                                    </div>
                            </div>
                            </figcaption>

                            <div class="product-item">
                                <figure class="product-style">
                                    <img src="../images/product-item2.jpg" alt="Books" class="product-item">
                                    <button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add to
                                        Cart</button>
                                </figure>
                                <figcaption>
                                    <h3>Simple way of piece life</h3>
                                    <span>Armor Ramsey</span>
                                    <div class="item-price">$ 40.00</div>
                                </figcaption>
                            </div>
                        </div><!--grid-->
                    </div>
                </div><!--inner-content-->
            </div>
        </div>
    </section>

    <footer id="footer">
        <div class="container">
            <div class="row">

                <div class="col-md-4">

                    <div class="footer-item">
                        <div class="company-brand">
                            <img src="../images/logo-view-awal-removebg-preview.png" alt="logo" class="footer-logo">
                            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sagittis sed ptibus liberolectus
                                nonet psryroin. Amet sed lorem posuere sit iaculis amet, ac urna. Adipiscing fames
                                semper erat ac in suspendisse iaculis.</p> -->
                        </div>
                    </div>

                </div>

                <div class="col-md-2">

                    <div class="footer-menu">
                        <h5>About Us</h5>
                        <ul class="menu-list">
                            <li class="menu-item">
                                <a href="#">Vision</a>
                            </li>
                            <li class="menu-item">
                                <a href="#">Articles </a>
                            </li>
                            <li class="menu-item">
                                <a href="#">Service Terms</a>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="col-md-2">

                    <div class="footer-menu">
                        <h5>My account</h5>
                        <ul class="menu-list">
                            <li class="menu-item">
                                <a href="#">Sign In</a>
                            </li>
                            <li class="menu-item">
                                <a href="#">My Wishtlist</a>
                            </li>
                            <li class="menu-item">
                                <a href="#">Track My Order</a>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="col-md-2">

                    <div class="footer-menu">
                        <h5>Help</h5>
                        <ul class="menu-list">
                            <li class="menu-item">
                                <a href="#">Help center</a>
                            </li>
                            <li class="menu-item">
                                <a href="#">Report a problem</a>
                            </li>
                            <li class="menu-item">
                                <a href="#">Contact us</a>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>
            <!-- / row -->

        </div>
    </footer>

    <div id="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="copyright">
                        <div class="row">

                            <div class="col-md-6">
                                <p>© 2022 All rights reserved. Free HTML Template by <a
                                        href="https://www.templatesjungle.com/" target="_blank">TemplatesJungle</a></p>
                            </div>

                            <div class="col-md-6">
                                <div class="social-links align-right">
                                    <ul>
                                        <li>
                                            <a href="#"><i class="icon icon-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="icon icon-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="icon icon-youtube-play"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="icon icon-behance-square"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div><!--grid-->

                </div><!--footer-bottom-content-->
            </div>
        </div>
    </div>

    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <script src="../js/plugins.js"></script>
    <script src="../js/script.js"></script>
    <!-- <script src="js/sticky-logo.js"></script> -->

</body>

</html>