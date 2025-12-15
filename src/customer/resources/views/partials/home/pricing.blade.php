<!-- pricing-area -->
<div class="pricing-area py-120 service-bg">
    <div class="container">

        <!-- Section Heading -->
        <div class="row">
            <div class="col-lg-6 mx-auto text-center">
                <span class="site-title-tagline">Pricing</span>
                <h2 class="site-title">Our <span>Prices</span></h2>
                <div class="heading-divider"></div>
                <p class="lead">
                   Find the perfect service for your car.
                  Choose a plan that fits your vehicle’s needs from quick cleans to full premium detailing.
                  All services are designed to be fast, eco-friendly, and powered by our RFID smart system for
                  a smooth, hassle-free experience.
                </p>
            </div>
        </div>

        <!-- Pricing Cards -->
        <div class="row mt-5 justify-content-center">

            <!-- BASIC -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="pricing-card hover-lift">
                    
                    <div class="pricing-img">
                        <img src="{{ asset('publicx/assets/img/pricing/BC.png') }}" alt="Basic Car Wash">
                    </div>

                    <h3 class="plan-name"></h3>
                    <p class="plan-desc">
                        Fast and efficient cleaning perfect for everyday use.
                    </p>

                    <!-- PRICE TABLE -->
                    <div class="price-table">

                        <div class="price-row">
                            <span>
                                Small<br>
                                <small class="car-type">Sedan / Hatchback</small>
                            </span>
                            <strong>₱140</strong>
                        </div>

                        <div class="price-row">
                            <span>
                                Medium<br>
                                <small class="car-type">Crossover / Small SUV</small>
                            </span>
                            <strong>₱180</strong>
                        </div>

                        <div class="price-row">
                            <span>
                                Large<br>
                                <small class="car-type">SUV / Big MPV</small>
                            </span>
                            <strong>₱220</strong>
                        </div>

                        <div class="price-row">
                            <span>
                                XLarge<br>
                                <small class="car-type">Van / Pick-Up</small>
                            </span>
                            <strong>₱260</strong>
                        </div>

                    </div>

                </div>
            </div>


            <!-- DOUBLE WAX -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="pricing-card hover-lift">
                    
                    <div class="pricing-img">
                        <img src="{{ asset('publicx/assets/img/pricing/DP.png') }}" alt="Double Wax">
                    </div>

                    <h3 class="plan-name"></h3>
                    <p class="plan-desc">
                        Extra protection with long-lasting shine and premium finish.
                    </p>

                    <div class="price-table">

                        <div class="price-row">
                            <span>
                                Small<br>
                                <small class="car-type">Sedan / Hatchback</small>
                            </span>
                            <strong>₱140</strong>
                        </div>

                        <div class="price-row">
                            <span>
                                Medium<br>
                                <small class="car-type">Crossover / Small SUV</small>
                            </span>
                            <strong>₱180</strong>
                        </div>

                        <div class="price-row">
                            <span>
                                Large<br>
                                <small class="car-type">SUV / Big MPV</small>
                            </span>
                            <strong>₱220</strong>
                        </div>

                        <div class="price-row">
                            <span>
                                XLarge<br>
                                <small class="car-type">Van / Pick-Up</small>
                            </span>
                            <strong>₱260</strong>
                        </div>

                    </div>

                </div>
            </div>

             <!-- PREMIUM -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="pricing-card hover-lift">
                    
                    <div class="pricing-img">
                        <img src="{{ asset('publicx/assets/img/pricing/PC.png') }}" alt="Premium Car Wash">
                    </div>

                    <h3 class="plan-name"></h3>
                    <p class="plan-desc">
                        Deep cleaning with a glossy finish for a standout shine.
                    </p>

                    <div class="price-table">

                        <div class="price-row">
                            <span>
                                Small<br>
                                <small class="car-type">Sedan / Hatchback</small>
                            </span>
                            <strong>₱140</strong>
                        </div>

                        <div class="price-row">
                            <span>
                                Medium<br>
                                <small class="car-type">Crossover / Small SUV</small>
                            </span>
                            <strong>₱180</strong>
                        </div>

                        <div class="price-row">
                            <span>
                                Large<br>
                                <small class="car-type">SUV / Big MPV</small>
                            </span>
                            <strong>₱220</strong>
                        </div>

                        <div class="price-row">
                            <span>
                                XLarge<br>
                                <small class="car-type">Van / Pick-Up</small>
                            </span>
                            <strong>₱260</strong>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        

        <!-- See More -->
        <div class="row mt-4">
            <div class="col text-center">
                <a href="{{ route('services') }}" class="theme-btn theme-btn-lg see-more-btn">
                    See More Services <i class="far fa-arrow-right"></i>
                </a>
            </div>
        </div>

        </div>

    </div>
</div>

<style>

/* ============ Modern Pricing Card ============ */
.pricing-card {
    background: #fff;
    border-radius: 18px;
    padding: 25px;
    border: 1px solid rgba(0,204,102,0.35);
    box-shadow: 0 6px 20px rgba(0,0,0,0.07);
    transition: 0.35s ease;
    text-align: center;
}

.hover-lift:hover {
    transform: translateY(-8px);
    box-shadow: 0 18px 30px rgba(0,0,0,0.12);
}

/* IMAGE */
.pricing-img img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 14px;
}

/* TITLE */
.plan-name {
    font-size: 22px;
    font-weight: 700;
    margin-top: 18px;
    color: #00cc66;
}

/* DESCRIPTION */
.plan-desc {
    color: #555;
    font-size: 15px;
    margin-top: 8px;
    margin-bottom: 20px;
}

/* ============ PRICE TABLE ============ */
.price-table {
    margin-top: 10px;
}

.price-row {
    display: flex;
    justify-content: space-between;
    padding: 12px 18px;
    background: #f9f9f9;
    border-radius: 10px;
    margin-bottom: 10px;
    border: 1px solid rgba(0,204,102,0.15);
    transition: 0.3s;
    color: black;
}

.price-row:hover {
    background: rgba(0,204,102,0.08);
    border-color: rgba(0,204,102,0.4);
}

.price-row span {
    font-size: 16px;
    font-weight: 600;
}

.price-row strong {
    font-size: 20px;
    font-weight: 700;
    color: #00cc66;
}

/* Car type label */
.car-type {
    font-size: 12px;
    color: #777;
    font-weight: 500;
}

.see-more-btn {
    font-size: 20px;
    padding: 16px 45px;
    border-radius: 45px;
    background: #0a532eff;
    color: #ffffffff;
    font-weight: 600;
    transition: all 0.3s ease;
}

.see-more-btn:hover {
    background: #0d8047ff;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,204,102,0.25);
}

</style>
