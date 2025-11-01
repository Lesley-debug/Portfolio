// Shared mobile nav handlers
// Expose functions globally so pages using inline onclick="hamburg()" keep working.
function hamburg() {
  const navbar = document.querySelector('.dropdown');
  if (!navbar) return;
  navbar.style.transform = 'translateY(0px)';
  // focus first link for keyboard users
  const firstLink = navbar.querySelector('a');
  if (firstLink) firstLink.focus();
}

function cancel() {
  const navbar = document.querySelector('.dropdown');
  if (!navbar) return;
  navbar.style.transform = 'translateY(-500px)';
}

// Optional: close dropdown when focus moves away (simple progressive enhancement)
document.addEventListener('click', function (e) {
  const navbar = document.querySelector('.dropdown');
  if (!navbar) return;
  const isOpen = navbar.style.transform === 'translateY(0px)';
  if (!isOpen) return;
  const withinNav = e.target.closest && e.target.closest('.dropdown, .hamburg');
  if (!withinNav) cancel();
}, { passive: true });
