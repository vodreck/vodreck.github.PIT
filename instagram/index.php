<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <title>instagram Pete's Coffee</title>
</head>

<body class="body">

    <header>
        <nav class="navbar navbar-light nav-top">
            <div class="container-fluid nav-container">
                <a class="navbar-brand" href="#" target="_blank"><img
                        src="images/logo.png" style=" max-width:130px; max-height:80px"></a>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search">
                </form>
                <div style="width: 30%;">
                    <i class="bi bi-house-door icons"></i>
                    <i class="bi bi-inbox icons"></i>
                    <i class="bi bi-compass icons"></i>
                    <i class="bi bi-heart icons"></i>
                    <img class="img-nav" src="images/foto-instagram.png">
                </div>
            </div>
        </nav>
    </header>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-0 col-md-2"></div>
                <div class="col-12 col-md-8">

                    <div class="container">
                        <div class="row" style="padding-top: 20px;">
                            <div class="col-3">
                                <img class="img-profile" src="images/foto-instagram.png">
                            </div>
                            <div class="col-7">
                                <div class="row" style="padding-top: 20px; padding-bottom: 10px;">
                                    <div class="col-8 col-lg-5">
                                        <h2 class="username">Pete's Coffee</h2>
                                    </div>
                                    <div class="col-4 col-lg-6"><button type="button"
                                            class="btn btn-outline-secondary button-edit">Editar
                                            perfil</button></div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <p class="profile-datas"><strong>9</strong> publicações</p>
                                    </div>
                                    <div class="col-4">
                                        <p class="profile-datas"><strong>45.946</strong> seguidores</p>
                                    </div>
                                    <div class="col-4">
                                        <p class="profile-datas"><strong>1.540</strong> seguindo</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="name">Petes' Coffee</h1>
                                    </div>
                                </div>
                                <div class="row">
    <div class="col-12">
        <br class="profile-desc">
        • O sabor perfeito do café. <br>
        • Cardápio repleto de cafés especiais, cappuccinos e lattes irresistíveis.<br>
        • Siga-nos para novidades, promoções e dicas de baristas apaixonados.<br>
        • Viva o melhor café! ☕✨<br>
        <a href="/Home/home.php">• PettesCoffee.com</a> 
    </div>
</div>

                            </div>
                            <div class="col-2"></div>
                        </div>
                    </div>

                    <div style="padding-top: 0px;">
                        <div class="row">
                            <div class="col-2"> <canvas id="myCrl"></canvas></div>
                            <div class="col-2"> <canvas id="myCrl1"></canvas></div>
                            <div class="col-2"> <canvas id="myCrl2"></canvas></div>
                        </div>
                    </div>
                    <div style="padding-bottom: 40px;">
                        <div class="row">
                            <div class="col-2 stories"> Combos</div>
                            <div class="col-2 stories"> Sucos </div>
                            <div class="col-2 stories"> Eventos </div>
                        </div>
                    </div>

                    <hr size="3" width="100%" color="#EEEEEE" style="margin: 0%;">

                    <ul class="nav nav-tabs nav-feed" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active nav-link-1" id="home-tab" data-bs-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true"><i class="bi bi-grid-3x3"></i> PUBLICAÇÕES</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link nav-link-2" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false"><i class="bi bi-file-person"></i> MARCADOS</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row" style="padding-bottom: 25px;">
                                <div class="col-4">
                                    <div class="card">
                                        <img src="images/post1.png" class="card-img-top" alt="...">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card">
                                        <img src="images/post2.png" class="card-img-top" alt="...">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card">
                                        <img src="images/post3.png" class="card-img-top" alt="...">
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="padding-bottom: 25px;">
                                <div class="col-4">
                                    <div class="card">
                                        <img src="images/post4.png" class="card-img-top" alt="...">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card">
                                        <img src="images/post5.png" class="card-img-top" alt="...">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card">
                                        <img src="images/post6.png" class="card-img-top" alt="...">
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 25px;"></div>
                                <div class="col-4">
                                    <div class="card">
                                        <img src="images/post7.png" class="card-img-top" alt="...">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card">
                                        <img src="images/post8.png" class="card-img-top" alt="...">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card">
                                        <img src="images/post9.png" class="card-img-top" alt="...">
                                    </div>
                                </div>
                            </div>
                                <div class="col-4">
                                    <div class="card">
                                    
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card">
                                        
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"></div>
                    </div>
                </div>
                <div class="col-0 col-md-2"></div>
            </div>
        </div>
    </section>

    <script type="text/javascript">

        var crl = document.getElementById('myCrl').getContext('2d');

        crl.beginPath();
        crl.arc(60, 100, 40, 0, 2 * Math.PI);
        crl.fillStyle = '#e8ae37';
        crl.fill();
        crl.linewidth = 5;
        crl.strokeStyle = '#dbdbdb';
        crl.stroke();

        var crl1 = document.getElementById('myCrl1').getContext('2d');

        crl1.beginPath();
        crl1.arc(60, 100, 40, 0, 2 * Math.PI);
        crl1.fillStyle = '#2d1914';
        crl1.fill();
        crl1.linewidth = 5;
        crl1.strokeStyle = '#dbdbdb';
        crl1.stroke();

        var crl2 = document.getElementById('myCrl2').getContext('2d');

        crl2.beginPath();
        crl2.arc(60, 100, 40, 0, 2 * Math.PI);
        crl2.fillStyle = '#dcceaa';
        crl2.fill();
        crl2.linewidth = 5;
        crl2.strokeStyle = '#dbdbdb';
        crl2.stroke();

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>

</body>

</html>