function showSingleDiv(selector) {
    const prevBlockEl = document.querySelector('.single.active'),
          currBlockEl = document.querySelector(selector);
    if (!currBlockEl || prevBlockEl === currBlockEl) return;
    prevBlockEl && prevBlockEl.classList.remove('active');
    currBlockEl.classList.add('active');
}

let phone = document.querySelectorAll('.form-control');
let button = document.querySelector('#button');

for( let i = 0; i < phone.length; i++){
    phone[i].addEventListener('input', function(event){
            button.disabled = this.value.trim() ? false : true;
            // disabled = (phone[i].value == '');
    })
}