const enclosCoords  = {
    "Ara/Perroquet": { x: 234, y: 228 },
    "GrandHocco": { x: 260, y: 217 },
    "Panthère": { x: 302, y: 226 },
    "Panda roux": { x: 497, y: 410 },
    "Chèvre naine": { x: 525, y: 444 },
    "Lémurien": { x: 540, y: 434 },
    "Chèvre naine/Tortue": { x: 592, y: 453 },
    "Mouflon": { x: 638, y: 450 },
    "Binturong/Loutre": { x: 660, y: 370 },
    "Python/Tortue/Iguane": { x: 210, y: 247 },
    "Rhinocéros/Oryx beisa/Gnou": { x: 303, y: 169 },
    "Suricate": { x: 390, y: 196 },
    "Fennec": { x: 401, y: 183 },
    "Coati/Saïmiri": { x: 423, y: 181 },
    "Tapir": { x: 515, y: 186 },
    "Casoar": { x: 546, y: 149 },
    "Crocodile nain": { x: 563, y: 94 },
    "Guépard": { x: 542, y: 57 },
    "Gazelle/Autruche": { x: 471, y: 76 },
    "Tamarin": { x: 419, y: 267 },
    "Capucin": { x: 425, y: 279 },
    "Ouistiti": { x: 438, y: 295 },
    "Gibbon": { x: 450, y: 301 },
    "Grivet/Cercopithèque": { x: 526, y: 367 },
    "Varan de komodo": { x: 504, y: 293 },
    "Girafe": { x: 629, y: 323 },
    "Eléphant": { x: 562, y: 303 },
    "Hyène": { x: 645, y: 288 },
    "Loup à crinière": { x: 663, y: 284 },
    "Zèbre": { x: 670, y: 249 },
    "Lion": { x: 611, y: 176 },
    "Macaque crabier": { x: 767, y: 433 },
    "Cerf": { x: 825, y: 434 },
    "Vautour": { x: 886, y: 424 },
    "Daim/Antilope/Nilgat": { x: 1034, y: 377 },
    "Loup europe": { x: 1074, y: 345 },
    "Cigogne/Marabout": { x: 706, y: 231 },
    "Hippopotame": { x: 665, y: 195 },
    "Oryx gazelle/Watusi/Ane de somalie": { x: 772, y: 277 },
    "Yack/Mouton noir": { x: 898, y: 238 },
    "Ibis/Tortue": { x: 747, y: 322 },
    "Pécari": { x: 828, y: 327 },
    "Tamanoir/Flamant rose/Nandou": { x: 862, y: 267 },
    "Emeu/Wallaby": { x: 972, y: 293 },
    "Porc-épic": { x: 985, y: 233 },
    "Lynx": { x: 761, y: 371 },
    "Serval": { x: 806, y: 373 },
    "Chien des buissons": { x: 865, y: 330 },
    "Tigre": { x: 937, y: 391 },
    "Bison": { x: 1031, y: 232 },
    "Ane de provence/Dromadaire": { x: 1057, y: 299 }
}
const intersections = [
    { x: 267.2, y: 264 },
    { x: 281.2, y: 319 },
    { x: 341.2, y: 356 },
    { x: 447.2, y: 404 },
    { x: 478.2, y: 411 },
    { x: 546.2, y: 446 },
    { x: 566.2, y: 452 },
    { x: 609.2, y: 452 },
    { x: 631.2, y: 458 },
    { x: 723.2, y: 425 },
    { x: 766.2, y: 434 },
    { x: 810.2, y: 434 },
    { x: 873.2, y: 430 },
    { x: 958.4, y: 421 },
    { x: 1029.4, y: 406 },
    { x: 1038.4, y: 377 },
    { x: 1067.8, y: 350 },
    { x: 1046.8, y: 281 },
    { x: 976.8, y: 223 },
    { x: 938.8, y: 236 },
    { x: 910.8, y: 231 },
    { x: 845.8, y: 269 },
    { x: 818.8, y: 267 },
    { x: 786.8, y: 283 },
    { x: 733.8, y: 286 },
    { x: 715.8, y: 310 },
    { x: 692.8, y: 241 },
    { x: 713.8, y: 220 },
    { x: 648.8, y: 196 },
    { x: 601.8, y: 196 },
    { x: 558.8, y: 164 },
    { x: 522.8, y: 149 },
    { x: 563.8, y: 85 },
    { x: 520.8, y: 26 },
    { x: 422.8, y: 95 },
    { x: 354.8, y: 105 },
    { x: 307.8, y: 134 },
    { x: 296.8, y: 173 },
    { x: 396.8, y: 210 },
    { x: 314.8, y: 250 },
    { x: 394.8, y: 195 },
    { x: 412.8, y: 188 },
    { x: 430.8, y: 191 },
    { x: 470.8, y: 213 },
    { x: 477.8, y: 203 },
    { x: 558.8, y: 171 },
    { x: 428.8, y: 282 },
    { x: 481.8, y: 306 },
    { x: 545.8, y: 283 },
    { x: 569.8, y: 261 },
    { x: 569.8, y: 294 },
    { x: 624.8, y: 300 },
    { x: 637.8, y: 323 },
    { x: 586.8, y: 354 },
    { x: 524.8, y: 370 },
    { x: 480.8, y: 339 },
    { x: 672.8, y: 378 },
    { x: 648.8, y: 290 },
    { x: 656.8, y: 252 },
    { x: 700.8, y: 339 },
    { x: 742.8, y: 374 },
    { x: 836.8, y: 383 },
    { x: 845.8, y: 396 },
    { x: 888.8, y: 398 },
    { x: 947.8, y: 415 },
    { x: 761.8, y: 328 },
    { x: 838.8, y: 333 },
    { x: 887.8, y: 326 },
    { x: 951.8, y: 321 },
    { x: 997.8, y: 295 },
    { x: 1050.8, y: 298 }
];
function distance(pointA, pointB) {
    return Math.sqrt((pointA.x - pointB.x) ** 2 + (pointA.y - pointB.y) ** 2);
}


function findNeighbors(current, intersections) {
    const radius = 100; 
    return intersections.filter(intersection => distance(current, intersection) <= radius);
}


function findPath(start, destination) {
    const openSet = [start];
    const cameFrom = new Map();
    const gScore = new Map();
    const fScore = new Map();

    gScore.set(start, 0);
    fScore.set(start, distance(start, destination));

    while (openSet.length > 0) {
        
        let current = openSet.reduce((lowest, node) => {
            if (fScore.get(node) < fScore.get(lowest)) {
                return node;
            }
            return lowest;
        });

       
        if (current.x === destination.x && current.y === destination.y) {
            let path = [current];
            while (cameFrom.has(current)) {
                current = cameFrom.get(current);
                path.unshift(current);
            }
            return path;
        }

       
        openSet.splice(openSet.indexOf(current), 1);

        
        const neighbors = findNeighbors(current, intersections.concat([destination]));
        for (const neighbor of neighbors) {
            const tentativeGScore = gScore.get(current) + distance(current, neighbor);

            if (tentativeGScore < (gScore.get(neighbor) || Infinity)) {
                
                cameFrom.set(neighbor, current);
                gScore.set(neighbor, tentativeGScore);
                fScore.set(neighbor, tentativeGScore + distance(neighbor, destination));

                if (!openSet.includes(neighbor)) {
                    openSet.push(neighbor);
                }
            }
        }
    }

    
    return [];
}

function drawRoute() {
    const canvas = document.getElementById("canvas");
    const ctx = canvas.getContext("2d");

    const startEnclos = document.getElementById("start").value;
    const destinationEnclos = document.getElementById("destination").value;

    ctx.clearRect(0, 0, canvas.width, canvas.height);

    const startCoord = enclosCoords[startEnclos];
    const destinationCoord = enclosCoords[destinationEnclos];

    if (!startCoord || !destinationCoord) {
        alert("Veuillez choisir des enclos valides.");
        return;
    }

    const path = findPath(startCoord, destinationCoord);

    if (path.length === 0) {
        alert("Aucun chemin trouvé !");
        return;
    }

    ctx.beginPath();
    ctx.moveTo(path[0].x, path[0].y);

    for (let i = 1; i < path.length; i++) {
        ctx.lineTo(path[i].x, path[i].y);
    }

    ctx.strokeStyle = "orange";
    ctx.lineWidth = 3;
    ctx.stroke();
}