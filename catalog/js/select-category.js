const asidePageItem = document.querySelectorAll('.aside-page__item');
let productsId = [];
let productsName = [];
let productsPrice = [];
let productsPath = [];

for (let i = 0; i < asidePageItem.length; i++) {
    const categoryId = asidePageItem[i].dataset.id;
    asidePageItem[i].addEventListener("click", () => {
        document.querySelector('.price-data').setAttribute("data-category", categoryId);
        new Promise((resolve,reject) => {
            let xmlHttp = new XMLHttpRequest();
            xmlHttp.open("post", "../controllers/selectedCategory.php"); 
                        
            xmlHttp.onreadystatechange = function()
            {
                if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
                {
                    let result = JSON.parse(xmlHttp.responseText);

                    const categoryTitle = document.querySelector('.category-title');
                    const categoryItems = document.querySelector('.asdasd');

                    categoryTitle.children[0].textContent = "";
                    categoryItems.innerHTML = "";

                    categoryTitle.scrollIntoView();


                    for (let i = 0; i < result.length; i++) {
                        categoryTitle.children[0].textContent = Object.values(result)[i]['category_name'];

                        const productTemplate = `
                            <article name="zxc" data-id=${Object.values(result)[i]['product_id']} class="content-page__item item-product">
                                <div class="item-product__labels">
                                    <div class="item-product__label item-product__label_sale">-${Object.values(result)[i]['discount_value']}%</div>
                                    <div class="item-product__label item-product__label_cart _icon-cart"></div>
                                </div>
                                <a href="" class="item-product__image">
                                    <img class="catalog-img" src="${Object.values(result)[i]['product_path']}" alt="">
                                </a>
                                <div class="item-product__body">
                                    <div class="item-product__content">
                                    <a href="../product/index.php?id=${Object.values(result)[i]['product_id']}&category=${Object.values(result)[i]['category_id']}"><h5 class="item-product__title">${Object.values(result)[i]['product_name']}</h5></a>
                                    </div>
                                    <div class="item-product__prices">
                                        <div class="item-product__price">${(Object.values(result)[i]['product_price'] - Object.values(result)[i]['product_price'] * (Object.values(result)[i]['discount_value'])/100).toFixed(1)} руб.</div>
                                        <div class="item-product__price item-product__price_old">${Object.values(result)[i]['product_price']}руб.</div>
                                    </div>
                                    <div class="item-product__actions actions-product">
                                        <div class="actions-product__body">
                                            <a class="btn  actions-product__btn">В корзину</a>
                                        </div>
                                    </div>
                                </div>
                            </article>

                        `;

                        console.log(xmlHttp.responseText);

                        categoryItems.insertAdjacentHTML("afterbegin", productTemplate);
                        
                        new Promise((resolve,reject) => {
                            let xmlHttp = new XMLHttpRequest();
                            xmlHttp.open("post", "../controllers/max.php"); 
                                        
                            xmlHttp.onreadystatechange = function()
                            {
                                if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
                                {
                                    let maxPrice = JSON.parse(xmlHttp.responseText);
                                    for (let i = 0; i < maxPrice.length; i++) {
                                    }
                                }
                            }
                            xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                            xmlHttp.send("id=" + JSON.stringify(categoryId)); 
                        })

                        new Promise((resolve,reject) => {
                            let xmlHttp = new XMLHttpRequest();
                            xmlHttp.open("post", "../controllers/min.php"); 
                                        
                            xmlHttp.onreadystatechange = function()
                            {
                                if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
                                {
                                    let minPrice = JSON.parse(xmlHttp.responseText);
                                    for (let i = 0; i < minPrice.length; i++) {
                                    }
                                }
                            }
                            xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                            xmlHttp.send("id=" + JSON.stringify(categoryId)); 
                        })

                        const consistProducts = [];
                            new Promise((resolve,reject) => {
                                let xmlHttp2 = new XMLHttpRequest();
                                xmlHttp2.open("post", "../controllers/getCartId.php"); 

                                const sliderItemsLabels = document.querySelectorAll('.item-product__label_sale');

                                xmlHttp2.onreadystatechange = function()
                                    {
                                        if(xmlHttp2.readyState == 4 && xmlHttp2.status == 200)
                                        {
                                            for (let i = 0; i < sliderItemsLabels.length; i++) {
                                            
                                                    if(sliderItemsLabels[i].textContent == "-0%"){
                                                        sliderItemsLabels[i].style.display = "none";
                                                    }
                                            }

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
            

            xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xmlHttp.send("id=" + JSON.stringify(categoryId)); 
        })
    })
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
