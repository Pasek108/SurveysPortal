"use strict";

class SurveyCreator {
    constructor(survey_data = "", link = "/survey/store/") {
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

        this.link = link;
        if (survey_data != "") this.loadData(JSON.parse(survey_data));

        this.create_question_button = this.container.querySelector("#add-question");
        this.create_question_button.addEventListener("click", () => this.questions.push(new Question(this.questions, this.questions_container, this.question_modal)));

        this.block_sending = false;
        this.create_survey_button = this.container.querySelector("#create_survey");
        this.create_survey_button.addEventListener("click", () => {
            if (this.block_sending) return;

            this.block_sending = true;
            this.create_survey_button.disabled = true;
            setTimeout(this.unblockSending.bind(this), 5000);

            fetch(this.link, {
                headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                method: (this.link == "/survey/store/") ? "POST" : "PUT",
                body: JSON.stringify(this.getData())
            })
            .then(response => response.json())
            .then(result => {
                console.log(result)
                messages.clearMessages();
                if (result.status == 201) window.location.href = result.redirect;
                else result.messages.forEach(message => messages.createMessage("warning", message));
            })
            .catch(response => console.log(response))
        })
    }

    unblockSending() {
        this.block_sending = false;
        this.create_survey_button.disabled = false;
    }

    loadData(data) {
        this.title.value = data.title;
        this.description.value = data.description;
        this.start_date.value = data.start_date;
        this.end_date.value = data.end_date;
        this.end_message.value = data.end_message;
        this.allow_not_logged.checked = data.allow_not_logged;

        this.survey_tags.loadData(data.tags);

        data.questions.forEach(question => {
            this.questions.push(new Question(this.questions, this.questions_container, this.question_modal));
            this.questions[this.questions.length - 1].loadData(question);
        });
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
        this.questions.forEach((question) => (question != null) ? questions.push(question.data) : "");

        return {
            title: this.title.value.trim(),
            description: this.description.value.trim(),
            start_date: this.start_date.value.replace('T', ' '),
            end_date: this.end_date.value.replace('T', ' '),
            tags: this.survey_tags.getTagsArray(),
            questions: questions,
            admin_password: this.admin_password.value.trim(),
            access_password: this.access_password.value.trim(),
            end_message: this.end_message.value.trim(),
            allow_not_logged: this.allow_not_logged.checked,
        }
    }
}
