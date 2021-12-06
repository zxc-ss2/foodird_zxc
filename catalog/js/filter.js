const priceDecrese = document.querySelector('.price-decrease');
const priceIncrese = document.querySelector('.price-increase');
let data = [];


priceDecrese.addEventListener("click", () => {
    data.push(document.querySelector('.price-data').dataset.category);
    new Promise((resolve,reject) => {
        let xmlHttp2 = new XMLHttpRequest();
        xmlHttp2.open("post", "../controllers/priceDecrease.php"); 

        xmlHttp2.onreadystatechange = function()
            {
                if(xmlHttp2.readyState == 4 && xmlHttp2.status == 200)
                {
                    let result2 = JSON.parse(xmlHttp2.responseText);
                    const contentPaageItems = document.querySelector('.asdasd');
                    contentPaageItems.innerHTML = "";
                    for (let i = 0; i < result2.length; i++) {
                        let template = `
                        <article name="zxc" data-id=${Object.values(result2)[i]['product_id']} class="content-page__item item-product">
                            <div class="item-product__labels">
                                <div class="item-product__label item-product__label_sale">-${Object.values(result2)[i]['discount_value'] }%</div>
                                <div class="item-product__label item-product__label_cart _icon-cart"></div>
                            </div>
                            <a href="" class="item-product__image">
                                <img class="catalog-img" src="${Object.values(result2)[i]['product_path']}" alt="">
                            </a>
                            <div class="item-product__body">
                                <div class="item-product__content">
                                <a href="../product/index.php?id=${Object.values(result2)[i]['product_id']}"><h5 class="item-product__title">${Object.values(result2)[i]['product_name']}</h5></a>
                                </div>
                                <div class="item-product__prices">
                                    <div class="item-product__price">${(Object.values(result2)[i]['product_price'] - Object.values(result2)[i]['product_price'] * Object.values(result2)[i]['discount_value']/100).toFixed(1)}руб./кг</div>
                                    <div class="item-product__price item-product__price_old">${(Object.values(result2)[i]['product_price'])}руб./кг</div>
                                </div>
                                <div class="item-product__actions actions-product">
                                    <div class="actions-product__body">
                                        <a class="btn  actions-product__btn">В корзину</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                        `;
                        contentPaageItems.insertAdjacentHTML("afterbegin", template);
                    }

                    const consistProducts = [];
new Promise((resolve,reject) => {
    let xmlHttp2 = new XMLHttpRequest();
    xmlHttp2.open("post", "../controllers/getCartId.php"); 

    xmlHttp2.onreadystatechange = function()
        {
            if(xmlHttp2.readyState == 4 && xmlHttp2.status == 200)
            {
                // for (let i = 0; i < this.responseText.length; i++) {
                //     const element = array[i];
                    
                // }
                result = JSON.parse(xmlHttp2.responseText);
                for (let i = 0; i < result.length; i++) {
                    consistProducts.push(Object.values(result)[i]['product_id']);
                }

                const links = document.querySelectorAll(".actions-product__btn");
                const itemCart = document.querySelectorAll(".item-product");
                let numbers = [];
                let productId = 0;

                for (let i = 0; i < links.length; i++) {

                    if(consistProducts.includes(itemCart[i].dataset.id)){
                        itemCart[i].childNodes[1].childNodes[3].style.display = "flex";
                        links[i].setAttribute('disabled', true);
                    }
                    else{
                        links[i].addEventListener('click', () =>{
                            productId = links[i].closest('.item-product').dataset.id;
                            if(!links[i].classList.contains('_hold')){
                                links[i].classList.add('_hold');
                                links[i].classList.add('_fly');
    
                                const cart = document.querySelector('.cart-header__icon');
                                const productImage = links[i].closest('.item-product').childNodes[3].childNodes[1];
    
                                const productImageFly = productImage.cloneNode(true);
    
                                const productImageFlyTop = productImage.getBoundingClientRect().top;
                                const productImageFlyLeft = productImage.getBoundingClientRect().left;
                                const productImageFlyWidth = productImage.offsetWidth;
                                const productImageFlyHeight = productImage.offsetHeight;
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
                                    left: ${cartFlyLeft}px !important;
                                    top: ${cartFlyTop}px;
                                    width: 0px;
                                    height: 0px;
                                    opacity: 0;
                                `;
                            }
    
                            function sendData(url, id){
                                return new Promise((resolve,reject) => {
                                    let xmlHttp = new XMLHttpRequest();
                                    xmlHttp.open("post", url); 
                        
                                        xmlHttp.onreadystatechange = function()
                                        {
                                            if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
                                            {
                                                numbers.push(links[i].parentNode.parentNode.parentNode.parentNode.dataset.id);
                                                links[i].parentNode.parentNode.parentNode.parentNode.childNodes[1].children[1].style.display = "flex";
                                            }
                                        }
                                        xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                        xmlHttp.send("id=" + id); 
                                })
                                
                            }
                            sendData("../controllers/server.php",productId);
                        })
                    }
                    
            }
                        }
                    }
                    xmlHttp2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xmlHttp2.send("id=" + 0); 
            })


                    const sliderItemsLabels = document.querySelectorAll('.item-product__label_sale');
                    const productPrices = document.querySelectorAll('.item-product__prices');
    
                    for (let i = 0; i < sliderItemsLabels.length; i++) {
                        if(sliderItemsLabels[i].textContent == "-0%"){
                            sliderItemsLabels[i].style.display = "none";
                            const remove = productPrices[i].children[0];
                            const decor = productPrices[i].children[1];
                            remove.parentNode.removeChild(remove);
                            decor.style.textDecoration = "none";
                        }
                    } 
                } 
            }              
            xmlHttp2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xmlHttp2.send("data=" + JSON.stringify(data)); 
    })
})

priceIncrese.addEventListener("click", () => {
    data.push(document.querySelector('.price-data').dataset.category);
    new Promise((resolve,reject) => {
        let xmlHttp3 = new XMLHttpRequest();
        xmlHttp3.open("post", "../controllers/priceIncrease.php"); 

        xmlHttp3.onreadystatechange = function()
            {
                if(xmlHttp3.readyState == 4 && xmlHttp3.status == 200)
                {
                    let result2 = JSON.parse(xmlHttp3.responseText);
                    const contentPaageItems = document.querySelector('.asdasd');
                    contentPaageItems.innerHTML = "";
                    for (let i = 0; i < result2.length; i++) {
                        let template = `
                        <article name="zxc" data-id=${Object.values(result2)[i]['product_id']} class="content-page__item item-product">
                            <div class="item-product__labels">
                                <div class="item-product__label item-product__label_sale">-${Object.values(result2)[i]['discount_value']}%</div>
                                <div class="item-product__label item-product__label_cart _icon-cart"></div>
                            </div>
                            <a href="" class="item-product__image">
                                <img class="catalog-img" src="${Object.values(result2)[i]['product_path']}" alt="">
                            </a>
                            <div class="item-product__body">
                                <div class="item-product__content">
                                <a href="../product/index.php?id=${Object.values(result2)[i]['product_id']}"><h5 class="item-product__title">${Object.values(result2)[i]['product_name']}</h5></a>
                                </div>
                                <div class="item-product__prices">
                                    <div class="item-product__price">${(Object.values(result2)[i]['product_price'] - Object.values(result2)[i]['product_price'] * Object.values(result2)[i]['discount_value']/100).toFixed(1)}руб./кг</div>
                                    <div class="item-product__price item-product__price_old">${(Object.values(result2)[i]['product_price'])}руб./кг</div>
                                </div>
                                <div class="item-product__actions actions-product">
                                    <div class="actions-product__body">
                                        <a class="btn  actions-product__btn">В корзину</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                        `;
                        contentPaageItems.insertAdjacentHTML("afterbegin", template);
                    }

                    const consistProducts = [];
new Promise((resolve,reject) => {
    let xmlHttp2 = new XMLHttpRequest();
    xmlHttp2.open("post", "../controllers/getCartId.php"); 

    xmlHttp2.onreadystatechange = function()
        {
            if(xmlHttp2.readyState == 4 && xmlHttp2.status == 200)
            {
                // for (let i = 0; i < this.responseText.length; i++) {
                //     const element = array[i];
                    
                // }
                result = JSON.parse(xmlHttp2.responseText);
                for (let i = 0; i < result.length; i++) {
                    consistProducts.push(Object.values(result)[i]['product_id']);
                }

                const links = document.querySelectorAll(".actions-product__btn");
                const itemCart = document.querySelectorAll(".item-product");
                let numbers = [];
                let productId = 0;

                for (let i = 0; i < links.length; i++) {

                    if(consistProducts.includes(itemCart[i].dataset.id)){
                        itemCart[i].childNodes[1].childNodes[3].style.display = "flex";
                        links[i].setAttribute('disabled', true);
                    }
                    else{
                        links[i].addEventListener('click', () =>{
                            productId = links[i].closest('.item-product').dataset.id;
                            if(!links[i].classList.contains('_hold')){
                                links[i].classList.add('_hold');
                                links[i].classList.add('_fly');
    
                                const cart = document.querySelector('.cart-header__icon');
                                const productImage = links[i].closest('.item-product').childNodes[3].childNodes[1];
    
                                const productImageFly = productImage.cloneNode(true);
    
                                const productImageFlyTop = productImage.getBoundingClientRect().top;
                                const productImageFlyLeft = productImage.getBoundingClientRect().left;
                                const productImageFlyWidth = productImage.offsetWidth;
                                const productImageFlyHeight = productImage.offsetHeight;
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
                                    left: ${cartFlyLeft}px !important;
                                    top: ${cartFlyTop}px;
                                    width: 0px;
                                    height: 0px;
                                    opacity: 0;
                                `;
                            }
    
                            function sendData(url, id){
                                return new Promise((resolve,reject) => {
                                    let xmlHttp = new XMLHttpRequest();
                                    xmlHttp.open("post", url); 
                        
                                        xmlHttp.onreadystatechange = function()
                                        {
                                            if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
                                            {
                                                numbers.push(links[i].parentNode.parentNode.parentNode.parentNode.dataset.id);
                                                links[i].parentNode.parentNode.parentNode.parentNode.childNodes[1].children[1].style.display = "flex";
                                            }
                                        }
                                        xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                        xmlHttp.send("id=" + id); 
                                })
                                
                            }
                            sendData("../controllers/server.php",productId);
                        })
                    }
                    
            }
                        }
                    }
                    xmlHttp2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xmlHttp2.send("id=" + 0); 
            })


                    const sliderItemsLabels = document.querySelectorAll('.item-product__label_sale');
                    const productPrices = document.querySelectorAll('.item-product__prices');

                    for (let i = 0; i < sliderItemsLabels.length; i++) {
                        if(sliderItemsLabels[i].textContent == "-0%"){
                            sliderItemsLabels[i].style.display = "none";
                            const remove = productPrices[i].children[0];
                            const decor = productPrices[i].children[1];
                            remove.parentNode.removeChild(remove);
                            decor.style.textDecoration = "none";
                        }
                    }
                }  
            }              
            xmlHttp3.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xmlHttp3.send("data=" + JSON.stringify(data)); 
    })
})