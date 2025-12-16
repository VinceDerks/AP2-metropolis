document.addEventListener('DOMContentLoaded', () => {
    const draggables = document.querySelectorAll('.component-button');
    draggables.forEach(el => {
        el.setAttribute('draggable', 'true');
        el.addEventListener('dragstart', handleDragStart);
        el.addEventListener('touchstart', handleTouchStart);
        el.addEventListener('touchmove', handleTouchMove);
        el.addEventListener('touchend', handleTouchEnd);
    });
});

let touchClone = null;
let currentTouchId = null;
let startElement = null;
let touchOffsetX = 0;
let touchOffsetY = 0;

function getComponentData(id) {
    let cleanId = id.startsWith("p-") ? id.split('-')[1] + '-' + id.split('-')[2] : id;
    if(id.startsWith("p-") && id.split('-').length > 2) {
        cleanId = id.split('-')[1] + '-' + id.split('-')[2];
    }
    return window.gridComponents[cleanId] || { image: "", label: "?" };
}

function createGridItem(id) {
    const { label, image } = getComponentData(id);
    let typeId = id;
    if (id.startsWith('p-')) {
         const parts = id.split('-');
         if(parts.length > 2) typeId = parts[1] + '-' + parts[2];
    }

    const uniqueSuffix = Math.random().toString(36).substr(2, 5);

    const newBlock = document.createElement("div");
    newBlock.className = "w-full h-full cursor-grab relative group";
    newBlock.setAttribute("draggable", "true");
    newBlock.id = "p-" + typeId + "-" + uniqueSuffix; 

    newBlock.style.backgroundImage = `url('${image}')`;
    newBlock.style.backgroundSize = 'cover';
    newBlock.style.backgroundPosition = 'center';

    const tooltip = document.createElement("div");
    tooltip.className = "absolute inset-0 bg-black/50 flex items-center justify-center text-white text-xs font-bold opacity-0 group-hover:opacity-100 transition-opacity";
    tooltip.textContent = label;
    newBlock.appendChild(tooltip);

    newBlock.addEventListener('dragstart', handleDragStart);
    newBlock.addEventListener('touchstart', handleTouchStart);
    newBlock.addEventListener('touchmove', handleTouchMove);
    newBlock.addEventListener('touchend', handleTouchEnd);
    
    return newBlock;
}

window.handleDragStart = function(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
    if (ev.target.id.startsWith("p-")) {
        setTimeout(() => ev.target.classList.add("opacity-50"), 0);
    }
}

document.addEventListener("dragend", (ev) => {
    if (ev.target && ev.target.classList) {
        ev.target.classList.remove("opacity-50");
    }
});

window.allowDrop = function(ev) {
    ev.preventDefault();
}

window.handleDrop = function(ev) {
    ev.preventDefault();
    const id = ev.dataTransfer.getData("text");
    processDropLogic(ev.target, id);
}

function handleTouchStart(e) {
    startElement = e.target.closest('.component-button') || e.target.closest('.cursor-grab');
    if (!startElement) return;

    currentTouchId = startElement.id;
    
    const rect = startElement.getBoundingClientRect();
    const touch = e.touches[0];
    
    touchOffsetX = touch.clientX - rect.left;
    touchOffsetY = touch.clientY - rect.top;

    touchClone = startElement.cloneNode(true);
    touchClone.className = "drag-clone overflow-hidden shadow-xl";
    touchClone.style.width = rect.width + "px";
    touchClone.style.height = rect.height + "px";
    
    document.body.appendChild(touchClone);
    moveClone(touch.clientX, touch.clientY);

    if (currentTouchId.startsWith("p-")) {
        startElement.classList.add("opacity-50");
    }
}

function handleTouchMove(e) {
    if (touchClone) {
        e.preventDefault();
        const touch = e.touches[0];
        moveClone(touch.clientX, touch.clientY);
    }
}

function handleTouchEnd(e) {
    if (startElement) startElement.classList.remove("opacity-50");
    
    if (touchClone) {
        touchClone.remove();
        touchClone = null;
        
        const touch = e.changedTouches[0];
        const targetElement = document.elementFromPoint(touch.clientX, touch.clientY);
        if (targetElement) processDropLogic(targetElement, currentTouchId);
    }
    
    currentTouchId = null;
    startElement = null;
}

function moveClone(x, y) {
    if(touchClone) {
        touchClone.style.left = (x - touchOffsetX) + "px";
        touchClone.style.top = (y - touchOffsetY) + "px";
    }
}

function processDropLogic(targetNode, id) {
    if (!id || !targetNode) return;

    const draggedElement = document.getElementById(id);
    const isLibrarySource = id.startsWith('c-');

    let target = targetNode;
    while (target && !target.classList.contains("grid-cell") && !target.id.startsWith("component-library") && target.tagName !== 'BODY') {
        target = target.parentElement;
    }
    if (!target) return;

    if (target.classList.contains("grid-cell")) {
        const isOccupied = target.firstElementChild !== null;

        if (isOccupied) {
            if (isLibrarySource) {
                target.removeChild(target.firstElementChild);
            } else {
                return; 
            }
        }

        if (isLibrarySource) {
            const newGridItem = createGridItem(id);
            if (newGridItem) {
                target.appendChild(newGridItem);
            }
        } else if (draggedElement) {
            target.appendChild(draggedElement);
        }
    } 
    else if (target.id && target.id.startsWith("component-library")) {
        if (draggedElement && !isLibrarySource) {
            draggedElement.remove();
        }
    }
}

function getCoordinates() {
    const cells = document.querySelectorAll('.grid-cell');
    const results = [];

    cells.forEach(cell => {
        if (cell.firstElementChild) {
            const coord = cell.getAttribute('data-coordinate');
            const item = cell.firstElementChild;
            const parts = item.id.split('-');
            const type = parts[1] + '-' + parts[2];

            results.push({
                coordinate: coord,
                type: type
            });
        }
    });

    console.log("Found buildings", results);
    return results;
}