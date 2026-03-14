/**
 * Schmoll Creative — main.js
 * Nav toggle · Scroll reveal · Smooth scroll
 */
(function () {
  'use strict';

  /* ── Nav hamburger ── */
  const toggle = document.getElementById('navToggle');
  const drawer = document.getElementById('navDrawer');

  if (toggle && drawer) {
    toggle.addEventListener('click', () => {
      const open = toggle.classList.toggle('open');
      drawer.classList.toggle('open', open);
      toggle.setAttribute('aria-expanded', String(open));
    });
  }

  window.closeNav = function () {
    if (toggle) { toggle.classList.remove('open'); toggle.setAttribute('aria-expanded', 'false'); }
    if (drawer) { drawer.classList.remove('open'); }
  };

  /* Close drawer on outside click */
  document.addEventListener('click', (e) => {
    if (drawer && drawer.classList.contains('open') &&
        !drawer.contains(e.target) && !toggle.contains(e.target)) {
      closeNav();
    }
  });

  /* ── Scroll reveal ── */
  const revealEls = document.querySelectorAll('.reveal');
  if (revealEls.length && 'IntersectionObserver' in window) {
    const obs = new IntersectionObserver((entries) => {
      entries.forEach((entry, i) => {
        if (entry.isIntersecting) {
          setTimeout(() => entry.target.classList.add('on'), i * 65);
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.08 });
    revealEls.forEach((el) => obs.observe(el));
  } else {
    // Fallback: show all immediately
    revealEls.forEach((el) => el.classList.add('on'));
  }

  /* ── Smooth scroll for anchor links ── */
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener('click', (e) => {
      const href = anchor.getAttribute('href');
      if (href === '#') return;
      const target = document.querySelector(href);
      if (target) {
        e.preventDefault();
        closeNav();
        target.scrollIntoView({ behavior: 'smooth' });
      }
    });
  });

  /* ── Nav background on scroll ── */
  const nav = document.querySelector('.site-nav');
  if (nav) {
    const onScroll = () => {
      nav.style.background = window.scrollY > 40
        ? 'rgba(11,12,13,0.97)'
        : 'var(--ink)';
    };
    window.addEventListener('scroll', onScroll, { passive: true });
  }

})();
