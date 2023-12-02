// if php in url 
if (location.href == "http://localhost/chatroom/room.php") {
    location.href = "http://localhost/chatroom/room";
}

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
    } else if (type == "primery") {
        message_box.classList.remove("danger");
        message_box.classList.add("primery");
    } else {
        // message_box.classList.remove("danger");
        // message_box.classList.add("primery");
        message_box.style.background = "blue";
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

// dark mode 

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
} else {
    if (webMode == "dark") {
        setDarkMode();
    } else {
        setLightMode();
    };
}
// dark mode click toggle mode 
function Dark_Mode(element) {
    webMode = localStorage.getItem("mode");

    if (webMode == "dark") {
        setLightMode(element);
    } else {
        setDarkMode(element);
    };
};

//copy link 
function copyLink() {
    let copyid = document.querySelector(".copyid");
    navigator.clipboard.writeText(copyid.innerText);
    messageBox("Copy", "Link Copy Successfuly", "primery");
};

// logout button 
let logout_btn_exit = document.getElementById("logout_btn_exit");

logout_btn_exit.addEventListener("click", () => {
    location.href = "./api/leaveRoom.php";
    // send room destroy request
});

// key to exit 
document.onkeyup = (e) => {
    if (e.key == "Escape") {
        location.href = "./api/leaveRoom.php";
    };
};

// text are to chating box 

// chatting send into server 
function sendMessage(message) {
    let xhr = new XMLHttpRequest();

    xhr.open("post", "./api/sendChats.php", true);

    xhr.addEventListener("load", (element) => {
        console.log(element.srcElement.responseText);
    });

    // sending value;
    xhr.send('{"message":"' + message + '"}');
};

// add chating into chating box 
let chating_box = document.getElementById("chating_box");
function addChating(user, message, messager) {
    // class validation
    if (messager == "you") {
        messager = "you";
    }
    else {
        messager = "stranger";
    }
    chating_box.innerHTML += `<li><span class="${messager}">${user}: </span><span class="msg">${message}</span></li>`;

    // sendding chating 
    sendMessage(chating_value.value);
};

// click or enter to add chating
let send_chatBtn = document.getElementById("send_chatBtn");

send_chatBtn.addEventListener("click", () => {
    let chating_value = document.getElementById("chating_value");

    // adding value in cahting box 
    addChating("you", chating_value.value, "you");

    // scroll ling cahting box

    chating_box.parentElement.parentElement.scrollTop = chating_box.parentElement.parentElement.scrollHeight;
});

// getting all data 
function getData() {
    let xhr = new XMLHttpRequest();

    xhr.open("post", "./api/loadChats.php", true);

    xhr.addEventListener("load", (element) => {
        // clear old data 
        let chating_box = document.getElementById("chating_box");
        chating_box.innerHTML = "";

        // fetching server data 
        let responseData = ((element.srcElement.responseText));

        responseData = JSON.parse(responseData);
        Array.from(responseData).forEach((element) => {
            let myName = document.getElementById("myName");
            if (element.user == myName.value) {
                chating_box.innerHTML += `<li><span class="you">You: </span><span class="msg">${element.chats}</span></li>`;
            }
            else {
                chating_box.innerHTML += `<li><span class="stranger">${element.user}: </span><span class="msg">${element.chats}</span></li>`;
            };
        });

        // user send message to go bottom section 
        chating_box.parentElement.parentElement.scrollTop = chating_box.parentElement.parentElement.scrollHeight;
    });

    // sending value;
    xhr.send();
};

let UPDATE_DATA_TIME = 1000;
setInterval(() => {
    getData();
}, UPDATE_DATA_TIME);

// 24 hour old data delete 
fetch("./api/clearOldData.php");