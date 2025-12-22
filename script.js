const container = document.querySelector(".container");
const sizeElement = document.querySelector(".size");
const color = document.querySelector(".color-picker");
const resetButton = document.querySelector("#reset-btn");
const penBtn = document.querySelector("#pen-btn");
const eraserBtn = document.querySelector("#eraser-btn");

let currentTool = "pen";   //by defaultt
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

function drawPixel(div){
    if(currentTool === "pen"){
        div.style.backgroundColor = color.value;
    }
    else if(currentTool === "eraser"){
        div.style.backgroundColor = "white";
    }
}



function onMouseOver(div) {
    if(!draw)
        return;
    drawPixel(div);
}
function onMouseDown(div) {
    drawPixel(div);
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

penBtn.addEventListener("click", function() {
    currentTool = "pen";
    penBtn.classList.add("active");
    eraserBtn.classList.remove("active");
});

eraserBtn.addEventListener("click", function(){
    currentTool = "eraser";
    eraserBtn.classList.add("active");
    penBtn.classList.remove("active");
});


// sizeElement.addEventListener("change", function()

//save functionality
const downloadBtn = document.getElementById("download-btn");
const containerPanel = document.querySelector(".container-panel");

downloadBtn.addEventListener("click", function() {
    html2canvas(containerPanel).then(canvas => {
        // Convert canvas to data URL
        const imgData = canvas.toDataURL("image/png");

        // Create a temporary link to download
        const link = document.createElement("a");
        link.href = imgData;
        link.download = "my_pixel_art.png";
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        alert("Your pixel art has been saved!");
    });
});

//gallery functionality
const saveGalleryBtn = document.getElementById("save-btn");

saveGalleryBtn.addEventListener("click", function() {
    html2canvas(containerPanel).then(canvas => {
        const image_data = canvas.toDataURL("image/png");
        const art_name = prompt("Enter a name for your artwork:", "Untitled");
        if (art_name === null) {
            return; // user cancelled the prompt
        }
        // Send the image data and art name to the server
        fetch('savegallery.php', {
            method: 'POST',
            body: JSON.stringify({
                image: image_data,
                name: art_name
            }),
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(response => {
            if (response.ok) {
                alert("Artwork saved to gallery!");
            } else {
                alert("Error saving artwork.");
            }
        });
    });
});

// Function to load gallery items
function loadGallery() {
    fetch('loadgallery.php')
        .then(res => res.json())
        .then(data => {
            if (!data.success) {
                console.error(data.message);
                return;
            }

            const galleryContainer = document.querySelector(".gallery-container");
            galleryContainer.innerHTML = "";

            data.artworks.forEach(item => {
                const img = document.createElement("img");
                img.src = item.image_data;
                img.alt = item.art_name;
                img.classList.add("gallery-item");
                galleryContainer.appendChild(img);
            });
        });
}

window.addEventListener("load", loadGallery);


