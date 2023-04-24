let btn = document.querySelector(".btn"),
    openForm = document.querySelector(".openForm"),
    close = document.querySelector(".close"),
    form = document.querySelector(".form-wrap");

btn.addEventListener("click", function(){
    openForm.classList.add("none");
    form.classList.remove("none");
})
close.addEventListener("click", function(){
    form.classList.add("none");
    openForm.classList.remove("none");
})