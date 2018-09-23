window.onload = drawBoard;
HTMLCanvasElement.prototype.relMouseCoords = relMouseCoords;

var tab = [0, 0, 0, 0, 0, 0, 0, 0, 0];
var actualPlayer = 1;
var gameOver = false;

var canvas = document.querySelector('#canvas_m');
var context = canvas.getContext('2d');
var cLeft = canvas.offsetLeft;
var cTop = canvas.offsetTop;

canvas.addEventListener('click', onClick, false);

function onClick(event) {
  if (!gameOver) {
    coords = canvas.relMouseCoords(event);
    var x = coords.x;
    var y = coords.y;

    var cx = Math.floor(x / 200);
    var cy = Math.floor(y / 200);

    if (tab[3 * cy + cx] == 0 && actualPlayer == 1) {
      cross(100 + (200 * cx), 100 + (200 * cy));
      tab[3 * cy + cx] = 1;
      checkWin();
      actualPlayer = 2;
    } else if (tab[3 * cy + cx] == 0 && actualPlayer == 2) {
      circle(100 + (200 * cx), 100 + (200 * cy));
      tab[3 * cy + cx] = 2;
      checkWin();
      actualPlayer = 1;
    }
  }
}

function checkWin() {
  var w1 = (tab[0] == tab[1] && tab[1] == tab[2] && tab[0] != 0);
  var w2 = (tab[3] == tab[4] && tab[4] == tab[5] && tab[3] != 0);
  var w3 = (tab[6] == tab[7] && tab[7] == tab[8] && tab[6] != 0);
  var h1 = (tab[0] == tab[3] && tab[3] == tab[6] && tab[0] != 0);
  var h2 = (tab[1] == tab[4] && tab[4] == tab[7] && tab[1] != 0);
  var h3 = (tab[2] == tab[5] && tab[5] == tab[8] && tab[2] != 0);
  var d1 = (tab[0] == tab[4] && tab[4] == tab[8] && tab[0] != 0);
  var d2 = (tab[6] == tab[4] && tab[4] == tab[2] && tab[6] != 0);

  if (w1 || w2 || w3 || h1 || h2 || h3 || d1 || d2) {
    alert("Player: " + actualPlayer + " Win!");
    gameOver = true;
  }
}

function relMouseCoords(event) {
  var totalOffsetX = 0;
  var totalOffsetY = 0;
  var canvasX = 0;
  var canvasY = 0;
  var currentElement = this;

  do {
    totalOffsetX += currentElement.offsetLeft - currentElement.scrollLeft;
    totalOffsetY += currentElement.offsetTop - currentElement.scrollTop;
  }
  while (currentElement = currentElement.offsetParent)

  canvasX = event.pageX - totalOffsetX;
  canvasY = event.pageY - totalOffsetY;

  return {
    x: canvasX,
    y: canvasY
  }
}

function drawBoard() {
  var canvas = document.querySelector('#canvas_m');
  var context = canvas.getContext('2d');

  context.strokeStyle = "white";
  context.lineWidth = "5";
  context.strokeRect(0, 0, 600, 600);

  context.lineWidth = "3";
  context.beginPath();
  context.moveTo(200, 0);
  context.lineTo(200, 600);
  context.moveTo(400, 0);
  context.lineTo(400, 600);
  context.moveTo(0, 200);
  context.lineTo(600, 200);
  context.moveTo(0, 400);
  context.lineTo(600, 400);
  context.stroke();
}

function cross(centerX, centerY) {
  var canvas = document.querySelector('#canvas_m');
  var context = canvas.getContext('2d');

  context.strokeStyle = "white";
  context.lineWidth = "2";
  context.beginPath();
  context.moveTo(centerX - 80, centerY - 80);
  context.lineTo(centerX + 80, centerY + 80);
  context.moveTo(centerX + 80, centerY - 80);
  context.lineTo(centerX - 80, centerY + 80);
  context.stroke();
}

function circle(centerX, centerY) {
  var canvas = document.querySelector('#canvas_m');
  var context = canvas.getContext('2d');

  context.strokeStyle = "white";
  context.lineWidth = "2";
  context.beginPath();
  context.arc(centerX, centerY, 80, 0, 2 * Math.PI);
  context.stroke();
}
