"use strict";

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
