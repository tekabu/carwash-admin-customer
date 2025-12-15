<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

<!-- Promotion Slider Section -->
<section class="promotion-section py-120">
    <div class="container">

        <div class="text-center mb-5">
            <span class="site-title-tagline">Promotions</span>
            <h2 class="site-title">Classy Kars <span>Promos</span></h2>
            <div class="heading-divider"></div>
        </div>

        <!-- Swiper Container -->
        <div class="swiper promoSwiper">
            <div class="swiper-wrapper">

                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <div class="row align-items-center g-5 promo-row">
                        <div class="col-lg-6 d-flex justify-content-center">
                            <img src="{{ asset('publicx/assets/img/promos/gold.png') }}"
                                 class="promo-img"
                                 alt="Gold Package"
                                 onclick="zoomImage(this.src)">
                        </div>
                        <div class="col-lg-6 text-start promo-text">
                            <span class="section-tagline">Best Value</span>
                            <h2 class="promo-title">Gold Car Care Package</h2>
                            <p class="promo-desc">
                                Give your car the ultimate treatment with our Gold Package superior exterior and interior care designed to restore shine, protect surfaces, and keep your car looking brand-new.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <div class="row align-items-center g-5 promo-row">
                        <div class="col-lg-6 d-flex justify-content-center">
                            <img src="{{ asset('publicx/assets/img/promos/dia.png') }}"
                                 class="promo-img"
                                 alt="Diamond Package"
                                 onclick="zoomImage(this.src)">
                        </div>
                        <div class="col-lg-6 text-start promo-text">
                            <span class="section-tagline">Premium Value</span>
                            <h2 class="promo-title">Diamond Car Care Package</h2>
                            <p class="promo-desc">
                                Experience unmatched luxury and paint protection with our Diamond Package. Perfect for customers who want flawless shine, advanced coating, and meticulous detailing.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <div class="row align-items-center g-5 promo-row">
                        <div class="col-lg-6 d-flex justify-content-center">
                            <img src="{{ asset('publicx/assets/img/promos/9h.jpg') }}"
                                 class="promo-img"
                                 alt="Graphene Coating"
                                 onclick="zoomImage(this.src)">
                        </div>
                        <div class="col-lg-6 text-start promo-text">
                            <span class="section-tagline">Graphene Coating</span>
                            <h2 class="promo-title">20H Premium Graphene Coating</h2>
                            <p class="promo-desc">
                                Get next-level protection with our 20H Graphene Coating — extreme durability, high gloss, and long-lasting shield against dirt, UV rays, and scratches.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Slide 4 -->
                <div class="swiper-slide">
                    <div class="row align-items-center g-5 promo-row">
                        <div class="col-lg-6 d-flex justify-content-center">
                            <img src="{{ asset('publicx/assets/img/promos/20h.jpg') }}"
                                 class="promo-img"
                                 alt="9H Coating"
                                 onclick="zoomImage(this.src)">
                        </div>
                        <div class="col-lg-6 text-start promo-text">
                            <span class="section-tagline">9H Ceramic Coating</span>
                            <h2 class="promo-title">9H Ceramic Coating</h2>
                            <p class="promo-desc">
                                9H Ceramic Coating provides a long-lasting protective layer that makes your car more resistant to scratches, UV rays, water, and dirt. It gives your vehicle a deep glossy shine and keeps the surface easier to clean for months.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Navigation & Pagination -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>

    </div>
</section>

<!-- Image Zoom Lightbox -->
<div id="imgLightbox" class="lightbox" onclick="closeLightbox()">
    <img id="lightboxImg" class="lightbox-content">
</div>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<script>
const swiper = new Swiper('.promoSwiper', {
    loop: true,
    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    speed: 900,
});

// IMAGE ZOOM
function zoomImage(src) {
    document.getElementById("lightboxImg").src = src;
    document.getElementById("imgLightbox").style.display = "flex";
}

function closeLightbox() {
    document.getElementById("imgLightbox").style.display = "none";
}
</script>

<style>
/* Section Background */
.promotion-section {
    background: #f8f9fa;
}

/* --- PROMO SLIDER LAYOUT --- */
.promo-row {
    display: flex;
    align-items: center;
    justify-content: center !important;
}

/* Center all images */
.promo-img {
    width: 75%;
    max-width: 380px;
    display: block;
    margin: 0 auto;
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    transition: 0.4s ease;
    cursor: zoom-in;
}

.promo-img:hover {
    transform: scale(1.03);
}

/* Left-aligned text for ALL slides */
.promo-text {
    text-align: left !important;
}

/* Tagline */
.section-tagline {
    color: #00b33c;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.95rem;
    letter-spacing: 1px;
    margin-bottom: 8px;
    display: inline-block;
}

/* Title */
.promo-title {
    font-size: 2.2rem;
    font-weight: 800;
    color: #111;
    margin-bottom: 15px;
}

/* Description */
.promo-desc {
    font-size: 1.1rem;
    color: #444;
    line-height: 1.65;
}

/* Swiper Buttons */
.swiper-button-next, .swiper-button-prev {
    color: #00b33c !important;
    width: 45px;
    height: 45px;
}

.swiper-button-next:hover, .swiper-button-prev:hover {
    transform: scale(1.12);
}

/* Pagination */
.swiper-pagination-bullet {
    background: #ccc;
    opacity: 1;
}

.swiper-pagination-bullet-active {
    background: #00b33c;
}

/* IMAGE LIGHTBOX */
.lightbox {
    display: none;
    position: fixed;
    z-index: 99999;
    padding: 40px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.85);
    justify-content: center;
    align-items: center;
}

.lightbox-content {
    max-width: 90%;
    max-height: 90%;
    border-radius: 12px;
    box-shadow: 0 0 30px rgba(255,255,255,0.2);
    animation: zoomIn 0.3s ease;
}

@keyframes zoomIn {
    from { transform: scale(0.7); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

/* Responsive */
@media (max-width: 992px) {
    .promo-title {
        font-size: 1.8rem;
    }
    .promo-desc {
        font-size: 1rem;
    }
    .promo-img {
        width: 70%;
    }
}
</style>
