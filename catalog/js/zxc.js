const links = document.querySelectorAll(".actions-product__btn");
let productId;
let productName;
let productPrice;

for (let i = 0; i < links.length; i++) {
    links[i].addEventListener('click', () =>{
        productId = links[i].closest('.item-product').dataset.id;

        if(!links[i].classList.contains('_hold')){
            links[i].classList.add('_hold');
            links[i].classList.add('_fly');

            const cart = document.querySelector('.cart-header__icon');
            const productImage = links[i].closest('.item-product').childNodes[3].childNodes[1];

            const productImageFly = productImage.cloneNode(true);
            const productImageFlyWidth = productImage.offsetWidth;
            const productImageFlyHeight = productImage.offsetHeight;
            const productImageFlyTop = productImage.getBoundingClientRect().top;
            const productImageFlyLeft = productImage.getBoundingClientRect().left;

            productImageFly.setAttribute('class', '_flyImage _ibg');
            productImageFly.style.cssText = `
                left: ${productImageFlyLeft}px !important;
                top: ${productImageFlyTop}px;
                width: ${productImageFlyWidth}px;
                height: ${productImageFlyHeight}px;
            `;

            document.body.append(productImageFly);

            const cartFlyLeft= cart.getBoundingClientRect().left;
            const cartFlyTop= cart.getBoundingClientRect().top;

            productImageFly.style.cssText = `
                left: ${cartFlyLeft}px;
                top: ${cartFlyTop}px;
                width: 0px;
                height: 0px;
                opacity: 0;
            `;

            let http = new XMLHttpRequest();
            http.open("get", "../controllers/zxc.php"); 

            http.onload = () => {
                console.log(http.response)
            }

                http.onreadystatechange = function()
                {
                    if(http.readyState == 4 && xmlHttp.status == 200)
                    {
                        console.log(http.responseText);
                    }
                }
                console.log(http.readyState);
                http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                http.send();    
            
        }
    })
}
