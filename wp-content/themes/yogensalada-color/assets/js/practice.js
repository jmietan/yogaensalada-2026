/* Progressive enhancement: native scroll remains usable without JavaScript. */
document.querySelectorAll('.yc-practice').forEach(section => {
 const track = section.querySelector('.yc-practice-grid');
 const prev = section.querySelector('.yc-practice-prev');
 const next = section.querySelector('.yc-practice-next');
 if (!track || !prev || !next) return;
 track.tabIndex = 0;
 track.setAttribute('aria-label', 'Yoga practices');
 const update = () => {
  prev.disabled = track.scrollLeft <= 2;
  next.disabled = track.scrollLeft + track.clientWidth >= track.scrollWidth - 2;
 };
 const advance = direction => {
  const card = track.querySelector('.yc-practice-card');
  const distance = card ? card.getBoundingClientRect().width + (parseFloat(getComputedStyle(track).gap) || 0) : track.clientWidth;
  track.scrollBy({left:direction * distance,behavior:matchMedia('(prefers-reduced-motion: reduce)').matches ? 'instant' : 'smooth'});
 };
 prev.addEventListener('click',()=>advance(-1));
 next.addEventListener('click',()=>advance(1));
 track.addEventListener('scroll',update,{passive:true});
 track.addEventListener('keydown',event=>{
  if (event.target !== track || !['ArrowLeft','ArrowRight'].includes(event.key)) return;
  event.preventDefault(); advance(event.key === 'ArrowLeft' ? -1 : 1);
 });
 if ('ResizeObserver' in window) new ResizeObserver(update).observe(track);
 window.addEventListener('resize',update,{passive:true});
 update();
});
