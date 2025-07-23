/// Javascript untk sticky logo functionality
document.addEventListener("DOMContentLoaded", function () {
  const header = document.getElementById("header");
  const body = document.body;
  let isSticky = false;

  // Fungsi untk handle scroll
  function handleScroll() {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    // Threshold utk mulai sticky (setelah scroll 100px)
    const threshold = 50;

    if (scrollTop > threshold && !isSticky) {
      // Aktifkan sticky mode
      header.classList.add("sticky");
      body.classList.add("sticky-active");
      isSticky = true;
    } else if (scrollTop <= threshold && isSticky) {
      // Nonaktfikan sticky mode
      header.classList.remove("sticky");
      body.classList.remove("sticky-active");
      isSticky = false;
    }
  }

  // Throttle function untk performa lebih baik
  let ticking = false;
  function requestTick() {
    if (!ticking) {
      requestAnimationFrame(handleScroll);
      ticking = true;
    }
  }
  function finishTick() {
    ticking = false;
  }
  function optimizedScroll() {
    requestTick();
    setTimeout(finishTick, 16); // ~60fps
  }

  //Event listener untk scroll
  window.addEventListener("scroll", optimizedScroll, { passive: true });
  // Cek posisi awal saat load
  handleScroll();
});
