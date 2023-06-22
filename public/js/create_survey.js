"use strict";

let create_survey;
window.addEventListener("load", () => create_survey = new CreateSurvey());

/* ---------------- CreateSurveys ----------------*/
class CreateSurvey {
    constructor() {
        this.container = document.querySelector("#create-survey");
        this.loadSectionsSelect();

        this.title = this.container.querySelector("#title");
        this.description = this.container.querySelector("#description");
        this.start_date = this.container.querySelector("#start_date");
        this.end_date = this.container.querySelector("#end_date");

        this.admin_password = this.container.querySelector("#admin_password");
        this.access_password = this.container.querySelector("#access_password");
        this.end_message = this.container.querySelector("#end_message");
        this.allow_not_logged = this.container.querySelector("#allow_not_logged");

        this.survey_tags = new SurveyTags();
        this.question_modal = new QuestionModal();

        this.questions_container = this.container.querySelector("#questions-list");
        this.questions = [];

        this.create_question_button = this.container.querySelector("#add-question");
        this.create_question_button.addEventListener("click", () => {
            this.questions.push(new Question(this.questions, this.questions_container, this.question_modal));
        });

        this.create_survey_button = this.container.querySelector("#create_survey");
        this.create_survey_button.addEventListener("click", () => {
            fetch("/survey/store/", {
                headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                method: "POST",
                body: JSON.stringify(this.getData())
            })
            .then(response => response.json())
            .then(result => console.log(result))
            .catch(response =>  console.log(response))
        })
    }

    loadSectionsSelect() {
        this.active_section = 1;

        this.section_buttons = document.querySelectorAll("#sections button");
        const next_buttons = this.container.querySelectorAll(".next");
        const prev_buttons = this.container.querySelectorAll(".prev");

        this.section_buttons.forEach((section, id) => section.addEventListener("click", () => this.openSection(id + 1)));
        next_buttons.forEach((button, id) => button.addEventListener("click", () => this.openSection(id + 2)));
        prev_buttons.forEach((button, id) => button.addEventListener("click", () => this.openSection(id + 1)));
    }

    openSection(id) {
        this.container.classList.remove(`active-${this.active_section}`);
        this.active_section = id;

        if (this.active_section < 0) this.active_section = 0;
        this.active_section %= this.section_buttons.length + 1;

        this.container.classList.add(`active-${this.active_section}`);
    }

    getData() {
        let questions = [];
        this.questions.forEach((question) => questions.push(question.data));

        return {
            title: this.title.value.trim(),
            description: this.description.value.trim(),
            start_date: this.start_date.value,
            end_date: this.end_date.value,
            tags: this.survey_tags.getTagsArray(),
            questions: questions,
            admin_password: this.admin_password.value.trim(),
            access_password: this.access_password.value.trim(),
            end_message: this.end_message.value.trim(),
            allow_not_logged: this.allow_not_logged.checked,
        }
    }
}

/* ---------------- SurveysTags ----------------*/
class SurveyTags {
    constructor() {
        this.container = document.querySelector("#survey-tags");

        this.tags_inputs = [];
        this.tags_inputs_containers = this.container.querySelectorAll(".tag-input");
        this.tags_inputs_containers.forEach((tag_input) => this.tags_inputs.push(tag_input));

        this.add_tag_button = document.querySelector("#add-tag");
        this.add_tag_button.addEventListener("click", this.createTagInput.bind(this));
    }

    createTagInput() {
        const input = document.createElement("input");
        input.className = "w-32 h-auto py-1 pl-4 pr-1 text-lg border border-gray-400 rounded tag-input";
        input.setAttribute("type", "text");
        input.setAttribute("list", "tags");

        this.tags_inputs.push(input);
        this.container.insertBefore(input, this.add_tag_button);
    }

    getTagsArray() {
        let tags = [];

        this.tags_inputs.forEach((tag_input) => {
            const tag = tag_input.value.trim();
            if (tag != "") tags.push(tag);
        });

        return tags;
    }
}

/* ---------------- QuestionModal ----------------*/
class QuestionModal {
    constructor() {
        this.container = document.querySelector("#question-modal");

        this.question_cancel_callback = () => {};
        this.question_save_callback = () => {};

        this.question = this.container.querySelector("#question");
        this.description = this.container.querySelector("#description");

        const cancel_button = this.container.querySelector("#cancel");
        const create_button = this.container.querySelector("#create");

        cancel_button.addEventListener("click", () => {
            this.question_cancel_callback();
            this.container.style.display = "none";
        });

        create_button.addEventListener("click", () => {
            this.question_save_callback();
            this.container.style.display = "none";
        });

        /* ---------------- question type ----------------*/
        this.range_type = new RangeType(this.container);
        this.choice_type = new ChoiceType(this.container);

        this.type_select = this.container.querySelector("#type");
        this.type_select.addEventListener("input", this.changeType.bind(this));
    }

    show() {
        this.container.style.display = null;
    }

    hide() {
        this.container.style.display = "none";
    }

    changeType() {
        if (this.type_select.value === "text") {
            this.range_type.hide();
            this.choice_type.hide();
            return;
        }

        if (this.type_select.value === "range") {
            this.range_type.show();
            this.choice_type.hide();
            return;
        }

        this.range_type.hide();
        this.choice_type.show();

    }

    reset() {
        this.question.value = "";
        this.description.value = "";
        this.type_select.value = "text";
        this.range_type.reset();
        this.choice_type.reset();
        this.question_cancel_callback = () => {};
        this.question_save_callback = () => {};
        this.changeType();
    }

    getData() {
        return {
            question: this.question.value.trim(),
            description: this.description.value.trim(),
            type: this.type_select.value.trim(),
            range: this.range_type.getValues(),
            choices: this.choice_type.getValues()
        }
    }

    load(data, question_cancel_callback, question_save_callback) {
        this.question.value = data.question;
        this.description.value = data.description;
        this.type_select.value = data.type;
        this.range_type.load(data.range);
        this.choice_type.load(data.choices);
        this.question_cancel_callback = question_cancel_callback;
        this.question_save_callback = question_save_callback;
        this.changeType();
        this.show();
    }
}

/* ---------------- RangeType  ----------------*/
class RangeType {
    constructor(parent_container) {
        this.container = parent_container.querySelector("#range");

        this.from = this.container.querySelector("#from");
        this.to = this.container.querySelector("#to");
    }

    show() {
        this.container.style.display = null;
    }

    hide() {
        this.container.style.display = "none";
    }

    getValues() {
        return {
            from: +this.from.value,
            to: +this.to.value,
        }
    }

    load(data) {
        this.from.value = data.from;
        this.to.value = data.to;
    }

    reset() {
        this.from.value = "";
        this.to.value = "";
    }
}

/* ---------------- ChoiceType  ----------------*/
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

/* ---------------- Question ----------------*/
class Question {
    constructor(questions, questions_container, question_modal) {
        this.questions = questions;
        this.questions_container = questions_container;
        this.question_modal = question_modal;

        this.id = this.questions_container.length;
        this.container = this.createQuestionContainer();
        this.questions_container.appendChild(this.container);

        this.question_modal.reset();
        this.data = this.question_modal.getData();
        this.question_modal.load(this.data, this.removeQuestion.bind(this), this.saveData.bind(this));
    }

    createQuestionContainer() {
        const container = document.createElement("li");
        container.className = "flex flex-row items-center justify-between w-full gap-2 p-2 mb-2 border border-gray-600 rounded-md";

        const question = document.createElement("div");
        question.className = "w-full overflow-hidden cursor-pointer whitespace-nowrap text-ellipsis";
        question.innerText = "question_empty";
        question.addEventListener("click", this.loadModal.bind(this));
        container.appendChild(question);

        const remove_button = document.createElement("button");
        remove_button.className = "w-12 h-10 text-xl text-white bg-red-700 rounded hover:bg-red-800";
        remove_button.setAttribute("type", "button");
        remove_button.innerHTML = `<i class="fa-solid fa-xmark"></i>`;
        remove_button.addEventListener("click", this.removeQuestion.bind(this));
        container.appendChild(remove_button);

        return container;
    }

    removeQuestion() {
        this.questions_container.removeChild(this.container);
        this.questions[this.id] = null;
    }

    loadModal() {
        this.question_modal.reset();
        this.question_modal.load(this.data, () => {}, this.saveData.bind(this));
    }

    saveData() {
        this.data = this.question_modal.getData();
        this.container.querySelector("div").innerText = (this.data.question === "") ? "question_empty" : this.data.question;
    }
}
