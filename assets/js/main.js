// main.js
// Custom JavaScript for Baker Best Bakery

// Example: alert when order form is submitted
document.addEventListener('DOMContentLoaded', function(){
    const orderForm = document.querySelector('form');
    if(orderForm){
        orderForm.addEventListener('submit', function(){
            console.log('Order form submitted');
        });
    }
});
