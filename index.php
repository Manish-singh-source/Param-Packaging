<?php
$pageTitle = 'Param Packaging Pvt Ltd';
$active = 'home';
require_once __DIR__ . '/includes/data.php';
include __DIR__ . '/includes/header.php';
?>
  <section class="featured">
    <div id="index">
      <div class="responsive-slider static-slider metaslider" data-autoplay="true">
        <div class="slides">
          <?php foreach ($slides as $i => $slide): ?>
            <div class="static-slide <?php echo $i === 0 ? 'active' : ''; ?>">
              <img src="<?php echo h($slide['image']); ?>" alt="<?php echo h($slide['alt']); ?>">
              <div class="caption-wrap"><div class="caption"><?php echo $slide['caption']; ?><div class="line-btn"><a href="<?php echo h($slide['link']); ?>">view more</a></div></div></div>
            </div>
          <?php endforeach; ?>
        </div>
        <button class="flex-prev static-prev" type="button" aria-label="Previous slide">&lsaquo;</button>
        <button class="flex-next static-next" type="button" aria-label="Next slide">&rsaquo;</button>
        <div class="static-dots"></div>
      </div>
    </div>
  </section>

  <section id="parallax1" class="section" data-stellar-background-ratio="0.5">
    <div class="quote1-pattern"></div>
    <div class="container"><div class="row"><div class="col-lg-12"><div class="align-center"><div class="testimonial pad-top40 pad-bot40 clearfix"><h1>You desire,<br>we execute</h1></div></div></div></div></div>
  </section>

  <section id="whoweare" class="section pad-bot5 bg-white static-reveal">
    <div class="container">
      <div class="about-us-main">
        <h1>Who We Are</h1>
        <div id="nav2"><ul>
          <?php foreach ($whoPages as $i => $page): ?>
            <li><a id="<?php echo h($page['key']); ?>-1" class="<?php echo $i === 0 ? 'active' : ''; ?>" href="#<?php echo h($page['key']); ?>-1-1"><?php echo $i + 1; ?></a></li>
          <?php endforeach; ?>
        </ul></div>
        <p>Print and pack group is one of the leading packaging solution provider. We cater to various industries like pharma, food, cosmetics, personal care, health care and many others.</p>
      </div>
      <div class="divider"></div>
      <div id="content" class="static-content-row">
        <div class="contentbox-wrapper-about-1 static-card-strip">
          <?php foreach ($whoPages as $page): ?>
            <div id="<?php echo h($page['key']); ?>-1-1" class="contentbox">
              <a class="zoom-link" href="<?php echo h($page['image']); ?>" title="<?php echo h($page['title']); ?>"><img src="<?php echo h($page['thumb']); ?>" alt="<?php echo h($page['title']); ?>"></a>
              <h3><?php echo h($page['title']); ?></h3>
              <p><?php echo h($page['summary']); ?></p>
              <div class="button2"><a href="<?php echo h($page['url']); ?>">more</a></div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </section>

  <section id="parallax2" class="section" data-stellar-background-ratio="0.5">
    <div class="quote1-pattern"></div>
    <div class="container"><div class="row"><div class="col-lg-12"><div class="align-center"><div class="testimonial pad-top40 pad-bot40 clearfix"><h1>Open mindedness to <br>new ways of thinking</h1></div></div></div></div></div>
  </section>

  <section id="whatwedo" class="section pad-bot5 bg-white static-reveal">
    <div class="container">
      <div class="about-us-main">
        <h1>What We Do</h1>
        <div id="nav3"><ul>
          <?php foreach ($whatPages as $i => $page): ?>
            <li><a id="<?php echo h($page['key']); ?>-1" class="<?php echo $i === 0 ? 'active' : ''; ?>" href="#<?php echo h($page['key']); ?>-1-1"><?php echo $i + 1; ?></a></li>
          <?php endforeach; ?>
        </ul></div>
        <p>We offer innovative packaging styles and solutions with variety of finishes on various substrates.</p>
      </div>
      <div class="divider"></div>
      <div id="content2" class="static-content-row">
        <div class="contentbox-wrapper-about-1 static-card-strip">
          <?php foreach ($whatPages as $page): ?>
            <div id="<?php echo h($page['key']); ?>-1-1" class="contentbox">
              <a class="zoom-link" href="<?php echo h($page['image']); ?>" title="<?php echo h($page['title']); ?>"><img src="<?php echo h($page['thumb']); ?>" alt="<?php echo h($page['title']); ?>"></a>
              <h3><?php echo h($page['title']); ?></h3>
              <p><?php echo h($page['summary']); ?></p>
              <div class="button2"><a href="<?php echo h($page['url']); ?>">more</a></div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </section>

  <section id="parallax3" class="section" data-stellar-background-ratio="0.5">
    <div class="quote1-pattern"></div>
    <div class="container"><div class="row"><div class="col-lg-12"><div class="align-center"><div class="testimonial pad-top40 pad-bot40 clearfix"><h1>Committed and Consistent</h1></div></div></div></div></div>
  </section>

  <section id="industry" class="section pad-bot0 bg-white ind_block static-reveal">
    <div class="container">
      <h1>Industry Verticals</h1>
      <p>We manufacture folding cartons and other packaging solutions for the following segments:</p>
    </div>
    <div class="static-industry-bg">
      <div class="container">
        <ul class="ind_list">
          <?php foreach ($industryItems as $item): ?>
            <li><a><img src="<?php echo h($item[1]); ?>" alt=""><h5><?php echo h($item[0]); ?></h5></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </section>

  <section id="services" class="section bg-white static-reveal">
    <div class="container">
      <div class="row mar-bot45 mar-top20">
        <h1>Our Clients</h1>
        <div class="client_list"><ul>
          <?php foreach ($clientLogos as $logo): ?>
            <li><img src="assets/theme/img/clients/images/<?php echo h($logo); ?>" alt=""></li>
          <?php endforeach; ?>
        </ul></div>
      </div>
    </div>
  </section>

  <section class="section" id="contact-page">
    <div class="container">
      <div class="contactW"><div class="contactContent">
        <h1>Contact Us</h1>
        <div class="row">
          <div class="col-sm-4 contactInfo">
            <h3>Corporate Office</h3>
            <p><strong>Param Packaging Pvt. Ltd</strong><br>C-1002, Lotus Corporate Park,<br>Ram Mandir Road,<br>Goregaon (E), Mumbai,<br>Pincode – 400 063, India</p>
            <p><strong>Tel. :</strong> +91-22-61951300/1301 &nbsp;&nbsp; | &nbsp;&nbsp; +91-22-61951351<br><strong>E-mail :</strong> <span class="contact-red">info@parampackaging.com</span></p>
          </div>
          <div class="col-sm-8"><iframe class="static-map" title="Param Packaging map" src="https://maps.google.com/maps?q=Lotus%20Corporate%20Park%20Goregaon%20East%20Mumbai&t=k&z=15&output=embed" loading="lazy"></iframe></div>
        </div>
        <div class="row contactWrap">
          <div class="col-sm-4"><h4>Packaging Units</h4><h6>Param Packaging Pvt. Ltd</h6><p>Survey No.: 1154, Radhamadhav<br>ECO Industrial Park,<br>Degam Village, Vapi,<br>Valsad, Gujarat,<br>Pincode – 396191. India</p><p><strong>Tel. :</strong> +91 260 3501300</p></div>
          <div class="col-sm-4"><h4>&nbsp;</h4><h6>Pinetree Packaging Pvt. Ltd.</h6><p>Khasra no.: 685-690,692,696/1,<br>Village Katha, P.O. Baddi,<br>District Solan, Himachal Pradesh.<br>Pincode – 173 205, India</p><p><strong>Tel. :</strong> +91-1795-24554</p></div>
        </div>
        <div class="contactForm">
          <?php if (!empty($_GET['mail'])): ?>
            <?php
              $mailStatus = $_GET['mail'];
              $mailMessages = [
                  'success' => ['Thank you! Your inquiry has been submitted successfully.', 'success'],
                  'invalid' => ['Please fill all required fields with a valid email address.', 'error'],
                  'smtp_not_configured' => ['SMTP settings are not configured yet. Please update config/smtp.php.', 'error'],
                  'error' => ['Sorry, your message could not be sent right now. Please try again.', 'error'],
              ];
              $notice = $mailMessages[$mailStatus] ?? null;
            ?>
            <?php if ($notice): ?>
              <div class="form-alert <?php echo h($notice[1]); ?>"><?php echo h($notice[0]); ?></div>
            <?php endif; ?>
          <?php endif; ?>
          <form action="contact-submit" method="post">
            <h4>Write to Us</h4>
            <input type="text" name="website" class="hp-field" tabindex="-1" autocomplete="off">
            <div class="row">
              <div class="col-sm-6"><label>Name</label><input type="text" name="name" placeholder="Enter Name" required><label>Email</label><input type="email" name="email" placeholder="Enter Email" required><label>Subject</label><input type="text" name="subject" placeholder="Enter Subject" required></div>
              <div class="col-sm-6"><label>Message</label><textarea name="message" rows="7" required></textarea></div>
            </div>
            <button type="submit" class="submit-message-btn" data-loading-text="Sending..."><span>Submit Message</span></button>
          </form>
        </div>
      </div></div>
    </div>
  </section>
<?php include __DIR__ . '/includes/footer.php'; ?>
