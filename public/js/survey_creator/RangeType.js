"use strict";

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
