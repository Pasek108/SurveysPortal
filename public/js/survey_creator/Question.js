"use strict";

class Question {
    constructor(questions, questions_container, question_modal) {
        this.questions = questions;
        this.questions_container = questions_container;
        this.question_modal = question_modal;

        this.id = this.questions.length;
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

    loadData(question) {
        this.data = question;
        this.question_modal.load(this.data, this.removeQuestion.bind(this), this.saveData.bind(this));
        this.data = this.question_modal.getData();
        this.container.querySelector("div").innerText = (this.data.question === "") ? "question_empty" : this.data.question;
        this.question_modal.hide();
    }
}
