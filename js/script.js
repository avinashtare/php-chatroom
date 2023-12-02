//toggle button click => navbar 
function navbarToggle() {
    let toggleButton = document.getElementById("toggleButton");
    toggleButton.classList.toggle("toggleLinksShow");
};

// message box show 
let message_box = document.querySelector(".message-box");
function messageBox(title, message, type) {
    let HIDEMSG = 2500;
    // type => danger,primery 
    if (type == "danger") {
        message_box.classList.add("danger");
        message_box.classList.remove("primery");
    }
    else if (type == "primery") {
        message_box.classList.remove("danger");
        message_box.classList.add("primery");
    }
    else {
        message_box.classList.remove("danger");
        message_box.classList.add("primery");
    }

    // show mesage box with class 
    message_box.classList.add("message-show");
    // show message
    message_box.children[0].children[0].children[0].innerText = title + " :";
    message_box.children[0].children[0].children[1].innerText = message;

    setTimeout(() => {
        message_box.classList.remove("message-show");
    }, HIDEMSG);
};
function messageHide() {
    message_box.classList.remove("message-show");
};
let messageCloseBtn = message_box.children[0].children[1].children[0];
// console.log(messageCloseBtn)

messageCloseBtn.addEventListener("click", () => {
    messageHide();
});

//dark mode

// dark mode light mode function 
function setDarkMode(element) {
    // icon change
    try {
        element.classList.remove("fa-sun");
        element.classList.add("fa-moon");
    } catch (error) { }

    document.body.classList.add("dark-mode");
    localStorage.setItem("mode", "dark");
};

function setLightMode(element) {
    // icon change
    try {
        element.classList.add("fa-sun");
        element.classList.remove("fa-moon");
    } catch (error) { }

    document.body.classList.remove("dark-mode");
    localStorage.setItem("mode", "light");
};

// dark mode local storage
let webMode = localStorage.getItem("mode");

if (webMode == null) {
    setDarkMode()
}
else {
    if (webMode == "dark") {
        setDarkMode();
    }
    else {
        setLightMode();
    };
}
// dark mode click toggle mode 
function Dark_Mode(element) {
    webMode = localStorage.getItem("mode");

    if (webMode == "dark") {
        setLightMode(element);
    }
    else {
        setDarkMode(element);
    };
};

// friends image over  

let showImgDom = document.getElementById("show-img-dom");

showImgDom.addEventListener("mouseenter", (element) => {
    element.target.children[0].classList.add("back-img-hover");
    element.target.children[1].classList.add("friends-gorup-hover");
    showImgDom.addEventListener("mouseleave", (element) => {
        element.target.children[0].classList.remove("back-img-hover");
        element.target.children[1].classList.remove("friends-gorup-hover");
    });
});

// create room 
let create_room_btn = document.querySelector(".create-room-btn");

create_room_btn.addEventListener("click", function () {
    let inputs, createOwner, createUser, createPass;
    try {
        inputs = create_room_btn.parentElement.parentElement.childNodes[3].childNodes[3].querySelectorAll("input");
        createOwner = inputs[0].value;
        createUser = inputs[1].value;
        createPass = inputs[2].value;
    } catch (error) {
        window.location.reload();
    };

    // console.log(createOwner, createUser, createPass);

    if (createOwner.length >= 2 && createUser.length >= 5 && createPass.length >= 6) {

        let xhr = new XMLHttpRequest();

        xhr.open("post", "api/createroom.php", true);

        xhr.addEventListener("load", (element) => {
            let response = JSON.parse(element.srcElement.responseText).errors[0];
            if (response.status != "200") {
                // alert(response.title+" : "+response.details)
                messageBox(response.title, response.details, "danger");
            }
            else {
                // alert(response.title+" : "+response.details);
                messageBox(response.title, response.details, "primery");

                createOwner = inputs[0].value = "";
                createUser = inputs[1].value = "";
                createPass = inputs[2].value = "";

                location.reload();
            }
        });

        xhr.send(`{"owner":"${createOwner}","username":"${createUser}","password":"${createPass}"}`);
    }
    else {
        // alert("Fill Valid Value");
        messageBox("Warring", "Fill All Blanks Requird", "danger");
    };

});

// login room 

let login_form = document.querySelector(".join_room");

// login btn 
let login_btn = login_form.children[2];

// login btn clickd 
login_btn.addEventListener("click", () => {
    let joiner_name;
    let username;
    let password;
    try {
        joiner_name = login_form.children[1].children[0].children[0].children[1].children[0].value;
        username = login_form.children[1].children[0].children[1].children[1].children[0].value;
        password = login_form.children[1].children[0].children[2].children[1].children[0].value;

    } catch (error) {
        location.reload();
    };

    // validation 
    if (joiner_name.length >= 2 && username.length >= 5 && password.length >= 6) {
        // sending request for login 
        let xhr = new XMLHttpRequest();

        xhr.open("post", "api/loginRoom.php", true);

        xhr.addEventListener("load", (element) => {
            let response = JSON.parse(element.srcElement.responseText).errors[0];
            if (response.status != "200") {
                // alert(response.title+" : "+response.details)
                messageBox(response.title, response.details, "danger");
            }
            else {
                // alert(response.title+" : "+response.details);
                messageBox(response.title, response.details, "primery");

                joiner_name.value = "";
                username.value = "";
                password.value = "";

                location.href = "room.php";
            };
        });

        xhr.send(`{"joiner_name":"${joiner_name}","username":"${username}","password":"${password}"}`);
    }
    else{
        messageBox("Warring", "Fill All Blanks Requird", "danger");
    }
});

// 24 hour old data delete 
fetch("./api/clearOldData.php").then(e=>e.text()).then(e=>console.log(e));