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

async function getProducts(button) {
    if (!button.classList.contains('_hold')) {
        button.classList.add('_hold');
        const file = "json/products.json";
        let response = await fetch(file, {
            method: "GET"
        });
        if (response.ok) {
            let result = await response.json();
            loadProducts(result);
            button.classList.remove('_hold');
            button.remove();
        }
        else {
            alert('sesh');
        }
    }
}

function loadProducts(data) {
}
;
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
const saveBtn = document.querySelector('.save-btn');
function updateUserInfo(){
    return new Promise((resolve,reject) => {
        const info = [];
        const name = document.querySelector('.name-form__inp').value;
        const nameDefault = document.querySelector('.name-form__inp').getAttribute("placeholder");
        if(name !== ''){
            info.push(name);
        }
        else{
            info.push(nameDefault);
        }

        // const surname = document.querySelector('.surname-form__inp').value;
        // const surnameDefault = document.querySelector('.surname-form__inp').getAttribute("placeholder");
        // if(surname !== ''){
        //     info.push(surname);
        // }
        // else{
        //     info.push(surnameDefault);
        // }

        const email = document.querySelector('.email-form__inp').value;
        const emailDefault = document.querySelector('.email-form__inp').getAttribute("placeholder");
        if(email !== ''){
            info.push(email);
        }
        else{
            info.push(emailDefault);
        }
        let xmlHttp = new XMLHttpRequest();
    
        xmlHttp.open("post", "../controllers/changeUserInfo.php"); 
        xmlHttp.onreadystatechange = function()
        {
            if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
            {   
                window.location = "http://localhost/project/reglog/log.php";
            }
        }
                    
        xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xmlHttp.send("info=" + JSON.stringify(info)); 
    })
}

// saveBtn.addEventListener("click", updateUserInfo);




