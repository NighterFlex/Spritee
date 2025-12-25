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

//save functionality (DOWNLOAD)
const downloadBtn = document.getElementById("download-btn");
const downloadIcon = document.querySelector(".download-icon");
const containerPanel = document.querySelector(".container-panel");

downloadBtn.addEventListener("click", function() {
    html2canvas(containerPanel).then(canvas => {
        //converting canvas to data URL
        const imgData = canvas.toDataURL("image/png");

        //creating a temp link to download
        const link = document.createElement("a");
        link.href = imgData;
        link.download = "my_pixel_art.png";
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        // alert("Your pixel art has been saved!");
    });
});

// downloadIcon.addEventListener("click", function() {
//     html2canvas(containerPanel).then(canvas => {
//         //converting canvas to data URL
//         const imgData = canvas.toDataURL("image/png");
//         //creating a temp link to download
//         const link = document.createElement("a");
//         link.href = imgData;
//         link.download = "my_pixel_art.png";
//         document.body.appendChild(link);
//         link.click();
//         document.body.removeChild(link);
//         // alert("Your pixel art has been saved!");
//     });
// });



//gallery functionality
document.getElementById('save-btn').addEventListener('click', () => {
    html2canvas(document.querySelector('.container')).then(canvas => {
        const imageData = canvas.toDataURL('image/png');
        const artname = prompt("Enter art name:", "My Art");

        if (artname.trim() === "" || artname === null) {
            alert("Art not saved. Please enter a name.");
            return; // user cancelled the prompt    
        }
        fetch('savegallery.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                art_name: artname,
                image_data: imageData
            })
        })
        .then(res => res.json())
        .then(data => {
            
            if (data.success) {
                alert('Artwork saved!');
                loadGallery(); // THIS IS IMPORTANT
            } else {
                alert('Save failed');
            }
        });
    });
});


function loadGallery() {
    fetch('loadgallery.php')
        .then(res => res.json())
        .then(data => {
            if (!data.success) return;

            const container = document.querySelector('.gallery-container');
            const emptyMsg = document.getElementById('empty-gallery');

            container.innerHTML = '';

            if (!data.success || data.artworks.length === 0) {
                emptyMsg.style.display = 'block';
                return;
            }

            emptyMsg.style.display = 'none';
            
            data.artworks.forEach(art => {
                const div = document.createElement('div');
                div.className = 'gallery-item';

                div.innerHTML = `
                <img src="${art.image_data}" class="gallery-image" />
                <h3>${art.art_name}</h3>
                <img src="images/delete.png" alt="delete icon" title="Delete" class="delete-icon">
                <img src="images/download.png" alt="download icon" title="Download" class="download-icon">
                `;  
                
                //for the overlay
                // const image = div.querySelector('.gallery-image');
                // attachOverlayToImage(image);

                //to delete artwork
                div.querySelector('.delete-icon').addEventListener('click', () => {
                    deleteArtwork(art.id);
                });

                container.appendChild(div);
            });

        });
}

function deleteArtwork(artworkId){
    if(!confirm("Are you sure you want to delete this artwork? :0"))
        return;

    fetch('deletegallery.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: artworkId })
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            alert('Artwork deleted! YAY');
            loadGallery(); // refreshthe gallery
        } else {
            alert('Delete failed');
        }
    });


}
document.addEventListener('DOMContentLoaded', loadGallery);


//close overly btton functionality----

// const closeOverlayButton = document.createElement('button');
// closeOverlayButton.id = 'close-overlay-btn';
// closeOverlayButton.innerHTML = 'X';

// document.body.appendChild(closeOverlayButton);

document.querySelector(".gallery-container").addEventListener("click", (e) => {
    if (!e.target.classList.contains("download-icon")) return;

    const galleryItem = e.target.closest(".gallery-item");
    const img = galleryItem.querySelector(".gallery-image");
    const artName = galleryItem.querySelector("h3").textContent || "artwork";

    const link = document.createElement("a");
    link.href = img.src;           // base64 image from DB
    link.download = `${artName}.png`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
});




