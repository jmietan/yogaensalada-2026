/* Each testimonial remains an editable block in the page editor. */
document.querySelectorAll('.yc-testimonials').forEach(section => {
 const cards = [...section.querySelectorAll('.yc-testimonial-card')];
 const arrows = [...section.querySelectorAll('.yc-testimonial-arrow')];
 const dots = [...section.querySelectorAll('.yc-testimonial-dot')];
 if (!cards.length) return;
 let active = 0;
 section.setAttribute('aria-roledescription', 'carousel');
 const show = index => {
  active = (index + cards.length) % cards.length;
  cards.forEach((card, i) => {
   card.hidden = i !== active;
   card.setAttribute('role', 'group');
   card.setAttribute('aria-label', `Testimonial ${i + 1} of ${cards.length}`);
  });
  dots.forEach((dot, i) => {
   dot.classList.toggle('is-active', i === active);
   dot.setAttribute('aria-current', i === active ? 'true' : 'false');
  });
 };
 arrows.forEach((arrow, i) => {
  arrow.disabled = cards.length < 2;
  arrow.addEventListener('click', () => show(active + (i === 0 ? -1 : 1)));
 });
 dots.forEach((dot, i) => dot.addEventListener('click', () => show(i)));
 show(0);
});
