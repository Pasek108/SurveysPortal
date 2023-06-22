"use strict";

window.addEventListener("load", () => {
    const main_bg = document.querySelector("#main-bg");
    const ctx = main_bg.getContext("2d");

    // rotate and move
    ctx.rotate((10 * Math.PI) / 180);
    ctx.translate(0, -300);

    for (let i = 0; i < main_bg.width / 10 + 1; i++) {
        for (let j = 0; j < main_bg.height / 10 + 1; j++) {
            // draw triangle pointing up
            let a = [j * 50, i * 50];
            let b = [a[0] + 25, a[1] + 50];
            let c = [a[0] - 25, a[1] + 50];
            fill_triangle(ctx, a, b, c, random_light_gray());

            // draw triangle pointing down
            a = [j * 50, 50 * i];
            b = [a[0] + 50, a[1]];
            c = [a[0] + 25, a[1] + 50];
            fill_triangle(ctx, a, b, c, random_light_gray());
        }
    }
});

function fill_triangle(ctx, a, b, c, color) {
    ctx.fillStyle = `rgb(${color[0]}, ${color[1]}, ${color[2]})`;

    ctx.beginPath();
    ctx.moveTo(a[0], a[1]);
    ctx.lineTo(b[0], b[1]);
    ctx.lineTo(c[0], c[1]);
    ctx.fill();
}

function random_light_gray() {
    const bound = [230, 255];
    const r = Math.floor(Math.random() * (bound[1] - bound[0])) + bound[0];

    return [r, r, r];
}
