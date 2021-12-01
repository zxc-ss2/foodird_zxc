const seeMore = document.querySelector('.see-more');
// console.log(parseInt('08', 8) + parseInt('05', 8));
seeMore.addEventListener('click', () => {
    const usedProducts = [];
    const itemProducts = document.querySelectorAll('.item-product');
    for (let index = 0; index < itemProducts.length; index++) {
        usedProducts.push(itemProducts[index].dataset.id);
    }
    new Promise((resolve,reject) => {
        let xmlHttp = new XMLHttpRequest();
        xmlHttp.open("post", "../controllers/seeMore.php"); 

            xmlHttp.onreadystatechange = function()
            {
                if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
                {
                    let result = JSON.parse(xmlHttp.responseText);
                        for (let i = 0; i < result.length; i++) {
                            const container = document.querySelector('.page-items__discount');
                            for (let j = 0; j < result[i].length; j++) {
                                let template = `
                                <article name="zxc" data-id=${result[i][j]["product_id"]} class="content-page__item item-product">
                                <div class="item-product__labels">
                                    <div class="item-product__label item-product__label_sale">-${result[i][j]["discount_value"]}%</div>
                                </div>
                                <a href="" class="item-product__image">
                                    <img class="catalog-img" src="${result[i][j]["product_path"]}" alt="">
                                </a>
                                <div class="item-product__body">
                                    <div class="item-product__content">
                                        <a href="../product/index.php?id=${result[i][j]["product_id"]}&category=${result[i][j]["category_id"]}" class="item-product__title">${result[i][j]["product_name"]}</a>
                                    </div>
                                    <div class="item-product__prices">
                                        <div class="item-product__price">${(result[i][j]["product_price"] - result[i][j]["product_price"] * result[i][j]["discount_value"] / 100.).toFixed(1)}руб.</div>
                                        <div class="item-product__price item-product__price_old">${result[i][j]["product_price"]}руб.</div>
                                    </div>
                                    <div class="item-product__actions actions-product">
                                        <div class="actions-product__body">
                                            <a class="btn  actions-product__btn">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                            </article>`;
                            container.insertAdjacentHTML('beforeEnd', template);

                            const links = document.querySelectorAll(".actions-product__btn");
                            let numbers = [];
                        
                            let productId = 0;
                        
                            for (let i = 0; i < links.length; i++) {
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
            }
            xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xmlHttp.send("id=" + JSON.stringify(usedProducts)); 
    })
})

