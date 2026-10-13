/** Reveal below-fold container blocks site-wide without delaying their content or layout. */
(() => {
  const motion = window.matchMedia('(prefers-reduced-motion: reduce)');

  if (motion.matches || !('IntersectionObserver' in window)) {
    return;
  }

  const sections = document.querySelectorAll(
    '[data-yc-scroll-container]'
  );

  const reveal = section => {
    section.dataset.ycReveal = 'visible';
    observer.unobserve(section);
  };

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        reveal(entry.target);
      }
    });
  }, {rootMargin: '0px 0px -30px 0px', threshold: 0});

  sections.forEach(section => {
    // Keep content already on screen, anchored, or restored by browser history visible.
    if (section.getBoundingClientRect().top < window.innerHeight) {
      return;
    }

    section.dataset.ycReveal = 'pending';
    observer.observe(section);

    // Keyboard navigation must never land on an invisible control.
    section.addEventListener('focusin', () => reveal(section), {once: true});
  });

  motion.addEventListener('change', event => {
    if (event.matches) {
      sections.forEach(reveal);
      observer.disconnect();
    }
  });

  window.addEventListener('beforeprint', () => {
    sections.forEach(reveal);
    observer.disconnect();
  });
})();
