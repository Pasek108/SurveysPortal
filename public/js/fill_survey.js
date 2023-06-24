"use strict";

let fill_survey, messages;
window.addEventListener("load", () => {
    fill_survey = new FillSurvey();
    messages = new Messages();
});

class FillSurvey {
    constructor() {
        this.container = document.querySelector("#fill-survey");

        this.questions_containers = this.container.querySelectorAll(".question");
        this.questions_containers.forEach(question_container => {
            const type = question_container.dataset.type;

            if (type == "range") {
                const input = question_container.querySelector("input");
                const indicator = question_container.querySelector(".indicator");
                input.addEventListener("input", () => {
                    indicator.innerText = input.value;
                    indicator.style.left = `${98 * (input.value - input.min) / (input.max - input.min)}%`;
                })
            }
        });

        this.rating = 0;
        this.no_rating = this.container.querySelector("#no_rating");

        this.stars = this.container.querySelectorAll(".fa-star");
        this.stars.forEach((star, id) => {
            star.addEventListener("click", () => {
                if (this.rating == id + 1) {
                    this.rating = 0;

                    for (let i = 0; i < this.stars.length; i++) {
                        this.stars[i].classList.replace("fa-solid", "fa-regular");
                        this.stars[i].style.color = "black";
                    }
                } else {
                    this.rating = id + 1;

                    for (let i = 0; i < this.stars.length; i++) {
                        if (i < this.rating) {
                            this.stars[i].classList.replace("fa-regular", "fa-solid");
                            this.stars[i].style.color = "#ffe700";
                        } else {
                            this.stars[i].classList.replace("fa-solid", "fa-regular");
                            this.stars[i].style.color = "black";
                        }
                    }
                }
            });
        });

        this.block_sending = false;
        this.submit_survey_button = this.container.querySelector("#submit_survey");
        this.submit_survey_button.addEventListener("click", () => {
            if (this.block_sending) return;

            this.block_sending = true;
            this.submit_survey_button.disabled = true;
            setTimeout(this.unblockSending.bind(this), 5000);

            fetch(`/survey/${survey_id}/send`, {
                headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                method: "POST",
                body: JSON.stringify(this.getData())
            })
            .then(response => response.json())
            .then(result => {
                console.log(result)
                messages.clearMessages();
                if (result.status == 201) {
                    document.querySelector("#thank_you").style.display = null;
                    this.container.parentElement.removeChild(this.container);
                }
                else result.messages.forEach(message => messages.createMessage("warning", message));
            })
            .catch(response => console.log(response))
        })
    }

    unblockSending() {
        this.block_sending = false;
        this.submit_survey_button.disabled = false;
    }

    getData() {
        const alphabet = "ABCDEFGHIJKLMNOPQRSTUWXYZ";
        let answers = [];

        this.questions_containers.forEach(question_container => {
            const inputs = question_container.querySelectorAll("input");
            const type = question_container.dataset.type;
            let string = "";

            if (type =="text" || type == "range") string = String(inputs[0].value).trim();
            else {
                for (let i = 0; i < inputs.length; i++) {
                    switch(type) {
                        case "single choice": {
                            if (inputs[i].checked) {
                                string = alphabet[i];
                                i = inputs.length;
                            }
                        } break;
                        case "multiple choice": {
                            if (inputs[i].checked) string += alphabet[i];
                        } break;
                        case "single choice or text": {
                            if (i == inputs.length - 1) string = String(inputs[i].value).trim();
                            else if (inputs[i].checked) {
                                string = alphabet[i];
                                i = inputs.length;
                            }
                        } break;
                        case "multiple choice or text": {
                            if (i == inputs.length - 1) string += "-" + String(inputs[i].value).trim();
                            else if (inputs[i].checked) string += alphabet[i];
                        } break;
                    }
                }
            }

            answers.push(string);
        });

        return {
            no_rating: this.no_rating.checked,
            rating: this.rating,
            answers: answers
        };
    }
}
