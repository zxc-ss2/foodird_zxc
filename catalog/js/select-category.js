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
                    const categoryBtn = document.querySelector('.category-btn');

                    categoryTitle.children[0].textContent = "";
                    categoryItems.innerHTML = "";
                    categoryBtn.innerHTML = "";

                    categoryTitle.scrollIntoView();


                    for (let i = 0; i < result.length; i++) {
                        categoryTitle.children[0].textContent = Object.values(result)[i]['category_name'];

                        const productTemplate = `
                            <article name="zxc" data-id=${Object.values(result)[i]['product_id']} class="content-page__item item-product">
                                <div class="item-product__labels">
                                    <div class="item-product__label item-product__label_sale">-${Object.values(result)[i]['discount_id'] * 5}%</div>
                                    <div class="item-product__label item-product__label_cart _icon-cart"></div>
                                </div>
                                <a href="" class="item-product__image">
                                    <img class="catalog-img" src="${Object.values(result)[i]['product_path']}" alt="">
                                </a>
                                <div class="item-product__body">
                                    <div class="item-product__content">
                                    <a href="../product/index.php?id=${Object.values(result)[i]['product_id']}"><h5 class="item-product__title">${Object.values(result)[i]['product_name']}</h5></a>
                                    </div>
                                    <div class="item-product__prices">
                                        <div class="item-product__price">${(Object.values(result)[i]['product_price'] - Object.values(result)[i]['product_price'] * (Object.values(result)[i]['discount_id'] * 5)/100).toFixed(1)} руб./кг</div>
                                        <div class="item-product__price item-product__price_old">${Object.values(result)[i]['product_price']}руб./кг</div>
                                    </div>
                                    <div class="item-product__actions actions-product">
                                        <div class="actions-product__body">
                                            <a class="btn  actions-product__btn">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        `;

                        categoryItems.insertAdjacentHTML("afterbegin", productTemplate);
                        const leftInp = document.querySelector('#left-inp');
                        const rightInp = document.querySelector('#right-inp');

                        new Promise((resolve,reject) => {
                            let xmlHttp = new XMLHttpRequest();
                            xmlHttp.open("post", "../controllers/max.php"); 
                                        
                            xmlHttp.onreadystatechange = function()
                            {
                                if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
                                {
                                    let maxPrice = JSON.parse(xmlHttp.responseText);
                                    for (let i = 0; i < maxPrice.length; i++) {
                                        rightInp.value = Object.values(maxPrice)[i]['max(product_price)'];
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
                                        leftInp.value = Object.values(minPrice)[i]['min(product_price)'];
                                    }
                                }
                            }
                            xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                            xmlHttp.send("id=" + JSON.stringify(categoryId)); 
                        })
                    }

                }
            }
            xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xmlHttp.send("id=" + JSON.stringify(categoryId)); 
        })
    })
}
