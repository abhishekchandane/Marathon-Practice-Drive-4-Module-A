const container = document.getElementById('countersContainer');
const addBtn = document.getElementById('addCounterBtn');

 
addBtn.addEventListener('click', () => {
  const card = document.createElement('div');
  card.className = 'counter-card';
  card.innerHTML = `
    <span class="counter-value">0</span>
    <div class="btn-group">
      <button class="btn-dec">Decrease</button>
      <button class="btn-inc">Increase</button>
    </div>
  `;
  container.appendChild(card);
});

 
container.addEventListener('click', (e) => {
 
  const card = e.target.closest('.counter-card');
  if (!card) return;
  
  const valueDisplay = card.querySelector('.counter-value');
  let currentVal = parseInt(valueDisplay.textContent);

 
  if (e.target.classList.contains('btn-inc')) {
    valueDisplay.textContent = currentVal + 1;
  } else if (e.target.classList.contains('btn-dec')) {
    valueDisplay.textContent = currentVal - 1;
  }
});
