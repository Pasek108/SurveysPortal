"use strict";

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

    loadData(tags) {
        for (let i = 0; i < tags.length; i++) {
            if (i < this.tags_inputs.length) this.tags_inputs[i].value = tags[i].name;
            else {
                this.createTagInput();
                this.tags_inputs[i].value = tags[i].name;
            }
        }
    }
}
