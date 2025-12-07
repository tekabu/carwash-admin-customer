<!-- RFID / About Area -->
<div class="about-area py-140 position-relative">
    <div class="container">

        <div class="row align-items-center">

            <!-- LEFT SIDE (Carousel + Floating Badge) -->
            <div class="col-lg-6">
                <div class="about-left position-relative">

                    <!-- Floating RFID Badge -->
                    <div class="about-experience text-white p-3 px-4 rounded-4 shadow-glass position-absolute"
                        style="bottom: 10%; left: 10%; animation: floatBadge 4s ease-in-out infinite;">
                        <i class="icon-car-service-4 fa-2x mb-2 d-block"></i>
                        <b class="fw-semibold">Powered by <br> RFID Technology</b>
                    </div>

                    <!-- Video Carousel -->
                    <div class="carousel-wrapper rounded-4 shadow-glass overflow-hidden">
                        <div id="videoCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <iframe class="video-frame" src="https://www.youtube.com/embed/fTzTXr-RADc" allowfullscreen></iframe>
                                </div>
                                <div class="carousel-item">
                                    <iframe class="video-frame" src="https://www.youtube.com/embed/zMLdJU_Uj5c" allowfullscreen></iframe>
                                </div>
                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#videoCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#videoCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <!-- RIGHT SIDE (Text) -->
            <div class="col-lg-6">
                <div class="about-right ps-lg-5 mt-4 mt-lg-0 fade-up">
                    <div class="site-heading mb-4">
                        <span class="site-title-tagline text-success fw-bold">Our Technology</span>
                        <h2 class="site-title fw-bold lh-base">
                            Automatic Carwash with <span class="text-success">RFID Innovation</span>
                        </h2>
                    </div>

                    <p class="about-text lead text-dark opacity-75 mb-4">
                        Experience the future of car care. Our RFID-enabled system instantly recognizes your vehicle, providing a smooth, contactless, and ultra-fast carwash — every single time.
                    </p>

                    <ul class="about-list list-unstyled mb-4">
                        <li class="mb-3"><strong>Contactless Operation:</strong> Instant recognition with RFID — no delays.</li>
                        <li class="mb-3"><strong>Fully Automated:</strong> From plan selection to wash completion.</li>
                        <li class="mb-3"><strong>Eco-Friendly:</strong> Smart water recycling and efficient wash cycles.</li>
                        <li class="mb-3"><strong>Real-Time Monitoring:</strong> Track your wash status via our mobile app.</li>
                    </ul>
                <!-- <div>   
                    <a href="{{ route('services') }}" class="theme-btn btn btn-success px-4 py-2 mt-3 shadow-sm rounded-3">
                        Learn More <i class="far fa-arrow-right ms-2"></i>
                    </a>
                </div> -->
            </div>

        </div>

        <!-- STEP-BY-STEP SECTION -->
        <div class="row mt-5 pt-4">
            <div class="col-12">
                <h3 class="text-center mb-5 fw-bold text-dark fade-up">
                    How RFID Technology Enhances Your Carwash Experience
                </h3>

                <!-- Step 1 -->
                <div class="row step-row align-items-center mb-5">
                    <div class="col-md-6">
                        <div class="image-card">
                            <img src="{{ asset('publicx/assets/img/about/kiosk2.avif') }}" class="step-img uniform-img">
                        </div>
                    </div>
                    <div class="col-md-6 fade-up">
                        <h5 class="text-success fw-bold mb-3">Step 1: Customize at the Kiosk</h5>
                        <p class="text-dark">Easily choose or personalize your preferred carwash program using our interactive kiosk.</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="row step-row align-items-center mb-5 flex-md-row-reverse">
                    <div class="col-md-6">
                        <div class="image-card">
                            <img src="{{ asset('publicx/assets/img/about/tap5.png') }}" class="step-img uniform-img">
                        </div>
                    </div>
                    <div class="col-md-6 fade-up">
                        <h5 class="text-success fw-bold mb-3">Step 2: Tap RFID Card</h5>
                        <p class="text-dark">Tap your RFID card and your plan loads automatically — you're instantly ready.</p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="row step-row align-items-center mb-5">
                    <div class="col-md-6">
                        <div class="image-card">
                              <img src="{{ asset('publicx/assets/img/service/carwash.png') }}" class="step-img uniform-img">
                        </div>
                    </div>
                    <div class="col-md-6 fade-up">
                        <h5 class="text-success fw-bold mb-3">Step 3: Enjoy the Results</h5>
                        <p class="text-dark">Sit back and relax while our smart system completes a fast, clean, and safe wash.</p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>


<style>
/* ============================= */
/* ANIMATIONS */
/* ============================= */
@keyframes floatBadge {
    0%,100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
}
.fade-up {
    animation: fadeUp 1s ease both;
}
@keyframes fadeUp {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
}

/* ============================= */
/* GLASSMORPHISM ELEMENTS */
/* ============================= */
.shadow-glass {
    background: rgba(25,135,84,0.2);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.25);
    box-shadow: 0 8px 28px rgba(0,0,0,0.18);
}

.carousel-wrapper {
    background: rgba(255,255,255,0.35);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,0.35);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}

/* ============================= */
/* STEP IMAGE CARD */
/* ============================= */
.image-card {
    background: rgba(255,255,255,0.35);
    padding: 12px;
    border-radius: 18px;
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,0.25);
    box-shadow: 0 12px 30px rgba(0,0,0,0.12);
    transition: transform .3s ease, box-shadow .3s ease;
}
.image-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 45px rgba(0,0,0,0.15);
}

/* UNIFORM IMAGE SIZE */
.uniform-img {
    width: 100%;
    height: 290px;
    object-fit: cover;
    border-radius: 16px;
    transition: transform .3s ease;
}
.uniform-img:hover {
    transform: scale(1.04);
}

/* VIDEO FRAME */
.video-frame {
    width: 100%;
    height: 330px;
    border: none;
}

/* RESPONSIVE */
@media(max-width: 767px) {
    .image-card { padding: 8px; }
    .uniform-img { height: 240px; }
    .step-row { text-align: center; }
}
</style>
