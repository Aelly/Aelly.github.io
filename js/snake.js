window.onload = function() {
  canvas = document.querySelector('#canvas_m');
  context = canvas.getContext('2d');
  document.addEventListener("keydown", keyPush);
  resizeCanvas();
  //Draw Board
  context.strokeStyle = "white";
  context.lineWidth = "5";
  context.strokeRect(0, 0, context.canvas.width, context.canvas.height);
  //Game loop
  setInterval(game, 1000 / 15);
}

body = [];
size = 5;
scale = 10;
snakeX = snakeY = 10;
fruitX = fruitY = 20;
xs = 0;
ys = 0;
gameStart = false;

function game() {
  context.clearRect(2, 2, canvas.width - 4, canvas.height - 4);
  //------Snake
  context.fillStyle = "white";

  snakeX += xs;
  snakeY += ys;

  if (snakeX < 0 || snakeX > canvas.width / scale || snakeY < 0 || snakeY > canvas.height / scale) {
    alert("Game Over");
  }

  for (var i = 0; i < body.length; i++) {
    context.fillRect(body[i].x * scale, body[i].y * scale, scale - 2, scale - 2);
    if (body[i].x == snakeX && body[i].y == snakeY && gameStart) {
      alert("Game Over");
    }

  }
  //Add the new head position in the body tab
  body.push({
    x: snakeX,
    y: snakeY
  });
  //Remove all the old position to control the snake length
  while (body.length > size) {
    body.shift();
  }

  //------Fruit
  if (snakeX == fruitX && snakeY == fruitY) {
    fruitX = Math.floor(Math.random() * canvas.width / scale);
    fruitY = Math.floor(Math.random() * canvas.width / scale)
    size += 2;
  }
  context.fillStyle = "red";
  context.fillRect(fruitX * scale, fruitY * scale, scale - 2, scale - 2);
}

function keyPush(e) {
  if (!gameStart) gameStart = true;
  switch (e.keyCode) {
    case 37:
      if (xs != 1) {
        xs = -1;
        ys = 0;
      }
      break
    case 38:
      if (ys != 1) {
        xs = 0;
        ys = -1;
      }
      break
    case 39:
      if (xs != -1) {
        xs = 1;
        ys = 0;
      }
      break
    case 40:
      if (ys != -1) {
        xs = 0;
        ys = 1;
      }
      break
  }
}

function resizeCanvas() {
  //To restrain square canvas in the window
  var wWidth = window.innerWidth;
  var wHeight = window.innerHeight;

  if (context.canvas.width > wWidth || context.canvas.height > wHeight) {
    if (wWidth <= wHeight) {
      context.canvas.width = wWidth - canvas.offsetLeft;
      context.canvas.height = wWidth - canvas.offsetLeft;
    } else {
      context.canvas.width = window.innerHeight - canvas.offsetTop;
      context.canvas.height = window.innerHeight - canvas.offsetTop;
    }
  }

  scale = context.canvas.width / 40;
}
