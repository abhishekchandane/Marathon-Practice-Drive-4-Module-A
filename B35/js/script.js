const canvas = document.getElementById('fractalCanvas');
const ctx = canvas.getContext('2d');
const drawBtn = document.getElementById('drawBtn');
const iterInput = document.getElementById('iterations');

 
function drawTriangle(x1, y1, x2, y2, x3, y3) {
  ctx.beginPath();
  ctx.moveTo(x1, y1);
  ctx.lineTo(x2, y2);
  ctx.lineTo(x3, y3);
  ctx.closePath();
  ctx.fillStyle = '#000'; 
  ctx.fill();
}

 
function sierpinski(x1, y1, x2, y2, x3, y3, depth) {
  if (depth === 0) {
 
    drawTriangle(x1, y1, x2, y2, x3, y3);
    return;
  }

  
  const x12 = (x1 + x2) / 2, y12 = (y1 + y2) / 2;
  const x23 = (x2 + x3) / 2, y23 = (y2 + y3) / 2;
  const x31 = (x3 + x1) / 2, y31 = (y3 + y1) / 2;

 
  sierpinski(x1, y1, x12, y12, x31, y31, depth - 1);  
  sierpinski(x12, y12, x2, y2, x23, y23, depth - 1);  
  sierpinski(x31, y31, x23, y23, x3, y3, depth - 1);  
}

 
drawBtn.addEventListener('click', () => {
  ctx.clearRect(0, 0, canvas.width, canvas.height);  
  
  const depth = parseInt(iterInput.value) || 0;

  
  const x1 = canvas.width / 2,      y1 = 30;                 
  const x2 = 30,                    y2 = canvas.height - 30;  
  const x3 = canvas.width - 30,     y3 = canvas.height - 30;  

  sierpinski(x1, y1, x2, y2, x3, y3, depth);
});

 
drawBtn.click();
