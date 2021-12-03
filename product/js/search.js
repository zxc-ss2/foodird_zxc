const searchInput = document.querySelector('.search-from__input');
const searchWindow = document.querySelector('.search-window');
const windowContent = document.querySelector('.search-window__content');

searchInput.addEventListener("input", () => {
    windowContent.innerHTML = "";
    let searching = searchInput.value;
    new Promise((resolve,reject) => {
        let xmlHttp = new XMLHttpRequest();
        xmlHttp.open("post", "../controllers/search.php"); 
                    
        xmlHttp.onreadystatechange = function()
        {
            if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
            {
                if(xmlHttp.responseText.length != 0){
                    let data = JSON.parse(xmlHttp.responseText);
                    searchWindow.style.top = "160px";
                    for (let i = 0; i < data.length; i++) {
                        let template = `
                        <div class="search-window__item item-window">
                            <div class="item-window__img">
                                <a href="../product/index.php?id=${Object.values(data)[i]['product_id']}&category=${Object.values(data)[i]['category_id']}" class="" href="#"><img src="${Object.values(data)[i]['product_path']}" alt=""></a>
                            </div>
                            <div class="item-window__info info-window">
                                <a style="color: #000;" href="../product/index.php?id=${Object.values(data)[i]['product_id']}&category=${Object.values(data)[i]['category_id']}" class="info-window__name">${Object.values(data)[i]['product_name']}</a>
                                <div class="info-window__price">${Object.values(data)[i]['product_price']}</div>
                            </div>
                        </div>
                        `;

                        windowContent.insertAdjacentHTML("afterbegin", template);
                    }
                }
            }
        }
        xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xmlHttp.send("info=" + JSON.stringify(searching)); 
    })
})
