window.onload = () => {
    console.log('hello');
    //cart box
    const itemshopping = document.querySelector('.itemshopping');
    const cartbox = document.querySelector('.cartbox');
    const closecart = document.querySelector('.fa-times');
    itemshopping.addEventListener("click", function() {
        cartbox.classList.add('active');
    });
    closecart.addEventListener("click", function() {
        cartbox.classList.remove('active');
    })
}