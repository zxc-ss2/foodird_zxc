const saveInfo = document.querySelector('.save-btn-info');
const savePass = document.querySelector('.save-btn-pass');
let data = [];

saveInfo.addEventListener("click", () => {
    data.push(document.querySelector('.name-form__inp').value);
    data.push(document.querySelector('.email-form__inp').value);

    console.log(data);

            new Promise((resolve,reject) => {
            let xmlHttp = new XMLHttpRequest();
            xmlHttp.open("post", "../controllers/updateUserInfo.php"); 

                xmlHttp.onreadystatechange = function()
                {
                    if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
                    {
                        document.querySelectorAll('.placeholder')[0].textContent = document.querySelector('.name-form__inp').value;
                        document.querySelectorAll('.placeholder')[1].textContent = document.querySelector('.email-form__inp').value;
                        data = [];
                        const successWindow = document.querySelector('.success');
                        successWindow.style.opacity = "1";
                        successWindow.style.visibility = "visible";
                    }
                }
                xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xmlHttp.send("data=" + JSON.stringify(data)); 
        })
        
})