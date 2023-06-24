"use strict";

class ChoiceType {
    constructor(parent_container) {
        this.container = parent_container.querySelector("#choice");

        this.choices = [
            this.container.querySelector(".choice1"),
            this.container.querySelector(".choice2"),
        ];

        this.add_choice = this.container.querySelector("#add-choice");
        this.add_choice.addEventListener("click", this.createChoice.bind(this));
    }

    show() {
        this.container.style.display = null;
    }

    hide() {
        this.container.style.display = "none";
    }

    removeChoice(choice_id) {
        this.container.removeChild(this.choices[choice_id]);
        this.choices[choice_id] = null;
    }

    getValues() {
        let choices = [];

        for (let i = 0; i < this.choices.length; i++) {
            if (this.choices[i] != null) {
                const choice_input = this.choices[i].querySelector("input");
                if (choice_input.value.trim() != "") choices.push(choice_input.value.trim());
            }
        }

        return choices;
    }

    load(data) {
        for (let i = 0; i < data.length; i++) {
            if (i > this.choices.length - 1) this.createChoice();
            this.choices[i].querySelector("input").value = data[i];
        }
    }

    reset() {
        for (let i = 2; i < this.choices.length; i++) {
            if (this.choices[i] != null) this.removeChoice(i);
        }

        this.choices = [
            this.container.querySelector(".choice1"),
            this.container.querySelector(".choice2"),
        ];
    }

    createChoice() {
        const choice_id = this.choices.length;

        const choice = document.createElement("div");
        choice.className = `choice${choice_id + 1} flex flex-row items-center justify-between w-full gap-2 mb-2`;

        const choice_label = document.createElement("label");
        choice_label.className = "inline-block mb-1";
        choice_label.setAttribute("for", `a${choice_id + 1}`);
        choice_label.innerText = `${choice_id + 1}.`;
        choice.appendChild(choice_label);

        const choice_input = document.createElement("input");
        choice_input.className = "px-4 py-1.5 w-full border rounded border-gray-400 text-lg";
        choice_input.setAttribute("type", "text");
        choice_input.setAttribute("id", `a${choice_id + 1}`);
        choice_input.setAttribute("name", `a${choice_id + 1}`);
        choice_input.setAttribute("placeholder", `Choice ${choice_id + 1}`);
        choice.appendChild(choice_input);

        const remove_button = document.createElement("button");
        remove_button.className = "w-12 h-10 text-xl text-white bg-red-700 rounded hover:bg-red-800";
        remove_button.setAttribute("type", "button");
        remove_button.innerHTML = `<i class="fa-solid fa-xmark"></i>`;
        remove_button.addEventListener("click", () => this.removeChoice(choice_id));
        choice.appendChild(remove_button);

        this.choices.push(choice);
        this.container.insertBefore(choice, this.add_choice);
    }
}
