document.addEventListener('DOMContentLoaded', function () {

  /* LOADER — real asset preloading */
  var loaderBar = document.getElementById('ksc-loader-bar');
  var loaderPct = document.getElementById('ksc-loader-pct');
  var loader    = document.getElementById('ksc-loader');
  if (loader) {
    var criticalAssets = [
      'SR-Hero-Export/HerozombNEW.png',
      'images/00_site-ui/recentwork_hero.jpg'
    ];
    // Fixed total: 2 images + fonts.ready promise (counted as 1 unit)
    // document.fonts.size is unreliable at DOMContentLoaded — use fixed count
    var totalAssets = criticalAssets.length + 1;
    var loaded = 0;
    var dismissed = false;

    function updateLoader() {
      if (dismissed) return;
      loaded++;
      var pct = Math.min(Math.round((loaded / totalAssets) * 100), 100);
      loaderBar.style.width = pct + '%';
      loaderPct.textContent = pct + '%';
      if (loaded >= totalAssets) dismissLoader();
    }

    function dismissLoader() {
      if (dismissed) return;
      dismissed = true;
      loaderBar.style.width = '100%';
      loaderPct.textContent = '100%';
      setTimeout(function () { loader.classList.add('gone'); }, 300);
    }

    // Preload critical images
    criticalAssets.forEach(function (src) {
      var img = new Image();
      img.onload = updateLoader;
      img.onerror = updateLoader;
      img.src = src;
    });

    // Wait for fonts — counts as the 1 extra unit above
    if (document.fonts && document.fonts.ready) {
      document.fonts.ready.then(function () {
        updateLoader();
      });
    } else {
      updateLoader(); // fonts API not available, count it done
    }

    // Safety timeout — dismiss after 4 seconds no matter what
    setTimeout(dismissLoader, 4000);
  }

  /* iOS SIDE-SCROLL FIX — lock viewport when inputs are focused */
  var inputs = document.querySelectorAll('input, textarea');
  inputs.forEach(function (el) {
    el.addEventListener('focus', function () {
      document.documentElement.style.overflowX = 'hidden';
      document.body.style.overflowX = 'hidden';
      document.body.style.position = 'relative';
      document.body.style.width = '100%';
    });
    el.addEventListener('blur', function () {
      window.scrollTo(0, window.scrollY);
    });
  });

  /* CURSOR — desktop only */
  var hasHover = window.matchMedia('(hover: hover)').matches;
  if (hasHover) {
    var cursor = document.createElement('div');
    cursor.id = 'ksc-cursor';
    document.body.appendChild(cursor);
    var lastTrail = 0;
    document.addEventListener('mousemove', function (e) {
      cursor.style.left = e.clientX + 'px';
      cursor.style.top  = e.clientY + 'px';
      var now = Date.now();
      if (now - lastTrail > 35) {
        lastTrail = now;
        var t = document.createElement('div');
        t.className = 'ksc-trail';
        t.style.cssText = 'left:' + e.clientX + 'px;top:' + e.clientY + 'px;background:' + (Math.random() > 0.5 ? '#fff600' : '#068dc1') + ';width:' + (Math.random() * 4 + 2).toFixed(1) + 'px;height:' + (Math.random() * 4 + 2).toFixed(1) + 'px;position:fixed;border-radius:50%;pointer-events:none;z-index:99998;transform:translate(-50%,-50%);opacity:0;transition:opacity 0.4s;';
        document.body.appendChild(t);
        requestAnimationFrame(function () { t.style.opacity = '0.65'; });
        setTimeout(function () { t.style.opacity = '0'; setTimeout(function () { t.parentNode && t.parentNode.removeChild(t); }, 400); }, 60);
      }
    });
    document.addEventListener('mousedown', function () { cursor.classList.add('pressed'); });
    document.addEventListener('mouseup',   function () { cursor.classList.remove('pressed'); });
  }

  /* LIVE CLOCK */
  function kscTick() {
    var el = document.getElementById('ksc-live-time');
    if (!el) return;
    var n = new Date(), parts = [n.getHours(), n.getMinutes(), n.getSeconds()];
    el.textContent = parts.map(function (v) { return v < 10 ? '0' + v : '' + v; }).join(':');
  }
  setInterval(kscTick, 1000); kscTick();

  /* STATUS DOT */
  var dot = document.querySelector('.ksc-status-dot');
  if (dot) { dot.style.animation = 'kscBlink 1.8s ease-in-out infinite'; }

  /* LOGO MARQUEE */
  var fwd = document.querySelector('.ksc-logo-track-fwd');
  var rev = document.querySelector('.ksc-logo-track-rev');
  var fwd2 = document.querySelector('.ksc-logo-track-fwd2');
  if (fwd) { fwd.style.animation = 'kscMarqFwd 28s linear infinite'; }
  if (rev) { rev.style.animation = 'kscMarqRev 32s linear infinite'; }
  if (fwd2) { fwd2.style.animation = 'kscMarqFwd 36s linear infinite'; }
  [fwd, rev, fwd2].forEach(function (t) {
    if (!t) return;
    t.addEventListener('mouseenter', function () { t.style.animationPlayState = 'paused'; });
    t.addEventListener('mouseleave', function () { t.style.animationPlayState = 'running'; });
  });

  /* SCROLL REVEAL */
  if ('IntersectionObserver' in window) {
    var obs = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); } });
    }, { threshold: 0.1 });
    document.querySelectorAll('.ksc-reveal').forEach(function (el, i) {
      el.style.transitionDelay = (i % 4) * 0.07 + 's';
      obs.observe(el);
    });
  } else {
    document.querySelectorAll('.ksc-reveal').forEach(function (el) { el.classList.add('visible'); });
  }

  /* FORM TIME STAMP — spam protection */
  var ftEl = document.getElementById('ksc-form-time');
  if (ftEl) ftEl.value = Math.floor(Date.now() / 1000);

  /* COPYRIGHT YEAR */
  var yr = document.getElementById('ksc-year');
  if (yr) yr.textContent = new Date().getFullYear();
  var legal = document.getElementById('ksc-footer-legal');
  if (legal) legal.innerHTML = '&copy; Copyright ' + new Date().getFullYear() + ' &middot; All creative work was done by Kevin Schmoll. All rights reserved. All other copyrights and trademarks are the property of their respective owners.';

  /* LINKEDIN COMPOSER */
  window.kscSendLinkedIn = function () {
    var ta = document.getElementById('ksc-li-msg');
    if (!ta) return;
    var msg = ta.value.trim();
    if (!msg) { ta.focus(); ta.style.borderColor = '#000'; setTimeout(function () { ta.style.borderColor = ''; }, 1200); return; }
    window.open('https://www.linkedin.com/messaging/compose/?to=kevinaschmoll&body=' + encodeURIComponent(msg), '_blank');
  };

  /* CONTENT PROTECTION */
  document.addEventListener('contextmenu', function (e) {
    e.preventDefault();
  });
  document.addEventListener('dragstart', function (e) {
    if (e.target.tagName === 'IMG') { e.preventDefault(); }
  });
  document.addEventListener('copy', function (e) {
    var sel = window.getSelection();
    if (!sel || sel.toString().trim().length === 0) return;
    e.clipboardData.setData('text/plain', sel.toString() + '\n\n© Kevin Schmoll Creative — schmollcreative.com');
    e.preventDefault();
  });
  document.addEventListener('selectstart', function (e) {
    if (e.target.tagName === 'IMG') e.preventDefault();
  });

  /* CONTACT FORM */
  window.kscSubmitForm = function (e) {
    e.preventDefault();
    var btn  = document.getElementById('ksc-form-btn');
    var succ = document.getElementById('ksc-form-success');
    var err  = document.getElementById('ksc-form-error');

    var name    = (document.getElementById('ksc-cf-name')    || {value:''}).value.trim();
    var email   = (document.getElementById('ksc-cf-email')   || {value:''}).value.trim();
    var company = (document.getElementById('ksc-cf-company') || {value:''}).value.trim();
    var type    = (document.getElementById('ksc-cf-type')    || {value:''}).value.trim();
    var message = (document.getElementById('ksc-cf-msg')     || {value:''}).value.trim();

    if (btn) { btn.textContent = 'Sending...'; btn.disabled = true; }
    if (succ) succ.style.display = 'none';
    if (err)  err.style.display  = 'none';

    var body = new URLSearchParams({ name: name, email: email, company: company, type: type, message: message });

    fetch('contact.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: body.toString() })
      .then(function (res) { return res.json(); })
      .then(function (data) {
        if (data.success) {
          if (succ) { succ.style.display = 'block'; }
          e.target.reset();
        } else {
          if (err) { err.style.display = 'block'; }
        }
      })
      .catch(function () {
        if (err) { err.style.display = 'block'; }
      })
      .finally(function () {
        if (btn) { btn.textContent = 'Send It →'; btn.disabled = false; }
      });
  };

});
