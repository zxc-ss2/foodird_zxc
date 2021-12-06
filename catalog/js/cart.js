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
    

