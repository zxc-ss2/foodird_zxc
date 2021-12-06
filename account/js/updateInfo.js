const saveInfo = document.querySelector('.save-btn-info');
const savePass = document.querySelector('.save-btn-pass');
let data = [];

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

saveInfo.addEventListener("click", () => {

    const failWindow = document.querySelectorAll('.fail')[0];

    if(document.querySelector('.name-form__inp').value === "" && document.querySelector('.email-form__inp').value === ""){
        let failContent = document.querySelectorAll('.fail-content')[0];
        failContent.textContent = "Хотя бы одно занчение не должно быть пустым";
        failWindow.style.opacity = "1";
        failWindow.style.visibility = "visible";
    }

    else{
        failWindow.style.opacity = "0";
        failWindow.style.visibility = "collapse";

        if(document.querySelector('.name-form__inp').value == ""){
            data.push(document.querySelectorAll('.placeholder')[0].textContent);
        }
        
        else{
            data.push(document.querySelector('.name-form__inp').value);
    
        }
    
        if(document.querySelector('.email-form__inp').value == ""){
            data.push(document.querySelectorAll('.placeholder')[1].textContent);
        }
    
        else{
            data.push(document.querySelector('.email-form__inp').value);
        }
    
            new Promise((resolve,reject) => {
                let xmlHttp = new XMLHttpRequest();
                xmlHttp.open("post", "../controllers/updateUserInfo.php"); 
    
                    xmlHttp.onreadystatechange = function()
                    {
                        if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
                        {
                            let timer = document.querySelector('.timer');
                            timer.style.fontSize = "20px";
                            document.querySelectorAll('.placeholder')[0].textContent = document.querySelector('.name-form__inp').value;
                            document.querySelectorAll('.placeholder')[1].textContent = document.querySelector('.email-form__inp').value;
                            data = [];
                            const successWindow = document.querySelector('.success');
                            successWindow.style.opacity = "1";
                            successWindow.style.visibility = "visible";
                            let href = window.location.href.split('/');
                            href[href.length - 2] = "reglog";
                            href[href.length - 1] = "log.php";
                            let newHref = "";
                            for (let i = 0; i < href.length; i++) {
                                newHref += href[i] + "/";
                            }
                            newHref = newHref.substring(0, newHref.length - 1);
                            startTimer(5,timer);
    
                            setTimeout(function () {
                                
                                location = "http://localhost/project/reglog/log.php";
                            }, 6000);
                        }
                    }
                    xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xmlHttp.send("data=" + JSON.stringify(data)); 
            })
    }
        
});


savePass.addEventListener("click", () => {
    const failWindow = document.querySelectorAll('.fail')[1];

    if(document.querySelector('.new__pass').value === "" && document.querySelector('.conf-new__pass').value === ""){
        let failContent = document.querySelectorAll('.fail-content')[1];
        failContent.textContent = "Значения не могут быть пустыми";
        failWindow.style.opacity = "1";
        failWindow.style.visibility = "visible";
    }

    else if(document.querySelector('.new__pass').value != document.querySelector('.conf-new__pass').value){
        let failContent = document.querySelectorAll('.fail-content')[1];
        failContent.textContent = "Пароли не сходятся";
        failWindow.style.opacity = "1";
        failWindow.style.visibility = "visible";
    }

    else{
        data.push(document.querySelector('.conf-new__pass').value);
        failWindow.style.opacity = "0";
        failWindow.style.visibility = "collapse";

        new Promise((resolve,reject) => {
            let xmlHttp = new XMLHttpRequest();
            xmlHttp.open("post", "../controllers/updatePassword.php"); 
    
                xmlHttp.onreadystatechange = function()
                {
                    if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
                    {
                        data = [];
                        const successWindow = document.querySelectorAll('.success')[1];
                        successWindow.style.opacity = "1";
                        successWindow.style.visibility = "visible";
    
                        setTimeout(function () {
                            location = "http://localhost/project/reglog/log.php";
                        }, 5000);
                    }
                }
                xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xmlHttp.send("data=" + JSON.stringify(data)); 
        })
    }

})