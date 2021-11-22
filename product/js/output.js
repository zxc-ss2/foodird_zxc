// new Promise((resolve,reject) => {
//     let xmlHttp = new XMLHttpRequest();
//     xmlHttp.open("post", "../controllers/selectedCategory.php"); 
//     const categoryId = document.querySelector('.body-product__info').dataset.category;

//     xmlHttp.onreadystatechange = function()
//     {
//         if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
//         {
//             let result = JSON.parse(xmlHttp.responseText);
//             for (let i = 0; i < result.length; i++) {
//                 const slickTrack = document.querySelector('.slick-track');
//                 let template = `
//                 <div class="slider__item slick-slide slick-active" data-slick-index="1" aria-hidden="false" style="width: 298px;" tabindex="0">
//                     <article class="products__item item-product">
//                         <div class="item-product__labels">
//                             <div class="item-product__label item-product__label_sale">-40%</div>
//                         </div>
//                         <a href="" class="item-product__image" tabindex="0">
//                             <img class="catalog-img" src="img/carrot.png" alt="">
//                         </a>
//                         <div class="item-product__body">
//                             <div class="item-product__content">
//                                 <h5 class="item-product__title">sdfgdfg мытая 1кг</h5>
//                             </div>
//                             <div class="item-product__prices">
//                                 <div class="item-product__price">63 руб./кг</div>
//                                 <div class="item-product__price item-product__price_old">72 руб./кг</div>
//                             </div>
//                             <div class="item-product__actions actions-product">
//                                 <div class="actions-product__body">
//                                     <a href="" class="btn  actions-product__btn" tabindex="0">Добавить в корзину</a>
//                                 </div>
//                             </div>
//                         </div>
//                     </article>
//                 </div>
//                 `;
//                 slickTrack.innerHTML = "123";
//                 console.log(slickTrack);
//             }
//         }
//     }
//     xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//     xmlHttp.send("id=" + JSON.stringify(categoryId)); 
// })