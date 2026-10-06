<?php
require_once __DIR__ . '/app/bootstrap.php';
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Plan My Trip | Travel World</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="assets/css/site.css">
<style>
.plan-hero{position:relative;min-height:540px;display:flex;align-items:center;overflow:hidden;background:#061b2b;color:#fff}
.plan-hero-media{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center 58%}
.plan-hero:after{content:"";position:absolute;inset:0;background:linear-gradient(90deg,rgba(3,19,31,.90) 0%,rgba(3,19,31,.68) 43%,rgba(3,19,31,.18) 78%),linear-gradient(0deg,rgba(3,19,31,.58),transparent 45%)}
.plan-hero-content{position:relative;z-index:2;padding-top:70px}
.plan-hero h1{font-size:clamp(3rem,6vw,5.7rem);line-height:.96;letter-spacing:-2.5px;max-width:760px}
.plan-hero h1 em{color:#ffd05c;font-weight:600}
.plan-hero p{max-width:610px;color:rgba(255,255,255,.82);font-size:1.06rem;line-height:1.75}
.plan-steps{position:relative;z-index:5;margin-top:-38px}
.plan-stepbar{background:#fff;border:1px solid var(--line);border-radius:22px;box-shadow:0 20px 60px rgba(9,34,56,.14);padding:18px 22px}
.plan-step{display:flex;align-items:center;gap:12px;color:#7c8996;font-weight:700;font-size:.82rem}
.plan-step .num{width:38px;height:38px;border-radius:50%;display:grid;place-items:center;background:#edf7f6;color:var(--teal2);font-weight:900}
.plan-step.active{color:var(--ink)}.plan-step.active .num{background:var(--teal);color:#fff;box-shadow:0 8px 20px rgba(12,170,162,.2)}
.plan-form-wrap{padding:82px 0 95px;background:#fbfcfc}
.plan-form{background:#fff;border:1px solid var(--line);border-radius:28px;box-shadow:0 20px 65px rgba(9,34,56,.08);overflow:hidden}
.plan-form-head{padding:38px 42px;background:linear-gradient(135deg,#f2faf9,#fff)}
.plan-form-head h2{font-size:2.1rem;margin-bottom:7px}.plan-form-head p{color:var(--muted);margin:0;line-height:1.7}
.plan-form-body{padding:42px}
.form-section{padding:0 0 34px;margin-bottom:34px;border-bottom:1px solid var(--line)}
.form-section:last-of-type{border-bottom:0;margin-bottom:0}
.form-section-title{display:flex;align-items:center;gap:12px;margin-bottom:24px}.form-section-title .icon{width:43px;height:43px;border-radius:13px;background:#eaf8f7;color:var(--teal2);display:grid;place-items:center}.form-section-title h3{font-size:1.35rem;margin:0}.form-section-title p{margin:3px 0 0;color:#8995a1;font-size:.82rem}
.plan-label{font-weight:800;font-size:.78rem;letter-spacing:.25px;color:#34485b;margin-bottom:8px}.plan-label span{color:#ef6b67}
.plan-input{min-height:49px}.plan-input::placeholder{color:#a0abb5}
.preference-card{height:100%;border:1px solid #e0e9e8;border-radius:17px;padding:16px;background:#fff;transition:.2s;cursor:pointer}.preference-card:hover{border-color:#8bd7d2;background:#f7fcfb;transform:translateY(-2px)}.preference-card .form-check-input{margin-top:.2rem}.preference-card .form-check-label{font-weight:700;font-size:.87rem}.preference-icon{width:35px;height:35px;border-radius:10px;background:#f0f7f6;color:var(--teal2);display:grid;place-items:center;margin-bottom:9px}
.choice-card{height:100%;border:1px solid #e0e9e8;border-radius:17px;padding:17px;transition:.2s}.choice-card:hover{border-color:#8bd7d2;background:#f7fcfb}.choice-card .form-check-label{font-weight:800}.choice-card small{display:block;color:#8b97a2;margin-top:4px}
.destination-mini{position:relative;height:155px;border-radius:18px;overflow:hidden}.destination-mini img{width:100%;height:100%;object-fit:cover}.destination-mini:after{content:"";position:absolute;inset:0;background:linear-gradient(0deg,rgba(4,20,31,.72),transparent 70%)}.destination-mini span{position:absolute;z-index:2;left:15px;bottom:12px;color:#fff;font-weight:800}.plan-side{position:sticky;top:105px}.side-card{background:#071b2b;color:#fff;border-radius:24px;padding:28px;box-shadow:0 20px 55px rgba(9,34,56,.15)}.side-card p{color:rgba(255,255,255,.67);font-size:.88rem;line-height:1.7}.side-list{list-style:none;padding:0;margin:22px 0 0}.side-list li{display:flex;gap:10px;margin-bottom:15px;color:rgba(255,255,255,.8);font-size:.84rem}.side-list i{color:#9de7e2;margin-top:3px}.secure-note{background:#eaf7f6;border-radius:14px;padding:13px 15px;color:#35636a;font-size:.78rem;font-weight:700}.submit-plan{min-height:58px;font-size:1rem;border-radius:15px!important}.plan-note{color:#8995a1;font-size:.76rem;line-height:1.6}
.plan-success{border:0;border-radius:16px;background:#e8f8f6;color:#17635f;font-weight:700;box-shadow:none}
@media(max-width:991px){.plan-form-body{padding:28px}.plan-form-head{padding:30px}.plan-side{position:static;margin-top:25px}.plan-stepbar{overflow:auto}.plan-step{min-width:150px}.plan-step:not(:last-child):after{content:"";height:1px;width:25px;background:#dfe8e7;margin-left:auto}}
@media(max-width:767px){.plan-hero{min-height:590px}.plan-hero-content{padding-top:95px}.plan-hero h1{letter-spacing:-1.5px}.plan-form-wrap{padding:58px 0 70px}.plan-form-body{padding:23px}.plan-form-head{padding:26px 23px}.plan-stepbar{padding:14px}.plan-step{min-width:135px;font-size:.74rem}.plan-step .num{width:34px;height:34px}.destination-mini{height:130px}}
</style>
</head>
<body>

<?php include __DIR__ . '/navbar.php'; ?>

<section class="plan-hero">
    <img src="travel.jpg" alt="Plan your perfect journey" class="plan-hero-media">
    <div class="container plan-hero-content">
        <span class="eyebrow">PERSONAL TRIP DESIGNER</span>
        <h1>Build a journey <em>made for you.</em></h1>
        <p>Tell us how you want to travel, what you love and what matters most. Our team will shape the details into a memorable journey that feels uniquely yours.</p>
        <div class="hero-actions">
            <a href="#trip-form" class="tw-nav-cta"><i class="fa-solid fa-wand-magic-sparkles"></i> Start Planning</a>
            <a href="roundtour.php" class="btn hero-outline px-4 py-3"><i class="fa-solid fa-route me-2"></i>Explore Ready Tours</a>
        </div>
    </div>
</section>

<section class="plan-steps">
    <div class="container">
        <div class="plan-stepbar">
            <div class="row g-3 align-items-center">
                <div class="col-md-4"><div class="plan-step active"><span class="num">01</span><span>Tell us your plans</span></div></div>
                <div class="col-md-4"><div class="plan-step"><span class="num">02</span><span>Choose your preferences</span></div></div>
                <div class="col-md-4"><div class="plan-step"><span class="num">03</span><span>We craft your journey</span></div></div>
            </div>
        </div>
    </div>
</section>

<?php if ($flash): ?>
<div class="container mt-4">
    <div class="alert plan-success d-flex align-items-center gap-3" role="alert">
        <i class="fa-solid fa-circle-check fs-5"></i>
        <span><?=e($flash['msg'] ?? 'Your request has been submitted.')?></span>
    </div>
</div>
<?php endif; ?>

<section class="plan-form-wrap" id="trip-form">
<div class="container">
<div class="row g-4 g-xl-5 align-items-start">

<div class="col-lg-8">
<form action="submit_plan.php" method="post" class="plan-form">
    <div class="plan-form-head">
        <span class="section-kicker">YOUR TRIP, YOUR WAY</span>
        <h2>Let's design your escape</h2>
        <p>Complete the details below. You can keep it simple—we'll use your preferences to understand the kind of experience you're looking for.</p>
    </div>
    <div class="plan-form-body">

        <div class="form-section">
            <div class="form-section-title">
                <div class="icon"><i class="fa-regular fa-calendar-days"></i></div>
                <div><h3>When are you travelling?</h3><p>Choose the dates that work best for you.</p></div>
            </div>
            <div class="row g-3">
                <div class="col-md-6"><label class="plan-label">Arrival date <span>*</span></label><input name="arrival_date" type="date" class="form-control plan-input" required></div>
                <div class="col-md-6"><label class="plan-label">Departure date <span>*</span></label><input name="departure_date" type="date" class="form-control plan-input" required></div>
                <div class="col-md-4"><label class="plan-label">Adults <span>*</span></label><input type="number" min="1" value="2" class="form-control plan-input" name="adults" required></div>
                <div class="col-md-4"><label class="plan-label">Children 06–11</label><input type="number" min="0" value="0" class="form-control plan-input" name="children_6_11"></div>
                <div class="col-md-4"><label class="plan-label">Children under 05</label><input type="number" min="0" value="0" class="form-control plan-input" name="children_under_5"></div>
                <div class="col-md-6"><label class="plan-label">Rooms</label><input type="number" min="0" value="1" class="form-control plan-input" name="rooms"></div>
                <div class="col-md-6"><label class="plan-label">Estimated budget</label><input type="text" class="form-control plan-input" name="budget" placeholder="e.g. Rs. 250,000"></div>
            </div>
        </div>

        <div class="form-section">
            <div class="form-section-title">
                <div class="icon"><i class="fa-regular fa-user"></i></div>
                <div><h3>Who are we planning for?</h3><p>We'll use these details only to contact you about your request.</p></div>
            </div>
            <div class="row g-3">
                <div class="col-md-6"><label class="plan-label">Full name <span>*</span></label><input type="text" class="form-control plan-input" name="name" placeholder="Your full name" required></div>
                <div class="col-md-6"><label class="plan-label">Email address <span>*</span></label><input type="email" class="form-control plan-input" name="email" placeholder="you@example.com" required></div>
                <div class="col-md-6"><label class="plan-label">Phone number <span>*</span></label><input type="tel" class="form-control plan-input" name="phone" placeholder="+94 7X XXX XXXX" required></div>
                <div class="col-md-6"><label class="plan-label">Destination <span>*</span></label>
                    <select name="destination" class="form-select plan-input" required>
                        <option value="" selected disabled>Choose a destination</option>
                        <option>Sri Lanka</option><option>Paris</option><option>Japan</option><option>Maldives</option><option>Italy</option><option>Nepal</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="form-section-title">
                <div class="icon"><i class="fa-solid fa-heart"></i></div>
                <div><h3>What kind of experience do you love?</h3><p>Select as many as you like.</p></div>
            </div>
            <div class="row g-3">
                <?php
                $preferences = [
                    ['Beach Stays','fa-umbrella-beach'],['Sea Sailing','fa-sailboat'],['Honeymoon','fa-heart'],
                    ['Diving & Snorkeling','fa-water-ladder'],['Visiting Cultural Sites','fa-landmark'],['Train Journeys','fa-train'],
                    ['Wildlife Safari','fa-paw'],['Tea Estate Stays','fa-leaf'],['Hot Air Ballooning','fa-wind']
                ];
                foreach($preferences as $p):
                ?>
                <div class="col-md-4"><label class="preference-card d-block">
                    <div class="preference-icon"><i class="fa-solid <?=$p[1]?>"></i></div>
                    <div class="form-check m-0"><input name="preferences[]" value="<?=e($p[0])?>" class="form-check-input" type="checkbox"><span class="form-check-label ms-1"><?=e($p[0])?></span></div>
                </label></div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-section">
            <div class="form-section-title">
                <div class="icon"><i class="fa-solid fa-hotel"></i></div>
                <div><h3>Stay & move in comfort</h3><p>Pick the style that feels right for your trip.</p></div>
            </div>
            <div class="row g-3">
                <?php foreach ([['3 Star Hotel','Comfortable stays with great value'],['4 Star Hotel','A little more space & style'],['5 Star Hotel','Premium stays & elevated comfort']] as $i=>$hotel): ?>
                <div class="col-md-4"><label class="choice-card d-block"><div class="form-check m-0"><input class="form-check-input" type="radio" name="hotel" value="<?=e($hotel[0])?>" <?= $i===1?'checked':'' ?>><span class="form-check-label ms-1"><?=e($hotel[0])?></span></div><small><?=e($hotel[1])?></small></label></div>
                <?php endforeach; ?>
            </div>
            <div class="row g-3 mt-1">
                <?php foreach ([['Private Vehicle','Door-to-door flexibility'],['Train','Scenic & relaxed journeys'],['Tour Bus','Easy group travel']] as $i=>$transport): ?>
                <div class="col-md-4"><label class="choice-card d-block"><div class="form-check m-0"><input class="form-check-input" type="radio" name="transport" value="<?=e($transport[0])?>" <?= $i===0?'checked':'' ?>><span class="form-check-label ms-1"><?=e($transport[0])?></span></div><small><?=e($transport[1])?></small></label></div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-section">
            <div class="form-section-title">
                <div class="icon"><i class="fa-regular fa-message"></i></div>
                <div><h3>Anything else we should know?</h3><p>Special occasions, food preferences, accessibility or must-see places.</p></div>
            </div>
            <textarea class="form-control" rows="6" name="requirements" placeholder="Tell us what would make this journey perfect for you..."></textarea>
        </div>

        <div class="secure-note mb-3"><i class="fa-solid fa-shield-halved me-2"></i>Your details are used to prepare your travel plan and contact you about your request.</div>
        <button type="submit" class="btn btn-success submit-plan w-100"><i class="fa-solid fa-wand-magic-sparkles me-2"></i>Send My Travel Plan Request</button>
        <p class="plan-note text-center mt-3 mb-0">No payment is required at this stage. We'll review your request and get back to you with the next steps.</p>
    </div>
</form>
</div>

<div class="col-lg-4">
    <aside class="plan-side">
        <div class="side-card">
            <span class="eyebrow">WHY PLAN WITH US</span>
            <h3 class="mt-3 mb-3" style="font-size:2rem;">A trip that feels like <em style="color:#ffd05c">you.</em></h3>
            <p>From the first idea to the final itinerary, our team helps turn your preferences into a smoother, more personal travel experience.</p>
            <ul class="side-list">
                <li><i class="fa-solid fa-check"></i><span>Flexible itineraries built around your pace</span></li>
                <li><i class="fa-solid fa-check"></i><span>Destination ideas matched to your interests</span></li>
                <li><i class="fa-solid fa-check"></i><span>Accommodation and transport preferences considered</span></li>
                <li><i class="fa-solid fa-check"></i><span>Personal support before your journey</span></li>
            </ul>
        </div>
        <div class="mt-4">
            <div class="section-kicker mb-3">GET INSPIRED</div>
            <div class="row g-3">
                <?php foreach ([['sigiriya.jpg','Sigiriya'],['ella.jpg','Ella'],['maldives.jpg','Maldives'],['japan.jpg','Japan']] as $d): ?>
                <div class="col-6"><div class="destination-mini"><img src="<?=e($d[0])?>" alt="<?=e($d[1])?>"><span><?=e($d[1])?></span></div></div>
                <?php endforeach; ?>
            </div>
        </div>
    </aside>
</div>

</div>
</div>
</section>

<section class="tw-cta">
<div class="container">
<div class="row align-items-center g-4">
<div class="col-lg-8"><span class="eyebrow">YOUR NEXT ADVENTURE AWAITS</span><h2 class="mt-3 mb-2">Not sure where to start?</h2><p class="mb-0">Explore our handpicked tours first, then come back and make it completely your own.</p></div>
<div class="col-lg-4 text-lg-end"><a href="roundtour.php" class="btn btn-light px-4 py-3"><i class="fa-solid fa-compass me-2"></i>Explore Tours</a></div>
</div>
</div>
</section>

<?php include __DIR__ . '/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
