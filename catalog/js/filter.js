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
                                        <a class="btn  actions-product__btn">Добавить</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                        `;
                        contentPaageItems.insertAdjacentHTML("afterbegin", template);
                    }
                } 
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
                                        <a class="btn  actions-product__btn">Добавить</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                        `;
                        contentPaageItems.insertAdjacentHTML("afterbegin", template);
                    }
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