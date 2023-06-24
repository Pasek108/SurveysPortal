"use strict";

class Messages {
    constructor() {
        this.container = document.querySelector("#messages");
    }

    clearMessages() {
        this.container.innerHTML = "";
    }

    createMessage(type, message) {
        const message_container = document.createElement("div");
        message_container.className = "flex flex-row w-full my-1 bg-red-600";

        const icon = document.createElement("div");
        icon.className = "flex flex-row items-center justify-center p-2 text-xl text-white bg-black bg-opacity-50 border-r border-white aspect-square";
        switch(type) {
            case "info": icon.innerHTML = '<i class="fa-solid fa-circle-info"></i>';
            case "warning": icon.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i>';
        }
        message_container.appendChild(icon);

        const text = document.createElement("div");
        text.className = "flex flex-row items-center justify-start px-3 py-1 text-lg text-white grow";
        text.innerText = message;
        message_container.appendChild(text);

        const close_button = document.createElement("button");
        close_button.className = "px-3 text-xl text-white cursor-pointer aspect-square";
        close_button.setAttribute("type", "button");
        close_button.innerHTML = `<i class="fa-solid fa-xmark"></i>`;
        close_button.addEventListener("click", () => {this.container.removeChild(message_container);});
        message_container.appendChild(close_button);

        this.container.appendChild(message_container);
    }
}
