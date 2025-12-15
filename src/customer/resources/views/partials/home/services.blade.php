<div class="service-wrapper">
    <div class="container">
        <div class="text-center mb-5">
            <span class="site-title-tagline">Services & Pricing</span>
            <h2 class="site-title">Choose Your <span>Service</span></h2>
            <div class="heading-divider"></div>
        </div>

        <div class="service-tabs">

            <!-- LEFT TABS -->
            <div class="service-tab-list">
                <button class="active" onclick="showService('basic')"><i class="fa fa-car"></i> Basic Car Wash</button>
                <button onclick="showService('premium')"><i class="fa fa-star"></i> Premium Car Wash</button>
                <button onclick="showService('doublewax')"><i class="fa fa-gem"></i> Double Wax + Premium</button>
                <button onclick="showService('engine')"><i class="fa fa-cogs"></i> Engine Wash</button>
                <button onclick="showService('bac2zero')"><i class="fa fa-shield-virus"></i> Bac-to-zero</button>
                <button onclick="showService('underwash')"><i class="fa fa-water"></i> Underwash</button>
                <button onclick="showService('asphalt')"><i class="fa fa-tools"></i> Asphalt Removal</button>
                <button onclick="showService('buffing')"><i class="fa fa-brush"></i> Machine Buffing Wax</button>
                <button onclick="showService('interior')"><i class="fa fa-spray-can"></i> Interior Protectant</button>
            </div>

            <!-- RIGHT CONTENT DEFAULT -->
           <div class="service-content-box" id="serviceContent">
                <img src="{{ asset('publicx/assets/img/logo/classy-icon.png') }}" class="service-img-preview" alt="Carwash Preview">

                                <!-- Vision & Mission Section -->
                <div class="vision-mission-section" style="background: #f8f9fa; padding: 80px 20px; text-align: left;">

                    <!-- Vision -->
                    <div class="vision" style="margin-bottom: 50px;">
                        <h3 style="font-size: 28px; color: #00b33c;">Vision</h3>
                        <p style="max-width: 700px; margin: 10px auto; font-size: 18px; line-height: 1.6; color: #555;">
                            To be the leading car care provider known for innovative, eco-friendly, and premium-quality services that consistently exceed customer expectations.
                        </p>
                    </div>

                    <!-- Mission -->
                    <div class="mission">
                        <h3 style="font-size: 28px; color: #00b33c;">Mission</h3>
                        <p style="max-width: 700px; margin: 10px auto; font-size: 18px; line-height: 1.6; color: #555;">
                            Ensure every vehicle leaves our facility spotless, protected, and shining, while building lasting relationships with our customers.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const services = {
    basic: {
        img: "carwash.png",
        title: "Basic Car Wash",
        desc: "Give your car a quick and thorough clean with our Basic Car Wash. Perfect for removing everyday dirt and grime, keeping your vehicle fresh and presentable.",
        prices: [["Small (Sedan & Hatchbacks)","₱140"],["Medium (Crossover & Small SUVs)","₱180"],["Large (SUV & Big MPVs)","₱220"], ["XLarge (Van & Pick-up)","₱260"]]
    },
    premium: { img:"ceramic.png", title:"Premium Car Wash", desc:"Experience a deeper clean with our Premium Car Wash, designed to remove tough dirt while adding shine. Your car will look spotless and feel rejuvenated inside and out.", prices: [["Small (Sedan & Hatchbacks)","₱240"],["Medium (Crossover & Small SUVs)","₱290"],["Large (SUV & Big MPVs)","₱340"], ["XLarge (Van & Pick-up)","₱390"]] },
    doublewax: { img:"graphene.png", title:"Double Wax with Premium Wash", desc:"Protect and enhance your car’s finish with our Double Wax + Premium service. It delivers long-lasting shine while safeguarding your paint from scratches and elements.", prices: [["Small (Sedan & Hatchbacks)","₱460"],["Medium (Crossover & Small SUVs)","₱570"],["Large (SUV & Big MPVs)","₱680"], ["XLarge (Van & Pick-up)","₱790"]] },
    engine: { img:"engine-wash.jpg", title:"Engine Wash", desc:"Keep your engine running smoothly and looking clean with our Engine Wash. It removes grease, grime, and buildup for better performance and maintenance.", prices: [["Small (Sedan & Hatchbacks)","₱350"],["Medium (Crossover & Small SUVs)","₱350"],["Large (SUV & Big MPVs)","₱400"], ["XLarge (Van & Pick-up)","₱400"]]},
    bac2zero: { img:"bac-to-zer.jpg", title:"Bac-to-zero", desc:"Restore your car’s exterior to its original glory with our Bac-to-zero service. Perfect for eliminating stubborn stains, oxidation, and weathering marks.", prices: [["Small (Sedan & Hatchbacks)","₱380"],["Medium (Crossover & Small SUVs)","₱380"],["Large (SUV & Big MPVs)","₱430"], ["XLarge (Van & Pick-up)","₱430"]] },
    underwash: { img:"underwash.jpg", title:"Underwash", desc:"Protect your car from rust and dirt buildup with our Underwash service. It thoroughly cleans hard-to-reach areas under your vehicle for lasting durability.", prices: [["Small (Sedan & Hatchbacks)","₱340"],["Medium (Crossover & Small SUVs)","₱390"],["Large (SUV & Big MPVs)","₱490"], ["XLarge (Van & Pick-up)","₱550"]] },
    asphalt: { img:"asphalt.png", title:"Asphalt Removal", desc:"Remove sticky asphalt, tar, and road residues effortlessly with our Asphalt Removal service. Your car’s surface will be smooth, clean, and ready for polishing.", prices: [["Small (Sedan & Hatchbacks)","₱100"],["Medium (Crossover & Small SUVs)","₱100"],["Large (SUV & Big MPVs)","₱150"], ["XLarge (Van & Pick-up)","₱150"]] },
    buffing: { img:"buffing.jpg", title:"Machine Buffing Wax", desc:"Enhance your car’s shine with our Machine Buffing Wax service. It delivers a glossy, professional finish while removing minor scratches and swirl marks.", prices: [["Small (Sedan & Hatchbacks)","₱200"],["Medium (Crossover & Small SUVs)","₱250"],["Large (SUV & Big MPVs)","₱300"], ["XLarge (Van & Pick-up)","₱350"]] },
    interior: { img:"detailing.png", title:"Interior Protectant", desc:"Keep your car’s interior looking new with our Interior Protectant. It cleans, protects, and adds a subtle shine to surfaces while preventing damage from dust and UV rays.", prices: [["Small (Sedan & Hatchbacks)","₱120"],["Medium (Crossover & Small SUVs)","₱120"],["Large (SUV & Big MPVs)","₱200"], ["XLarge (Van & Pick-up)","₱250"]] }
};

function showService(key) {
    const content = document.getElementById("serviceContent");
    const s = services[key];

    // Set active button
    document.querySelectorAll(".service-tab-list button")
        .forEach(btn => btn.classList.remove("active"));
    event.target.classList.add("active");

    // Fade animation refresh
    content.classList.remove("fadeSlide");
    void content.offsetWidth;
    content.classList.add("fadeSlide");

    // Replace content
    content.innerHTML = `
        <img src="{{ asset('publicx/assets/img/service/${s.img}') }}" class="service-img-preview">
        <h3>${s.title}</h3>
        <p>${s.desc}</p>
        <div class="price-list">
            ${s.prices.map(p => `
                <div class="price-item">
                    <span>${p[0]}</span>
                    <span class="price-value">${p[1]}</span>
                </div>
            `).join("")}
        </div>
    `;
}
</script>

<style>
/* ========================================
   Premium Responsive Tab-based Services
========================================= */

/* WRAPPER */
.service-wrapper {
    background: linear-gradient(180deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 80px 0;
}

/* Layout desktop */
.service-tabs {
    display: flex;
    gap: 30px;
}

/* LEFT TAB LIST */
.service-tab-list {
    width: 28%;
    background: rgba(255,255,255,0.85);
    padding: 25px;
    border-radius: 20px;
    backdrop-filter: blur(10px);
    box-shadow: 0 10px 35px rgba(0,0,0,0.08);
    border: 1px solid rgba(0,0,0,0.05);
}

.service-tab-list button {
    width: 100%;
    text-align: left;
    padding: 15px 20px;
    background: #fff;
    border: 2px solid #e8e8e8;
    border-radius: 14px;
    margin-bottom: 12px;
    font-weight: 600;
    color: #333;
    transition: 0.3s ease;
    display: flex;
    align-items: center;
    gap: 10px;
    position: relative;
}
.service-tab-list button i {
    font-size: 18px;
    color: #00b33c;
}
.service-tab-list button::before {
    content: "";
    position: absolute;
    left: -8px;
    top: 50%;
    transform: translateY(-50%);
    width: 4px;
    height: 0%;
    background: #00b33c;
    border-radius: 10px;
    transition: 0.25s ease;
}
.service-tab-list button:hover,
.service-tab-list button.active {
    border-color: #00b33c;
    background: rgba(0,179,60,0.1);
    color: #00b33c;
    transform: translateX(3px);
}
.service-tab-list button:hover::before,
.service-tab-list button.active::before { height: 70%; }

/* RIGHT CONTENT */
.service-content-box {
    width: 72%;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(15px);
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    animation: fadeSlide .35s ease-out;
    transition: transform 0.3s ease;
}
.service-content-box:hover { transform: translateY(-4px); }

@keyframes fadeSlide {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.service-img-preview {
    width: 100%;
    height: 300px;
    border-radius: 16px;
    margin-bottom: 20px;
    box-shadow: 0 12px 35px rgba(0,0,0,0.08);
    object-fit: cover;
}

.price-list { margin-top: 25px; border-top: 1px solid rgba(0,0,0,0.05); padding-top: 15px; }

.price-item {
    display: flex;
    justify-content: space-between;
    padding: 14px 0;
    border-bottom: 1px solid rgba(0,0,0,0.03);
    transition: background 0.3s ease;
}
.price-item:hover {
    background: rgba(0,179,60,0.05);
    border-radius: 10px;
}
.price-value {
    color: #00b33c;
    font-size: 17px;
    font-weight: 700;
}

/* MOBILE RESPONSIVE */
@media (max-width: 992px) {
    .service-tabs { flex-direction: column; }
    .service-tab-list { width: 100%; padding: 15px; display: flex; gap: 10px; overflow-x: auto; border-radius: 16px; white-space: nowrap; }
    .service-tab-list button { width: auto; flex-shrink: 0; padding: 12px 18px; border-radius: 50px; border-width: 1.5px; font-size: 14px; margin-bottom: 0; }
    .service-tab-list button::before { display: none; }
    .service-tab-list button.active { background: #00b33c; color: #fff; border-color: #00b33c; transform: scale(1.03); }
    .service-tab-list button i { color: #fff !important; }
    .service-content-box { width: 100%; padding: 30px 25px; margin-top: 15px; border-radius: 18px; }
    .price-item { font-size: 15px; padding: 12px 0; }
}

@media (max-width: 480px) {
    .service-tab-list { gap: 6px; }
    .service-tab-list button { font-size: 13px; padding: 10px 14px; }
    .service-content-box { padding: 22px; }
    .price-item { font-size: 14px; }
    .price-value { font-size: 15px; }
}
</style>
