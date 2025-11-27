const container = document.querySelector(".container");
const sizeElement = document.querySelector(".size");
const color = document.querySelector(".color-picker");
const resetButton = document.querySelector(".reset-btn");

let draw = false;

let size = sizeElement.value;

function createGrid() {
    container.style.setProperty("--size", size);

    for(let i=0; i < size * size; i++){
        const div = document.createElement("div");
        div.classList.add("box");

        div.addEventListener("mouseover", () => onMouseOver(div));
        div.addEventListener("mousedown", () => onMouseDown(div));

        container.appendChild(div);
}
}

createGrid();   


function onMouseOver(div) {
    if(!draw)
        return;

    div.style.backgroundColor = color.value;
}
function onMouseDown(div) {
    div.style.backgroundColor = color.value;
}

window.addEventListener("mousedown", function(){
    draw = true;
});

window.addEventListener("mouseup", function() {
    draw = false;
});

function reset(){
    container.innerHTML = "";
    createGrid();
}

resetButton.addEventListener("click", reset);

sizeElement.addEventListener("keyup", function(){
    size = sizeElement.value;
    reset();
});

// sizeElement.addEventListener("change", function()