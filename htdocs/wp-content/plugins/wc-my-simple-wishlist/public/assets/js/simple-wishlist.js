document.addEventListener('DOMContentLoaded', function () {
  console.log('Wishlist loaded')
  document.querySelectorAll('.wishlist-add-product').forEach(element => {
    element.addEventListener('click', function(e) {
      e.preventDefault();
      
      const el = this;

      const data = {
        action: 'simple_wishlist_toggle',
        nonce:  this.dataset.nonce,
        productid: this.dataset.productid,
      }
      
      fetch(window.woocommerce_params.ajax_url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
          'Cache-Control': 'no-cache',
        },
        body: new URLSearchParams(data),
      })
        .then(response => response.json())
        .then(body => {
          console.log(body);

          if (!body.success) {
            alert(response.data);
            return;
          }
          
          el.querySelector('img').src = body.data.icon
          console.log('success')
        });
    });
  });
});
