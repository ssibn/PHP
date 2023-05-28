function showSingleDiv(selector) {
    const prevBlockEl = document.querySelector('.single.active'),
          currBlockEl = document.querySelector(selector);
    if (!currBlockEl || prevBlockEl === currBlockEl) return;
    prevBlockEl && prevBlockEl.classList.remove('active');
    currBlockEl.classList.add('active');
}