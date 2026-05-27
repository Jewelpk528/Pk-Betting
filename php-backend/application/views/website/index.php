<!-- preloader area start -->
<div class="preloader" id="preloader">
    <div class="loader loader-1">
        <div class="loader-outter"></div>
        <div class="loader-inner"></div>
    </div>
</div>
<!-- preloader area end -->

<!-- Hero Area Start -->
<div class="hero-area hero-area2 hero-area5 hero-text" style="background:url(<?= base_url('uploads/banner/'.$banner->banner)?>)">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="content">
                    <h2 class="subtitle">
                        Play Big Win Big, Download <?= PROJECT_NAME ?> Now!
                    </h2>
                    <p class="b-animate-thumb">Trusted by 5+ Millions players</p>
                     <div class="links">
                        <a href="<?= base_url('game.apk') ?>" download class="mybtn1 download_btn download_copy">Download APK</a>
                    </div>
                </div>
            </div>
   
        </div>
    </div>
</div>
<!-- Hero Area End -->

<!-- Game play area start -->
<section class="game-play-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h5 class="subtitle"><?= PROJECT_NAME ?></h5>
                    <h2 class="title">To win Real Money In Cash Rupees!</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <!-- Cards start -->
            <div class="col-xl-6 col-lg-4 col-md-6">
                <div class="single-play">
                    <div class="image">
                        <img src="<?= IMAGE_URL.$banner->image1 ?>" alt="">
                    </div>
                    <div class="text text-center mt-3">
                        <div class="title">Easy Sign Up</div>
                        <p>Sign up <?= PROJECT_NAME ?> with Facebook Account and WIN BIG! Deposit or withdraw money for registered players only.</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-4 col-md-6">
                <div class="single-play">
                    <div class="image">
                        <img src="<?= IMAGE_URL.$banner->image2 ?>" alt="">
                    </div>
                    <div class="text text-center mt-3">
                        <div class="title">Free Chips</div>
                        <p>Daily Bonus: Claim Free chips everyday in <?= PROJECT_NAME ?>. Win a daily bonus of up to ₹30,000 in chips!</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-4 col-md-6">
                <div class="single-play">
                    <div class="image">
                        <img src="<?= IMAGE_URL.$banner->image3 ?>" alt="">
                    </div>
                    <div class="text text-center mt-3">
                        <div class="title">Win Cash in Game</div>
                        <p>Select your preferred stakes 0.2Rs/0.5Rs and start playing <?= PROJECT_NAME ?> right away.</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-4 col-md-6">
                <div class="single-play">
                    <div class="image">
                        <img src="<?= IMAGE_URL.$banner->image4 ?>" alt="">
                    </div>
                    <div class="text text-center mt-3">
                        <div class="title">Indian Cards Games</div>
                        <p>Play <?= PROJECT_NAME ?> anytime, anywhere. Win a lot of chips in new game modes and Variations. Win the most chips come on top!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Game play area end -->

<!-- join us area start -->
<section class="join_us join_us2 join_us3">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-xl-5">
                <img src="<?= IMAGE_URL.$banner->image5 ?>" alt="" width="480">
            </div>
            <div class="col-xl-7">
                <div class="section-heading content-left">
                    <h5 class="subtitle">WHO WE'RE</h5>
                    <p class="content text-justify"><?= PROJECT_NAME ?> is online Rummy portal completely owned and operated by <?= COMPANY_NAME ?>. We provide best-in-class gaming experience to all its users. Our aim is to give every player a premium and hassle-free rummy-playing experience on our android and iOS app. Our games are designed in a manner that anybody can play without facing any difficulties.</p>
                    <p class="content text-justify"><?= PROJECT_NAME ?> is on a mission to promote Rummy & <?= PROJECT_NAME ?> as a professional game and create a community of skilled gamers. Rummy & <?= PROJECT_NAME ?> is a game of skill as opposed to games of chance. It involves skill to win.</p>
                    <p class="content text-justify">We at <?= PROJECT_NAME ?> understand the needs of online gaming in India and strive to provide better and faster results through our software. Our software is built on a custom built architecture to be robust in operating Multi-Player Tables and Online Tournaments.</p>
                    <a href="<?= base_url('game.apk') ?>" download class="mybtn1 download_btn download_copy">Download APK</a>
                </div>

                <!-- Social Share -->
                <p class="mt-4">Follow <b><?= PROJECT_NAME ?></b> on social media</p>
                <div class="share_small mt-2">
                    <button onclick="window.open('<?= $facebook_link ?>','_blank','width=600,height=400')" title="Facebook" style="background:#3b5998;color:#fff;padding:10px 15px;margin:5px;border:0;border-radius:50%;font-size:18px;cursor:pointer;"><i class="fab fa-facebook-f"></i></button>

                    <button onclick="window.open('<?= $twitter_link ?>','_blank','width=600,height=400')" title="Twitter" style="background:#1da1f2;color:#fff;padding:10px 15px;margin:5px;border:0;border-radius:50%;font-size:18px;cursor:pointer;"><i class="fab fa-twitter"></i></button>

                    <button onclick="window.open('<?= $telegram_link ?>','_blank','width=600,height=400')" title="Telegram" style="background:#0088cc;color:#fff;padding:10px 15px;margin:5px;border:0;border-radius:50%;font-size:18px;cursor:pointer;"><i class="fab fa-telegram-plane"></i></button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- join us area end -->

<!-- FontAwesome & Share Script -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script>
    function openLink(url) {
        if (url && url.trim() !== "") {
            window.open(url, '_blank', 'width=600,height=400');
        } else {
            alert("Link not configured!");
        }
    }
</script>
