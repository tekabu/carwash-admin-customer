<!-- Dynamic Alternating Promotion Section -->
<section class="promotion-section py-120">
    <div class="container">

        <div class="text-center mb-5">
            <span class="site-title-tagline">Promotions
            <h2 class="site-title">Our <span>Promotions</span></h2>
            <div class="heading-divider"></div>
        </div>

        <!-- Promotion 1: Image Left -->
          <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <img src="{{ asset('publicx/assets/img/promos/dia.png') }}" 
                     class="promo-img" 
                     alt="Promotion 3">
            </div>
            <div class="col-lg-6">
                <span class="section-tagline">Exclusive Deal</span>
                <h2 class="promo-title">Promotion Title 3</h2>
                <p class="promo-desc">Describe the promotion clearly, highlighting key benefits and value to the customer.</p>
            </div>
        </div>

        <!-- Promotion 2: Image Right -->
        <div class="row align-items-center g-5 mb-5 flex-lg-row-reverse">
            <div class="col-lg-6">
             <img src="{{ asset('publicx/assets/img/promos/dia.png') }}" 
                     class="promo-img" 
                     alt="Promotion 2">
            </div>
            <div class="col-lg-6">
                <span class="section-tagline">Limited Time</span>
                <h2 class="promo-title">Promotion Title 2</h2>
                <p class="promo-desc">Explain what makes this promotion unique and why customers should act fast.</p>
            </div>
        </div>

        <!-- Promotion 3: Image Left -->
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <img src="{{ asset('publicx/assets/img/promos/dia.png') }}" 
                     class="promo-img" 
                     alt="Promotion 3">
            </div>
            <div class="col-lg-6">
                <span class="section-tagline">Exclusive Deal</span>
                <h2 class="promo-title">Promotion Title 3</h2>
                <p class="promo-desc">Describe the promotion clearly, highlighting key benefits and value to the customer.</p>
            </div>
        </div>

    </div>
</section>

<!-- CSS -->
<style>
.promotion-section {
    background: #f8f9fa;
    padding-top: 120px;
    padding-bottom: 120px;
}

.promo-img {
    width: 100%;
    border-radius: 20px;
    transition: transform 0.4s ease, box-shadow 0.4s ease;
}

.promo-img:hover {
    transform: scale(1.05);
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

.section-tagline {
    color: #00b33c;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 10px;
    display: block;
    font-size: 0.9rem;
}

.promo-title {
    font-size: 2.2rem;
    font-weight: 700;
    color: #000000ff;
    margin-bottom: 15px;
}

.promo-desc {
    font-size: 1.1rem;
    color: #555;
    line-height: 1.7;
}

.btn-success {
    background-color: #28a745;
    border: none;
    padding: 0.7rem 1.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-success:hover {
    background-color: #1e7e34;
    transform: translateY(-2px);
}

/* Responsive: stack rows */
@media (max-width: 992px) {
    .flex-lg-row-reverse {
        flex-direction: column !important;
    }
}
</style>
