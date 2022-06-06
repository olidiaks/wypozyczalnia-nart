const gsap = require("gsap");

const generateDivAbsolut = () => {
    const body = document.body
    const backgroundBodyColor = getComputedStyle(body).getPropertyValue("background");
    const div = document.createElement("div");
    div.classList.add("absoluteDiv");
    div.style.backgroundColor = backgroundBodyColor;
    body.append(div);
    return div;
}

const slider = absoluteElement => {
    const timeline1 = gsap.timeline();
    timeline1.fromTo(absoluteElement, 1.5, {y: "0%"}, {y: "100%"});
}

const showPageAnimation = () => {
    const element = generateDivAbsolut();
    slider(element)

}

export {showPageAnimation, generateDivAbsolut};