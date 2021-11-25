// ------------------------header animation-----------------//
const headerElement = document.querySelector('.header');

const callback = function (entries, observer) {
    if (entries[0].isIntersecting) {
        headerElement.classList.remove('_scroll');
    }
    else {
        headerElement.classList.add('_scroll');
    }
};
const headerObserver = new IntersectionObserver(callback);
headerObserver.observe(headerElement);
// ------------------------searchobox animation-----------------//

window.onload = function () {
    document.addEventListener("click", documentActions);
    const offer = document.querySelector('.search-bot');

    function documentActions(e) {
        const targetElement = e.target;
        if (targetElement.classList.contains("actions-header__item_search")) {
            document.querySelector('.search-form').classList.toggle('_active');
        }
        else if (!targetElement.closest('.search-form') && document.querySelector('.search-form._active')) {
            document.querySelector('.search-form').classList.remove('_active');
        }

        if (document.querySelector('.search-form._active')) {
            offer.style = "padding-top: 160px";
        }
        else {
            offer.style = "padding-top: 80px";
        }

        if (targetElement.classList.contains('products-more')) {
            getProducts(targetElement);
            e.preventDefault();
        }
            
    }


};
// ------------------------mobile menu animation-----------------//

const iconMenu = document.querySelector('.menu__btn');
if (iconMenu) {
    const menuBody = document.querySelector('.menu__body');
    iconMenu.addEventListener("click", function (e) {

        if (iconMenu.classList.contains('.is-open')) {
            document.body.classList.remove('_lock');
            menuBody.classList.remove('_active');
        }
        else {
            document.body.classList.toggle('_lock');
            menuBody.classList.toggle('_active');
        }
    });
}
;

class MenuHandler {
    constructor() {
        this.menuTrigger = $('#menu-trigger');
        this.toggleMenu();
    }

    toggleMenu() {
        this.menuTrigger.on('click', () => {
            this.menuTrigger.toggleClass('is-open');
            this.menu.toggleClass('is-open');
        });

    }

}
// ------------------------animation-----------------//

const animItems = document.querySelectorAll('._anim-item');
if (animItems.length > 0) {
    window.addEventListener('scroll', animOnScroll);
    function animOnScroll() {
        for (let i = 0; i < animItems.length; i++) {
            const animItem = animItems[i];
            const animItemHeight = animItem.offsetHeight;
            const animItemOffset = offset(animItem).top;
            const animStart = 4;

            let animItemPoint = window.innerHeight - animItemHeight / animStart;
            if (animItemHeight > window.innerHeight) {
                animItemPoint = window.innerHeight - window.innerHeight / animStart;
            }

            if ((pageYOffset > animItemOffset - animItemPoint) && pageYOffset < (animItemOffset + animItemHeight)) {
                animItem.classList.add('_active');
            }
            else {
                animItem.classList.remove('_active');
            }
        }
    }

    function offset(el) {
        const rect = el.getBoundingClientRect(),
            scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
            scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        return { top: rect.top + scrollTop, left: rect.left + scrollLeft }
    }
}
// ------------------------price calculation-----------------//

let less = document.querySelectorAll(".minus");
let more = document.querySelectorAll(".plus");
let defaultPrice = document.querySelectorAll('.item-cart__price');
let payCart = document.querySelector('.pay-cart__price');
let payCartPrice = 0;

for (let i = 0; i < less.length; i++) {
    const startPrice = Number(defaultPrice[i].dataset.price);
    less[i].style = "cursor: pointer";
    less[i].addEventListener("click", () =>{
        let char = less[i].parentNode.parentNode.childNodes[3].childNodes[0];
        let minus = Number(less[i].parentNode.parentNode.childNodes[3].childNodes[0].textContent);
        let dynamicPrice = defaultPrice[i].childNodes[0];
        let finishPrice = 0;

        if(minus == 1){
            minus -= 0;
            finishPrice = startPrice - 0;
            payCartPrice -= 0;
        }

        if(minus > 1){
            minus -= 1;
            finishPrice = Number(dynamicPrice.textContent) - startPrice;
            payCartPrice -= startPrice;
        }
        char.textContent = String(minus);
        dynamicPrice.textContent = String(finishPrice.toFixed(1));
        payCart.textContent = payCartPrice.toFixed(1) + "Р"; 
    })
}

for (let i = 0; i < more.length; i++) {
    const startPrice = Number(defaultPrice[i].dataset.price);
    more[i].style = "cursor: pointer";
    more[i].addEventListener("click", () =>{
        let char = more[i].parentNode.parentNode.childNodes[3].childNodes[0];
        let plus = Number(more[i].parentNode.parentNode.childNodes[3].childNodes[0].textContent);
        let dynamicPrice = defaultPrice[i].childNodes[0];

        plus += 1;
        char.textContent = String(plus);
        let finishPrice = startPrice + Number(dynamicPrice.textContent);
        dynamicPrice.textContent = String(finishPrice.toFixed(1));
        payCartPrice += startPrice;
        payCart.textContent = payCartPrice.toFixed(1) + "Р"; 

    })
    payCartPrice += Number(defaultPrice[i].dataset.price);
    payCart.textContent = payCartPrice.toFixed(1) + "Р";
}

// ------------------------similar products output-----------------//
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
                            console.log(productId);
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
                    xmlHttp2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xmlHttp2.send("id=" + 0); 
            })
    



function startTimer(duration, display) {
    var timer = duration, seconds;
    setInterval(function () {
        seconds = parseInt(timer % 60, 10);

        seconds = seconds < 10 ? seconds : seconds;

        display.textContent = seconds;
        if(seconds == 0){
            display.textContent = seconds;
        }

        console.log(seconds);

        if (--timer < 0) {
            timer = duration;
        }
        
    }, 1000);
}

const removeBtns = document.querySelectorAll('.item-cart__delete');
const cartItems = document.querySelectorAll('.item-cart');
const itemG = [];
let removeData = 0;
for (let i = 0; i < removeBtns.length; i++) {
    removeBtns[i].addEventListener("click", () => {
        const cxv = cartItems[i];
        const returnText = document.querySelector('.return__text');
        const returnTime = document.querySelector('.return__time');
        const returnDelete = document.querySelector('.return__delete');
        returnTime.style.display = "flex";
        returnDelete.style.display = "block";
        const backProduct = `<a class="back-to-cart">Вернуть</a>`;
        returnText.insertAdjacentHTML('afterbegin', backProduct);
        const backToCart = document.querySelector('.back-to-cart');
        startTimer(15,returnTime);
        cxv.style.display = "none";
        

        backToCart.addEventListener("click", () => {
            cxv.style.display = "flex";
            backToCart.parentNode.removeChild(backToCart);
            returnDelete.style.display = "none";
            returnTime.style.display = "none";
            removeData = 0;
        })
        removeData = cartItems[i].dataset.id;


        setTimeout(() => {
            new Promise((resolve,reject) => {
                let xmlHttp = new XMLHttpRequest();
                xmlHttp.open("post", "../controllers/removeProduct.php"); 
                    xmlHttp.onreadystatechange = function()
                    {
                        if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
                        { 
                            // const cartContent = document.querySelector('.cart__content');
                            // const backProduct = `<a class="back-to-cart">Вернуть в коризну</a>`;
                            // cartContent.insertAdjacentHTML('beforeEnd', backProduct);
                            // const backToCart = document.querySelector('.back-to-cart');
                            // backToCart.addEventListener("click", () => {
                            //     // const cartContent = document.querySelector('.cart__content');
                            //     // console.log(cartContent);
                            //     // const backProduct = `<a class="back-to-cart">Вернуть в коризну</a>`;
                            //     // cartContent.insertAdjacentHTML('beforeEnd', cxv);
                            //     // const backToCart = document.querySelector('.back-to-cart');
                            //     // backToCart.addEventListener("click", () => {
                            // })
                            if(removeData != 0){
                                window.location.reload();
                            }
                        }
                    }
                    xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xmlHttp.send("id=" + JSON.stringify(removeData)); 
                })
        }, 16000)
    })
}

const sliderItemsLabels = document.querySelectorAll('.item-product__label_sale');

for (let i = 0; i < sliderItemsLabels.length; i++) {
    if(sliderItemsLabels[i].textContent == "-0%"){
        sliderItemsLabels[i].style.display = "none";
    }
}


